<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		if (($language = get_cookie('language')) != NULL && in_array($language, $this->config->item('supported_languages'))) 
		{
			load_language($language);
		}
	}

	public function index()
	{
		if ($this->session->admin['logged_in']) 
		{
			redirect(base_url() .'admin/newsletter');
		} 
		else 
		{
			redirect(base_url() . 'admin/login');
		}
	}

	public function login()
	{
		if ($this->session->admin['logged_in']) 
		{
			redirect(base_url() . 'admin/index');
		}

		$header_data = array(
			'title' => 'Primus Romulus - Admin Panel', 
			'page' => 'admin',
		);

		$this->load->view('elements/header', $header_data);

		// User tried to log in but validation failed
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/login');
		}

		// User tried to log in and validation succeeded
		else 
		{
			$email = html_escape($this->input->post('email'));
			$password = html_escape($this->input->post('password'));
			//$remember = $this->input->post('remember') != NULL;

			$query = $this->Admin->get_admin($email);

			if ($query->num_rows() == 1) 
			{
				$user = $query->row();
				
				if ($user->user_password_hash == $this->User->password_hash($email, $password)) 
				{
					$session_data = $query->result_array()[0];
					$session_data['logged_in'] = true;

					$this->session->set_userdata(array('admin' => $session_data));
				} 
				else 
				{
					$error = '<li>E-Mail oder Passwort falsch.</li>';
				}
			} 
			else 
			{
				$error = '<li>E-Mail oder Passwort falsch.</li>';
			}

			if (!empty($error)) 
			{
				$message = array(
					'type' => 'error',
					'message' => '<strong>Sie können sich aus folgenden Gründen nicht anmelden:</strong><ul>'. $error .'</ul>',
				);
			}

			if (isset($message['type']) && $message['type'] != 'success') 
			{
				$this->load->view('admin/login', $message);
			} 
			else 
			{
				redirect(base_url() .'admin/index');
			}
		}
		
		$this->load->view('elements/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata(array('admin'));

		redirect(base_url() .'admin/index');
	}
	
	public function newsletter($action = '', $newsletter_id = '')
	{
		if(!$this->session->admin['logged_in']) 
		{
			redirect(base_url() . 'admin/index');
		}

		if (($action == 'edit-newsletter' || $action == 'delete-newsletter' || $action == 'send-newsletter') && (!isset($newsletter_id) || !ctype_digit($newsletter_id) || $newsletter_id < 0)) 
		{
			$action = '';
		}
		
		switch ($action) 
		{
			case 'create-newsletter':
				// Request from: application/views/admin/appilications/newsletter/create-newsletter.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) 
				{
					$subject = html_escape($this->input->post('subject'));
					$text = html_escape($this->input->post('text'));
					$member = html_escape($this->input->post('member'));
					$partner = html_escape($this->input->post('partner'));
					$employee = html_escape($this->input->post('employee'));

					if ($this->form_validation->run('newsletter/create-newsletter') == FALSE) 
					{
						$this->load->view('admin/applications/newsletter/create-newsletter');
						return;
					}

					// Create the post in the database to get the id for the image upload
					$newsletter_id = $this->Newsletter->create_newsletter($subject, $text, null, null, $member, $partner, $employee);

					$upload_path = 'assets/images/admin/newsletter/' . $newsletter_id . '/';

					if (!create_directory($upload_path, 0777, true)) 
					{
						$this->load->view('admin/applications/newsletter/create-newsletter', array(
							'image_error' => 'Die Datei konnte nicht hochgeladen werden: Der Ordner konnte nicht erstellt werden.',
						));
						return;
					}
					
					if ($newsletter_id <= 0) 
					{
						// Delete the post because an error happened
						$this->Newsletter->delete_newsletter($newsletter_id);

						$message = array(
							'type' => 'error',
							'message' => 'Ihr Newsletter <strong>'. $subject .'</strong> konnte nicht erstellt werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}
					//Image Upload
					$this->upload->initialize(array(
						'upload_path' => $upload_path,
						'allowed_types' => 'jpeg|jpg|png',
						//'file_name' => uniqid($post_id .'i'),
						'file_ext_tolower' => true,
						'optional' => true,
						'overwrite' => true,
						'max_size' => 4 * 1024,
						'max_width' => 2048,
						'max_height' => 2048,
					));

					if (!$this->upload->do_upload('image')) 
					{
						$data = array(
							'memberC' => $this->Newsletter->get_count("member")->result_array()[0],
							'partnerC' => $this->Newsletter->get_count("partner")->result_array()[0],
							'employeeC' => $this->Newsletter->get_count("employee")->result_array()[0],
						);
						$data['image_error'] = $this->upload->display_errors();
						
						// Delete the post because an error happened
						$this->Newsletter->delete_newsletter($newsletter_id);

						$this->load->view('admin/applications/newsletter/create-newsletter', $data);

						return;
					}

					if ($this->upload->data()['file_size'] != NULL) 
					{
						$image_url = $upload_path . $this->upload->data()['file_name'];
					} 
					else 
					{
						$image_url = NULL;
					}
					//file upload
					$this->upload->initialize(array(
						'upload_path' => $upload_path,
						'allowed_types' => 'jpeg|jpg|png|bmp|gif|zip|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|txt',
						'file_ext_tolower' => true,
						'optional' => true,
						'overwrite' => true,
						'max_size' => 8 * 1024
					));
					if (!$this->upload->do_upload('file')) 
					{
						$data = array(
							'memberC' => $this->Newsletter->get_count("member")->result_array()[0],
							'partnerC' => $this->Newsletter->get_count("partner")->result_array()[0],
							'employeeC' => $this->Newsletter->get_count("employee")->result_array()[0],
						);
						$data['file_error'] = $this->upload->display_errors();
						
						// Delete the post because an error happened
						$this->Newsletter->delete_newsletter($newsletter_id);

						$this->load->view('admin/applications/newsletter/create-newsletter', $data);

						return;
					}

					if ($this->upload->data()['file_size'] != NULL) 
					{
						$attachment_url = $upload_path . $this->upload->data()['file_name'];
					} 
					else 
					{
						$attachment_url = NULL;
					}

					if (!$this->Newsletter->edit_newsletter($newsletter_id, array('image_url' => $image_url, 'attachment_url' => $attachment_url))) 
					{
						// Delete the post because an error happened
						$this->Newsletter->delete_newsletter($newsletter_id);

						// Delete the uploaded image because an error happened
						if ($this->upload->data()['file_size'] != NULL) 
						{
							unlink($image_url);
						}

						$message = array(
							'type' => 'error',
							'message' => 'Ihr Newsletter <strong>'. $subject .'</strong> konnte nicht erstellt werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}

					$message = array(
						'type' => 'success',
						'message' => 'Ihr Newsletter <strong>'. $subject .'</strong> wurde erfolgreich erstellt.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} 
				else 
				{
					$data = array(
						'memberC' => $this->Newsletter->get_count("member")->result_array()[0],
						'partnerC' => $this->Newsletter->get_count("partner")->result_array()[0],
						'employeeC' => $this->Newsletter->get_count("employee")->result_array()[0],
					);
					
					$this->load->view('admin/applications/newsletter/create-newsletter', $data);
				}

				return;
			case 'edit-newsletter':
				$query = $this->Newsletter->get_newsletter_id($newsletter_id);

				if ($query->num_rows() != 1) 
				{
					$message = array(
						'type' => 'error',
						'message' => 'Der Newsletter kann nicht bearbeitet werden: Der Newsletter konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$newsletter = $query->first_row();

				$data = array(
					'id' => $newsletter_id,
					'subject' => $newsletter->newsletter_subject,
					'text' => $newsletter->newsletter_text,
					'image_url' => !empty($newsletter->newsletter_image_url) ? base_url().$newsletter->newsletter_image_url : '',
					'attachment_url' => !empty($newsletter->newsletter_attachment_url) ? base_url().$newsletter->newsletter_attachment_url : '',
					'member' => $newsletter->newsletter_to_member,
					'partner' => $newsletter->newsletter_to_partner,
					'employee' => $newsletter->newsletter_to_employee,
					'memberC' => $this->Newsletter->get_count("member")->result_array()[0],
					'partnerC' => $this->Newsletter->get_count("partner")->result_array()[0],
					'employeeC' => $this->Newsletter->get_count("employee")->result_array()[0],
				);
				

				// Request from: application/views/admin/appilications/newsletter/edit-newsletter.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) 
				{
					if ($this->form_validation->run('newsletter/edit-newsletter') == FALSE) 
					{
						$this->load->view('admin/applications/newsletter/edit-newsletter', $data);
						return;
					}

					$data = array(
						'id' => $newsletter_id,
						'subject' => html_escape($this->input->post('subject')),
						'text' => html_escape($this->input->post('text')),
						'image_url' => !empty($newsletter->newsletter_image_url) ? base_url().$newsletter->newsletter_image_url : '',
						'attachment_url' => !empty($newsletter->newsletter_attachment_url) ? base_url().$newsletter->newsletter_attachment_url : '',
						'member' => html_escape($this->input->post('member')),
						'partner' => html_escape($this->input->post('partner')),
						'employee' => html_escape($this->input->post('employee')),
						'memberC' => $this->Newsletter->get_count("member")->result_array()[0],
						'partnerC' => $this->Newsletter->get_count("partner")->result_array()[0],
						'employeeC' => $this->Newsletter->get_count("employee")->result_array()[0],
					);

					// TODO: Make path absolute? (with asset_url function)
					$upload_path = 'assets/images/admin/newsletter/'. $newsletter_id .'/';

					if (!create_directory($upload_path, 0777, true)) 
					{
						$data['image_error'] = 'Die Datei konnte nicht hochgeladen werden: Der Ordner konnte nicht erstellt werden.';

						$this->load->view('admin/applications/newsletter/edit-newsletter', $data);

						return;
					}
					//image upload
					$this->upload->initialize(array(
						'upload_path' => $upload_path,
						'allowed_types' => 'jpeg|jpg|png',
						//'file_name' => uniqid($post_id .'i'),
						'file_ext_tolower' => true,
						'optional' => true,
						'overwrite' => true,
						'max_size' => 4 * 1024,
						'max_width' => 2048,
						'max_height' => 2048,
					));

					if (!$this->upload->do_upload('image')) 
					{
						$data['image_error'] = $this->upload->display_errors();

						$this->load->view('admin/applications/newsletter/edit-newsletter', $data);

						return;
					}

					if ($this->upload->data()['file_size'] != NULL) {
						unlink($newsletter->newsletter_image_url);
						$data['image_url'] = $upload_path . $this->upload->data()['file_name'];
					}
					else 
					{
						$data['image_url'] = $newsletter->newsletter_image_url;
					}
					//file upload
					$this->upload->initialize(array(
						'upload_path' => $upload_path,
						'allowed_types' => 'jpeg|jpg|png|bmp|gif|zip|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|txt',
						'file_ext_tolower' => true,
						'optional' => true,
						'overwrite' => true,
						'max_size' => 8 * 1024
					));

					if (!$this->upload->do_upload('file')) 
					{
						$data['file_error'] = $this->upload->display_errors();

						$this->load->view('admin/applications/newsletter/edit-newsletter', $data);

						return;
					}

					if ($this->upload->data()['file_size'] != NULL) {
						unlink($newsletter->newsletter_attachment_url);
						$data['attachment_url'] = $upload_path . $this->upload->data()['file_name'];
					}
					else 
					{
						$data['attachment_url'] = $newsletter->newsletter_attachment_url;
					}

					if ($this->Newsletter->edit_newsletter($newsletter_id, $data)) 
					{
						$message = array(
							'type' => 'success',
							'message' => 'Sie haben Ihren Newsletter <strong>'. $newsletter->newsletter_subject .'</strong> erfolgreich bearbeitet.',
							'on_close' => 'reload',
						);

						$this->load->view('elements/modal-alert', $message);
					} 
					else 
					{
						// Delete the uploaded image because an error happened
						if ($this->upload->data()['file_size'] != NULL) 
						{
							unlink($data['image_url']);
							unlink($data['attachment_url']);
						}

						$message = array(
							'type' => 'error',
							'message' => 'Der Newsletter kann nicht bearbeitet werden.',
						);

						$this->load->view('elements/modal-alert', $message);
					}
				} 
				else 
				{
					$this->load->view('admin/applications/newsletter/edit-newsletter', $data);
				}

				return;
			case 'delete-newsletter':
				$query = $this->Newsletter->get_newsletter_id($newsletter_id);

				if ($query->num_rows() != 1) 
				{
					$message = array(
						'type' => 'error',
						'message' => 'Der Newsletter kann nicht gelöscht werden: Der Newsletter konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$newsletter = $query->first_row();

				// Request from: application/views/admin/appilications/newsletter/delete-newsletter.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) 
				{
					if (!$this->Newsletter->delete_newsletter($newsletter_id)) 
					{
						$message = array(
							'type' => 'error',
							'message' => 'Der Newsletter konnte nicht gelöscht werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}

					// Delete the old image
					if ($newsletter->newsletter_image_url != NULL) 
					{
						unlink($newsletter->newsletter_image_url);
					}
					
					$message = array(
						'type' => 'success',
						'message' => 'Ihr Newsletter <strong>'. $newsletter->newsletter_subject .'</strong> wurde erfolgreich gelöscht.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} 
				else 
				{
					$data = array(
						'id' => $newsletter_id,
						'subject' => $newsletter->newsletter_subject,
					);

					$this->load->view('admin/applications/newsletter/delete-newsletter', $data);
				}

				return;
			case 'preview-newsletter':
				// Request from: application/views/partner/appilications/feed/create-post.php or edit-post.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) 
				{
					$subject = html_escape($this->input->post('subject'));
					$text = $this->input->post('text'); //Da <strong> sonst nicht geht, musste html_escape weg

					$data = array(
						'date' => date('d.m.Y'),
						'title' => $subject,
						'media_tag' => '',
						'text' => nl2br(str_replace("<img>", "<strong>Position des Bildes</strong>", $text)),
					);

					echo $this->parser->parse('template/newsletter/newsletter', $data, true);
				}
				
				return;
			case 'send-newsletter':
				$query = $this->Newsletter->get_newsletter_id($newsletter_id);

				if ($query->num_rows() != 1) 
				{
					$message = array(
						'type' => 'error',
						'message' => 'Der Newsletter kann nicht gesendet werden: Der Newsletter konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$newsletter = $query->first_row();
				
				if($newsletter->newsletter_to_member == 0 && $newsletter->newsletter_to_partner == 0 && $newsletter->newsletter_to_employee == 0)
				{
					$message = array(
						'type' => 'error',
						'message' => 'Der Newsletter kann nicht gesendet werden: Der Newsletter hat keine Empfänger.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				// Request from: application/views/admin/appilications/newsletter/send-newsletter.php
				// with $_POST data set
				if ($this->input->post('form') != NULL)  
				{
					$counterM = 0;
					$counterP = 0;
					$counterE = 0;
					
					$config = Array(
						'protocol'	=> 'smtp',
						'smtp_host'	=> 'smtp.world4you.com',
						'smtp_port'	=> 587,
						'smtp_user'	=> 'newsletter@primus-romulus.net',
						'smtp_pass'	=> 'ogfieR5=',
						'mailtype'	=> 'html',
						'charset'	=> 'utf-8', // iso-8859-1
						'starttls'	=> true,
					);

					$this->email->initialize($config);
					
					$text = "";
					$makeattachment = false;
					if(!empty($newsletter->newsletter_image_url))
					{
						if(strpos($newsletter->newsletter_image_url, '&lt;img&gt;') !== FALSE) //contains <img> in text
						{
							$text = str_replace("&lt;img&gt;", '<img src="'. base_url() . '/' . $newsletter->newsletter_image_url .'">', $newsletter->newsletter_text);
						}
						else
						{
							$text = $newsletter->newsletter_text;
							$makeattachment = true;
						}
					}
					else
						$text = $newsletter->newsletter_text;
					
					// An alle Member
					if($newsletter->newsletter_to_member == 1)
					{
						$query = $this->Newsletter->get_users('member');
				
						foreach($query->result() as $row)
						{
							$this->email->from('newsletter@primus-romulus.net', 'Primus Romulus Newsletter');
							$this->email->to($row->user_email);
							$this->email->subject($newsletter->newsletter_subject);
							if($makeattachment)
								$this->email->attach($newsletter->newsletter_image_url);
							if(!empty($newsletter->newsletter_attachment_url))
								$this->email->attach($newsletter->newsletter_attachment_url);

							$email_data = array(
								'salutation' => 'Hallo '. $row->member_firstname .'!',
								'subject' => $newsletter->newsletter_subject,
								'text' => nl2br($text),
							);
							
							$this->email->message($this->parser->parse('template/email/newsletter', $email_data, true));
							
							$this->email->send();
							$this->email->clear(true);
							$counterM++;
						}
					}
					
					// An alle Employees
					if($newsletter->newsletter_to_employee == 1)
					{
						$query = $this->Newsletter->get_users('employee');
						
						foreach($query->result() as $row)
						{
							$this->email->from('newsletter@primus-romulus.net', 'Primus Romulus Newsletter');
							$this->email->to($row->user_email);
							$this->email->subject($newsletter->newsletter_subject);
							if($makeattachment)
								$this->email->attach($newsletter->newsletter_image_url);
							if(!empty($newsletter->newsletter_attachment_url))
								$this->email->attach($newsletter->newsletter_attachment_url);
							
							$email_data = array(
								'salutation' => 'Hallo '. $row->employee_firstname .'!',
								'subject' => $newsletter->newsletter_subject,
								'text' => nl2br($text),
							);
							$this->email->message($this->parser->parse('template/email/newsletter', $email_data, true));
							
							$this->email->send();
							$this->email->clear(true);
							$counterE++;
						}
					}
					
					// An alle Partner
					if($newsletter->newsletter_to_partner == 1)
					{
						$query = $this->Newsletter->get_users('partner');
						
						foreach($query->result() as $row)
						{
							$this->email->from('newsletter@primus-romulus.net', 'Primus Romulus Newsletter');
							$this->email->to($row->user_email);
							$this->email->subject($newsletter->newsletter_subject);
							if($makeattachment)
								$this->email->attach($newsletter->newsletter_image_url);
							if(!empty($newsletter->newsletter_attachment_url))
								$this->email->attach($newsletter->newsletter_attachment_url);
							
							$email_data = array(
								'salutation' => 'Hallo '. $row->company_name .'!',
								'subject' => $newsletter->newsletter_subject,
								'text' => nl2br($text),
							);
							$this->email->message($this->parser->parse('template/email/newsletter', $email_data, true));
							
							$this->email->send();
							$this->email->clear(true);
							$counterP++;
						}
					}
					$counter = $counterM + $counterP + $counterE;
					if ($counter > 0) 
					{
						$data = array(
							'count_recipients' => $counter,
							'send' => 'NOW()',
						);
						
						$this->Newsletter->edit_newsletter($newsletter->newsletter_id, $data);
						
						
						$message = array(
							'type' => 'success',
							'message' => 'Ihr Newsletter <strong>'. $newsletter->newsletter_subject .'</strong> wurde erfolgreich an ' . $counterM . ' Member, ' . $counterP . ' Partner und ' . $counterE . ' Employee(s) gesendet.',
							'on_close' => 'reload',
						);

						$this->load->view('elements/modal-alert', $message);
					}
					else
					{
						$message = array(
							'type' => 'error',
							'message' => 'Nachricht wurde nicht versendet.',
						);

						$this->load->view('elements/modal-alert', $message);
					}
				} 
				else 
				{
					$empfänger = "";
					if($newsletter->newsletter_to_member == 1)
						$empfänger .= "<br />Member";
					if($newsletter->newsletter_to_partner == 1)
						$empfänger .= "<br />Partner";
					if($newsletter->newsletter_to_employee == 1)
						$empfänger .= "<br />Employee";
					$img = "";
					if(!empty($newsletter->newsletter_image_url))
					{
						$text = str_replace("&lt;img&gt;", '<img src="/'. $newsletter->newsletter_image_url .'">', $newsletter->newsletter_text);
						$imgfield = explode('/', $newsletter->newsletter_image_url);
						$img = $imgfield[sizeof($imgfield)-1];
					}
					$file = "";
					if(!empty($newsletter->newsletter_attachment_url))
					{
						$filefield = explode('/', $newsletter->newsletter_attachment_url);
						$file = $filefield[sizeof($filefield)-1];
					}
					
					$data = array(
						'id' => $newsletter_id,
						'subject' => $newsletter->newsletter_subject,
						'text' => $text,
						'empfänger' => $empfänger,
						'image' => $img,
						'file' => $file,
					);

					$this->load->view('admin/applications/newsletter/send-newsletter', $data);
				}
				

				return;
		}
		
		$header_data = array(
			'title' => 'Primus Romulus - Admin Panel - Newsletter', 
			'page' => 'admin',
			'subpage' => 'newsletter',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('admin/header', $header_data);
		
		$this->load->view('admin/applications/newsletter');
		
		$this->load->view('elements/footer');
	}
	
	public function memberfunction($action = '', $user_id = '', $memberblocking_id = '')
	{
		if(!$this->session->admin['logged_in']) 
		{
			redirect(base_url() . 'admin/index');
		}
		
		// Ensure that edit-post and delete-post have a post_id set, which is a positive integer
		if (($action == 'activate' || $action == 'ban' || $action == 'unban') && (!isset($user_id) || !ctype_digit($user_id) || $user_id <= 0) || ($action == 'unban' && (!isset($memberblocking_id) || !ctype_digit($memberblocking_id) || $memberblocking_id <= 0))) 
		{
			$action = '';
		}
		
		switch($action)
		{
			case 'activate':
				$query = $this->Admin->get_user_with_id($user_id);

				if ($query->num_rows() != 1) 
				{
					$message = array(
						'type' => 'error',
						'message' => 'Benutzer mit dieser ID wurde in der Datenbank nicht gefunden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$user = $query->first_row();

				$data = array(
					'id' => $user_id,
					'email' => $user->user_email,
					'vorname' => $user->member_firstname,
					'nachname' => $user->member_lastname,
				);
				
				if ($this->input->post('form') != NULL) 
				{
					if (!$this->Admin->activate_user($user_id)) 
					{
						$message = array(
							'type' => 'error',
							'message' => 'Fehler beim Freigeben des Benutzers',
						);

						$this->load->view('elements/modal-alert', $message);
						return;
					}
					
					$message = array(
						'type' => 'success',
						'message' => 'Der Benutzer wurde erfolgreich freigegeben.',
						'on_close' => 'reload',
					);

					// Send Mail to user after activation

					$config = Array(
					'protocol'	=> 'smtp',
					'smtp_host'	=> 'smtp.world4you.com',
					'smtp_port'	=> 587,
					'smtp_user'	=> 'noreply@primus-romulus.net',
					'smtp_pass'	=> 'maborD8*',
					'mailtype'	=> 'html',
					'charset'	=> 'utf-8', // iso-8859-1
					'starttls'	=> true,
				);

				$this->email->initialize($config);
				$this->email->from('noreply@primus-romulus.net', 'Primus Romulus');
				$this->email->to($user->user_email);

				$this->email->subject('Registrierung bei Primus Romulus');

				$email_data = array(
					'salutation' => 'Hallo '. $user->member_firstname .'!',
				);

				$this->email->message($this->parser->parse('template/email/member/account-activated', $email_data, true));

				$this->email->send();

					$this->load->view('elements/modal-alert', $message);
				} 
				else 
				{
					$this->load->view('admin/applications/memberfunction/activate', $data);
				}
			return;
			
			case 'ban':
				$query = $this->Admin->get_user_with_id($user_id);

				if ($query->num_rows() != 1) 
				{
					$message = array(
						'type' => 'error',
						'message' => 'Benutzer mit dieser ID wurde in der Datenbank nicht gefunden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$user = $query->first_row();

				$data = array(
					'id' => $user_id,
					'email' => $user->user_email,
					'vorname' => $user->member_firstname,
					'nachname' => $user->member_lastname,
				);

				// Request from: application/views/admin/appilications/newsletter/edit-newsletter.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) 
				{
					if ($this->form_validation->run('memberfunction/ban') == FALSE) 
					{
						$this->load->view('admin/applications/memberfunction/ban', $data);

						return;
					}
					
					if ($this->Admin->lock_account($user_id, html_escape($this->input->post('duration')), html_escape($this->input->post('reason')))) 
					{

						$message = array(
							'type' => 'success',
							'message' => 'Sie haben den Benutzer ' . $data['vorname'] . ' ' . $data['nachname'] . ' erfolgreich gesperrt.',
							'on_close' => 'reload',
						);

						$this->load->view('elements/modal-alert', $message);
					} 
					else 
					{
						$message = array(
							'type' => 'error',
							'message' => 'Benutzer konnte nicht gesperrt werden.',
						);

						$this->load->view('elements/modal-alert', $message);
					}
				} 
				else 
				{
					$this->load->view('admin/applications/memberfunction/ban', $data);
				}
			return;
			case 'unban':
				$query = $this->Admin->get_user_with_ban_id($memberblocking_id);

				if ($query->num_rows() != 1) 
				{
					$message = array(
						'type' => 'error',
						'message' => 'Benutzer mit dieser ID wurde in der Datenbank nicht gefunden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$user = $query->first_row();

				$data = array(
					'user_id' => $user_id,
					'email' => $user->user_email,
					'vorname' => $user->member_firstname,
					'nachname' => $user->member_lastname,
					'memberblocking_id' => $user->memberblocking_id,
					'startdate' => date('d.m.Y H:i', strtotime($user->memberblocking_start_date)),
					'enddate' => date('d.m.Y H:i', strtotime($user->memberblocking_end_date)) == '01.01.1970 01:00' ? 'dauerhaft' : date('d.m.Y H:i', strtotime($user->memberblocking_end_date)),
					'reason' => $user->memberblocking_reason,
				);

				// Request from: application/views/admin/appilications/newsletter/edit-newsletter.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) 
				{					
					if ($this->Admin->delete_ban_with_ban_id($memberblocking_id)) 
					{

						$message = array(
							'type' => 'success',
							'message' => 'Sie haben den Benutzer ' . $data['vorname'] . ' ' . $data['nachname'] . ' erfolgreich entsperrt.',
							'on_close' => 'reload',
						);

						$this->load->view('elements/modal-alert', $message);
					} 
					else 
					{
						$message = array(
							'type' => 'error',
							'message' => 'Benutzer konnte nicht entsperrt werden.',
						);

						$this->load->view('elements/modal-alert', $message);
					}
				} 
				else 
				{
					$this->load->view('admin/applications/memberfunction/unban', $data);
				}
			return;
			case 'allmember':
				$header_data = array(
					'title' => 'Primus Romulus - Admin Panel - Alle Member', 
					'page' => 'admin',
					'subpage' => 'memberfunction',
				);

				$this->load->view('elements/header', $header_data);
				$this->load->view('admin/header', $header_data);
				
				$this->load->view('admin/applications/all-member');
				
				$this->load->view('elements/footer');
			return;
			case 'allbanned':
				$header_data = array(
					'title' => 'Primus Romulus - Admin Panel - Alle gebannten Member', 
					'page' => 'admin',
					'subpage' => 'memberfunction',
				);

				$this->load->view('elements/header', $header_data);
				$this->load->view('admin/header', $header_data);
				
				$this->load->view('admin/applications/all-banned');
				
				$this->load->view('elements/footer');
			return;
		}
		
		
		$header_data = array(
			'title' => 'Primus Romulus - Admin Panel - Member', 
			'page' => 'admin',
			'subpage' => 'memberfunction',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('admin/header', $header_data);
		
		$this->load->view('admin/applications/member-activation');
		
		$this->load->view('elements/footer');
	}
	
	public function partnerfunction($action = '', $company_id = '')
	{
		if(!$this->session->admin['logged_in']) 
		{
			redirect(base_url() . 'admin/index');
		}
		
		// Ensure that edit-post and delete-post have a post_id set, which is a positive integer
		if (($action == 'delete' || $action == 'edit-partner') && (!isset($user_id) || !ctype_digit($user_id) || $user_id <= 0)) 
		{
			$action = '';
		}
		
		switch ($action) 
		{
			case 'create-partner':
				// with $_POST data set
				if ($this->input->post('form') != NULL) 
				{
					$email = html_escape($this->input->post('email'));
					$password = html_escape($this->input->post('password'));
					$packet = html_escape($this->input->post('packet'));
					$companyname = html_escape($this->input->post('company-name'));
					$name = html_escape($this->input->post('name'));
					$street = html_escape($this->input->post('street'));
					$zipcode = html_escape($this->input->post('zipcode'));
					$city = html_escape($this->input->post('city'));
					$country = html_escape($this->input->post('country'));
					
					if ($this->form_validation->run('partnerfunction/create-partner') == FALSE) 
					{
						$this->load->view('admin/applications/partnerfunction/create-partner');
						return;
					}
					
					// Create the location in the database
					$location_id = $this->Location->create_location_short($name, $street, $zipcode, $city, $country);
					
					if ($location_id <= 0) {

						$message = array(
							'type' => 'error',
							'message' => 'Der Partner mit der E-Mail <strong>'. $email .'</strong> konnte nicht erstellt werden: Fehler beim erstellen des Standorts',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}
				
					$id = $this->Admin->create_partner($email, $password, $packet, $companyname, $location_id);

					if ($id <= 0) 
					{					
						$this->Location->delete_location($location_id);
						$message = array(
							'type' => 'error',
							//'message' => $email.':'.$password.':'.$packet.':'.$companyname.':'.$location_id,
							'message' => $id == -1 ? 'Der Partner mit der E-Mail <strong>'. $email .'</strong> konnte nicht erstellt werden: Fehler beim erstellen des Benutzers' : 'Der Partner mit der E-Mail <strong>'. $email .'</strong> konnte nicht erstellt werden: Fehler beim erstellen der Firma',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}
					
					if(!$this->Location->add_company_id_to_location($location_id, $id))
					{
						$this->Location->delete_location($location_id);
						$this->Admin->delete_partner($id);
						$message = array(
							'type' => 'error',
							'message' => 'Der Partner mit der E-Mail <strong>'. $email .'</strong> konnte nicht erstellt werden: Fehler beim ändern der Location ID',
						);

						$this->load->view('elements/modal-alert', $message);
					}
					
					
					$message = array(
						'type' => 'success',
						'message' => 'Der Partner mit der E-Mail <strong>'. $email .'</strong> wurde erfolgreich registriert.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} 
				else 
				{
					$this->load->view('admin/applications/partnerfunction/create-partner');
				}

			return;
			case 'edit-partner':
				$query = $this->Admin->get_all_partner_with_id($company_id);

				if ($query->num_rows() != 1) 
				{
					$message = array(
						'type' => 'error',
						'message' => 'Der Partner kann nicht gelöscht werden: Der Partner konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$company = $query->first_row();

				$data = array(
					'id' => $company_id,
					'email' => $company->user_email,
					'company_name' => $company->company_name,
					'packet' => $company->companypacket_id,
				);
				
				// with $_POST data set
				if ($this->input->post('form') != NULL) 
				{
					if ($this->form_validation->run('partnerfunction/edit-partner') == FALSE) 
					{
						$this->load->view('admin/applications/partnerfunction/edit-partner', $data);
						return;
					}
					
					$data = array(
						'id' => $company_id,
						'email' => html_escape($this->input->post('email')),
						'password' => html_escape($this->input->post('password')),
						'packet' => html_escape($this->input->post('packet')),
						'companyname' => html_escape($this->input->post('company-name')),
					);

					if ($this->Admin->edit_partner($company_id, $data)) 
					{
						$message = array(
							'type' => 'success',
							'message' => 'Sie haben den Partner <strong>'. $company->company_name .'</strong> erfolgreich bearbeitet.',
							'on_close' => 'reload',
						);

						$this->load->view('elements/modal-alert', $message);
					} 
					else 
					{
						$message = array(
							'type' => 'error',
							'message' => 'Der Partner kann nicht bearbeitet werden.',
						);

						$this->load->view('elements/modal-alert', $message);
					}
				} 
				else 
				{
					$this->load->view('admin/applications/partnerfunction/edit-partner', $data);
				}

			return;
			case 'delete-partner':
				$query = $this->Admin->get_all_partner_with_id($company_id);

				if ($query->num_rows() != 1) 
				{
					$message = array(
						'type' => 'error',
						'message' => 'Der Partner kann nicht gelöscht werden: Der Partner konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$company = $query->first_row();

				// Request from: application/views/admin/appilications/newsletter/delete-newsletter.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) 
				{
					if (!$this->Admin->delete_partner($company_id)) 
					{
						$message = array(
							'type' => 'error',
							'message' => 'Der Partner konnte nicht gelöscht werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}
					
					$message = array(
						'type' => 'success',
						'message' => 'Der Partner <strong>'. $company->company_name .'</strong> wurde erfolgreich gelöscht.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} 
				else 
				{
					$data = array(
						'id' => $company_id,
						'company_name' => $company->company_name,
						'company_mail' => $company->user_email,
					);

					$this->load->view('admin/applications/partnerfunction/delete-partner', $data);
				}

			return;
		}
		
		
		
		$header_data = array(
			'title' => 'Primus Romulus - Admin Panel - Partner', 
			'page' => 'admin',
			'subpage' => 'createpartner',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('admin/header', $header_data);
		
		$this->load->view('admin/applications/partner');
		
		$this->load->view('elements/footer');
	}
	
	public function event($action = '', $event_id = '')
	{
		if(!$this->session->admin['logged_in']) 
		{
			redirect(base_url() . 'admin/index');
		}

		if (($action == 'delete-event' || $action == 'edit-event' || $action == 'show-member') && (!isset($event_id) || !ctype_digit($event_id) || $event_id <= 0)) 
		{
			$action = '';
		}
		
		switch ($action) 
		{
			case 'create-event':
				$data = array(
					'eventtype' => $this->Event->get_event_types()->result(),
					'member' => $this->Member->get_member('all')->result(),
				);
				
				// Request from: application/views/admin/appilications/newsletter/create-newsletter.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) 
				{
					$event_name = html_escape($this->input->post('name'));
					$description = html_escape($this->input->post('description'));
					$startdate = DateTime::createFromFormat('d.m.Y H:i', html_escape($this->input->post('startdate')))->format('Y-m-d H:i');
					$enddate = !empty($this->input->post('enddate')) ? DateTime::createFromFormat('d.m.Y H:i', html_escape($this->input->post('enddate')))->format('Y-m-d H:i') : "";
					$street = html_escape($this->input->post('street'));
					$zipcode = html_escape($this->input->post('zipcode'));
					$city = html_escape($this->input->post('city'));
					$country = html_escape($this->input->post('country'));
					$leader = html_escape($this->input->post('leader'));
					$eventtype = html_escape($this->input->post('eventtype'));
					$maxmember = html_escape($this->input->post('maxmember'));
					
					if ($this->form_validation->run('event/create-event') == FALSE) 
					{
						$this->load->view('admin/applications/event/create-event', $data);
						return;
					}
					
					$event_id = $this->Event->create_event($event_name, $street, $zipcode, $city, $country, $description, $startdate, $enddate, $leader, $eventtype, $maxmember);
					
					if($event_id <= 0)
					{
						$message = array(
							'type' => 'error',
							'message' => 'Ihr Event <strong>'. $event_name .'</strong> konnte nicht erstellt werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}
					
					$message = array(
						'type' => 'success',
						'message' => 'Ihr Event <strong>'. $event_name .'</strong> wurde erfolgreich erstellt.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} 
				else 
				{					
					$this->load->view('admin/applications/event/create-event', $data);
				}

			return;
			case 'create-eventtype':
				if ($this->input->post('form') != NULL) 
				{
					$name = html_escape($this->input->post('name'));
					
					if ($this->form_validation->run('event/create-eventtype') == FALSE) 
					{
						$this->load->view('admin/applications/event/create-eventtype');
						return;
					}
					
					$eventtype_id = $this->Event->create_eventtype($name);
					
					if($eventtype_id <= 0)
					{
						$message = array(
							'type' => 'error',
							'message' => 'Ihr EventType <strong>'. $name .'</strong> konnte nicht erstellt werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}
					
					$message = array(
						'type' => 'success',
						'message' => 'Ihr EventType <strong>'. $name .'</strong> wurde erfolgreich erstellt.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				}
				else 
				{					
					$this->load->view('admin/applications/event/create-eventtype');
				}
			return;
			case 'show-member':
				$query = $this->Event->get_participants($event_id);

				if ($query->num_rows() == 0) 
				{
					$message = array(
						'type' => 'error',
						'message' => 'Das Event kann nicht geladen werden: Es gibt keine Teilnehmer.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}
				
				$data = array(
					'members' => $query,
				);

				$this->load->view('admin/applications/event/show-member', $data);
			return;
			case 'edit-event':
				$query = $this->Event->get_event_with_id($event_id);

				if ($query->num_rows() != 1) 
				{
					$message = array(
						'type' => 'error',
						'message' => 'Das Event kann nicht bearbeitet werden: Das Event konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$event = $query->first_row();

				$data = array(
					'id' => $event_id,
					'name' => $event->event_name,
					'description' => $event->event_description,
					'startdate' =>date('d.m.Y H:i', strtotime($event->event_start_date)),
					'enddate' => date('d.m.Y H:i', strtotime($event->event_end_date)) == '01.01.1970 01:00' ? '' : date('d.m.Y H:i', strtotime($event->event_end_date)),
					'street' => $event->address_street,
					'zipcode' => $event->address_zipcode,
					'city' => $event->address_city,
					'country' => $event->country_id,
					'leader' => $event->leader_id,
					'eventtype_id' => $event->eventtype_id,
					'eventtype' => $this->Event->get_event_types()->result(),
					'member' => $this->Member->get_member('all')->result(),
					'maxmember' => $event->event_max_member,
				);
				

				// Request from: application/views/admin/appilications/newsletter/edit-newsletter.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) 
				{
					if ($this->form_validation->run('event/edit-event') == FALSE) 
					{
						$this->load->view('admin/applications/event/edit-event', $data);
						return;
					}

					$data = array(
						'id' => $event_id,
						'name' => html_escape($this->input->post('name')),
						'description' => html_escape($this->input->post('description')),
						'startdate' => DateTime::createFromFormat('d.m.Y H:i', html_escape($this->input->post('startdate')))->format('Y-m-d H:i'),
						'enddate' => !empty($this->input->post('enddate')) ? DateTime::createFromFormat('d.m.Y H:i', html_escape($this->input->post('enddate')))->format('Y-m-d H:i') : "",
						'street' => html_escape($this->input->post('street')),
						'zipcode' => html_escape($this->input->post('zipcode')),
						'city' => html_escape($this->input->post('city')),
						'country' => html_escape($this->input->post('country')),
						'leader' => html_escape($this->input->post('leader')),
						'eventtype' => html_escape($this->input->post('eventtype')),
						'maxmember' => html_escape($this->input->post('maxmember')),
					);

					if ($this->Event->edit_event($event_id, $data)) 
					{
						$message = array(
							'type' => 'success',
							'message' => 'Sie haben das Event <strong>'. $event->event_name .'</strong> erfolgreich bearbeitet.',
							'on_close' => 'reload',
						);

						$this->load->view('elements/modal-alert', $message);
					} 
					else 
					{
						$message = array(
							'type' => 'error',
							'message' => 'Das Event kann nicht bearbeitet werden.',
						);

						$this->load->view('elements/modal-alert', $message);
					}
				} 
				else 
				{
					$this->load->view('admin/applications/event/edit-event', $data);
				}

				return;
			case 'delete-event':
				$query = $this->Event->get_event_with_id($event_id);

				if ($query->num_rows() != 1) 
				{
					$message = array(
						'type' => 'error',
						'message' => 'Das Event kann nicht bearbeitet werden: Das Event konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$event = $query->first_row();

				// Request from: application/views/admin/appilications/newsletter/delete-newsletter.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) 
				{
					if (!$this->Event->delete_event($event_id)) 
					{
						$message = array(
							'type' => 'error',
							'message' => 'Das Event konnte nicht gelöscht werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}
					
					$message = array(
						'type' => 'success',
						'message' => 'Das Event <strong>'. $event->event_name .'</strong> wurde erfolgreich gelöscht.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} 
				else 
				{
					$data = array(
						'id' => $event_id,
						'subject' => $event->event_name,
					);

					$this->load->view('admin/applications/event/delete-event', $data);
				}

			return;
		}
		
		$header_data = array(
			'title' => 'Primus Romulus - Admin Panel - Events', 
			'page' => 'admin',
			'subpage' => 'event',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('admin/header', $header_data);
		
		$this->load->view('admin/applications/event');
		
		$this->load->view('elements/footer');
	}
	
	public function news($action = '', $news_id = '')
	{
		if(!$this->session->admin['logged_in']) 
		{
			redirect(base_url() . 'admin/index');
		}

		if (($action == 'edit-news' || $action == 'delete-news' || $action == 'upload-images') && (!isset($news_id) || !ctype_digit($news_id) || $news_id < 0)) 
		{
			$action = '';
		}
		
		switch ($action) 
		{
			case 'create-news':
				// Request from: application/views/admin/appilications/newsletter/create-newsletter.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) 
				{
					$title = html_escape($this->input->post('title'));
					$text = html_escape($this->input->post('text'));

					if ($this->form_validation->run('news/create-news') == FALSE) 
					{
						$this->load->view('admin/applications/news/create-news');
						return;
					}

					// Create the post in the database to get the id for the image upload
					$news_id = $this->News->create_news($title, $text);

					$upload_path = 'assets/images/news/' . $news_id . '/';

					if (!create_directory($upload_path, 0777, true)) 
					{
						$this->load->view('admin/applications/news/create-news', array(
							'image_error' => 'Die Datei konnte nicht hochgeladen werden: Der Ordner konnte nicht erstellt werden.',
						));
						return;
					}
					
					if ($news_id <= 0) 
					{
						$message = array(
							'type' => 'error',
							'message' => 'Die News <strong>'. $title .'</strong> konnten nicht erstellt werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}
					
					//Title-Image Upload
					$this->upload->initialize(array(
						'upload_path' => $upload_path,
						'allowed_types' => 'jpeg|jpg|png',
						'file_name' => '1',
						'file_ext_tolower' => true,
						'optional' => true,
						'overwrite' => true,
						'max_size' => 4 * 1024,
						'max_width' => 2048,
						'max_height' => 2048,
					));

					if (!$this->upload->do_upload('image')) 
					{
						$data['image_error'] = $this->upload->display_errors();
						
						// Delete the post because an error happened
						$this->News->delete_news($news_id);

						$this->load->view('admin/applications/news/create-news', $data);

						return;
					}

					if ($this->upload->data()['file_size'] != NULL) 
					{
						$image_url = $upload_path . $this->upload->data()['file_name'];
					} 
					else 
					{
						$image_url = NULL;
					}

					if (!$this->News->edit_news($news_id, array('image_url' => $image_url, 'images_folder_url' => $upload_path))) 
					{
						// Delete the post because an error happened
						$this->News->delete_news($news_id);

						// Delete the uploaded image because an error happened
						if ($this->upload->data()['file_size'] != NULL) 
						{
							unlink($image_url);
						}

						$message = array(
							'type' => 'error',
							'message' => 'Ihre News <strong>'. $title .'</strong> konnten nicht erstellt werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}
					

					$message = array(
						'type' => 'success',
						'message' => 'Ihre News <strong>'. $title .'</strong> wurden erfolgreich erstellt.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} 
				else 
				{
					$this->load->view('admin/applications/news/create-news');
				}

				return;
			case 'edit-news':
				$query = $this->News->get_news('filter:id', $news_id);

				if ($query->num_rows() != 1) 
				{
					$message = array(
						'type' => 'error',
						'message' => 'Die News können nicht bearbeitet werden: Die News konnten nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$news = $query->first_row();

				$data = array(
					'id' => $news_id,
					'title' => $news->news_title,
					'text' => $news->news_text,
					'image_url' => !empty($news->news_banner_image_url) ? base_url().$news->news_banner_image_url : '',
				);
				

				// with $_POST data set
				if ($this->input->post('form') != NULL) 
				{
					if ($this->form_validation->run('news/edit-news') == FALSE) 
					{
						$this->load->view('admin/applications/news/edit-news', $data);
						return;
					}

					$data = array(
						'id' => $news_id,
						'title' => html_escape($this->input->post('title')),
						'text' => html_escape($this->input->post('text')),
						'image_url' => !empty($news->news_banner_image_url) ? base_url().$news->news_banner_image_url : '',
					);

					// TODO: Make path absolute? (with asset_url function)
					$upload_path = 'assets/images/news/'. $news_id .'/';

					if (!create_directory($upload_path, 0777, true)) 
					{
						$data['image_error'] = 'Die Datei konnte nicht hochgeladen werden: Der Ordner konnte nicht erstellt werden.';

						$this->load->view('admin/applications/newsletter/edit-newsletter', $data);

						return;
					}
					//image upload
					$this->upload->initialize(array(
						'upload_path' => $upload_path,
						'allowed_types' => 'jpeg|jpg|png',
						'file_name' => '1',
						'file_ext_tolower' => true,
						'optional' => true,
						'overwrite' => true,
						'max_size' => 4 * 1024,
						'max_width' => 2048,
						'max_height' => 2048,
					));

					if (!$this->upload->do_upload('image')) 
					{
						$data['image_error'] = $this->upload->display_errors();

						$this->load->view('admin/applications/news/edit-news', $data);

						return;
					}

					if ($this->upload->data()['file_size'] != NULL) {
						unlink($news->news_banner_image_url);
						$data['image_url'] = $upload_path . $this->upload->data()['file_name'];
					}
					else 
					{
						$data['image_url'] = $news->news_banner_image_url;
					}

					if ($this->News->edit_news($news_id, $data)) 
					{
						$message = array(
							'type' => 'success',
							'message' => 'Sie haben Ihre News <strong>'. $news->news_title .'</strong> erfolgreich bearbeitet.',
							'on_close' => 'reload',
						);

						$this->load->view('elements/modal-alert', $message);
					} 
					else 
					{
						// Delete the uploaded image because an error happened
						if ($this->upload->data()['file_size'] != NULL) 
						{
							unlink($data['image_url']);
						}

						$message = array(
							'type' => 'error',
							'message' => 'Die News können nicht bearbeitet werden.',
						);

						$this->load->view('elements/modal-alert', $message);
					}
				} 
				else 
				{
					$this->load->view('admin/applications/news/edit-news', $data);
				}

				return;
			case 'delete-news':
				$query = $this->News->get_news('filter:id', $news_id);

				if ($query->num_rows() != 1) 
				{
					$message = array(
						'type' => 'error',
						'message' => 'Die News können nicht bearbeitet werden: Die News konnten nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$news = $query->first_row();

				// Request from: application/views/admin/appilications/newsletter/delete-newsletter.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) 
				{
					
					if (!$this->News->delete_news($news_id)) 
					{
						$message = array(
							'type' => 'error',
							'message' => 'Die News konnten nicht gelöscht werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}
					
					// Delete the old image
					if ($news->news_banner_image_url != NULL) 
					{
						unlink($news->news_banner_image_url);
					}
					
					$message = array(
						'type' => 'success',
						'message' => 'Ihre News <strong>'. $news->news_title .'</strong> wurden erfolgreich gelöscht.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} 
				else 
				{
					$data = array(
						'id' => $news_id,
						'subject' => $news->news_title,
					);

					$this->load->view('admin/applications/news/delete-news', $data);
				}

			return;
			case 'upload-images':
				// Request from: application/views/admin/appilications/newsletter/create-newsletter.php
				// with $_POST data set
				$query = $this->News->get_news('filter:id', $news_id);

				if ($query->num_rows() != 1) 
				{
					$message = array(
						'type' => 'error',
						'message' => 'Die News konnten nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$news = $query->first_row();
				
				
				$header_data = array(
					'title' => 'Primus Romulus - Admin Panel - News', 
					'page' => 'admin',
					'subpage' => 'news',
				);
				$this->load->view('elements/header', $header_data);
				$this->load->view('admin/header', $header_data);
				$this->load->view('admin/applications/news/upload-images', $news);
				$this->load->view('elements/footer');
				

			return;
		}
		
		$header_data = array(
			'title' => 'Primus Romulus - Admin Panel - News', 
			'page' => 'admin',
			'subpage' => 'news',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('admin/header', $header_data);
		
		$this->load->view('admin/applications/news');
		
		$this->load->view('elements/footer');
	}
}
