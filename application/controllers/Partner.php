<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if (($language = get_cookie('language')) != NULL && in_array($language, $this->config->item('supported_languages'))) {
			load_language($language);
		}
	}

	public function index()
	{
		if ($this->session->partner['logged_in']) {
			if (!partner_has_permission('feed')) {
				redirect(base_url() .'partner/contacts');
			}

			redirect(base_url() .'partner/feed');
		} else {
			redirect(base_url() .'partner/login');
		}
	}

	public function search()
	{
		if (!$this->session->member['logged_in'] || $this->input->post('form') == NULL) {
			redirect(base_url() .'partner/index');
		}

		// Name entered
		$name = trim($this->input->post('name'));

		// Location entered
		$location = trim($this->input->post('location'));

		// Array of selected sectors
		$sectors = $this->input->post('sectors');

		// Determine the filters
		$filter_name = !empty($name);
		$filter_location = !empty($location);
		$filter_sector = !empty($sectors);

		$query = $this->Partner->get_partner('all');

		// No partners were found
		if ($query->num_rows() == 0) {
			$data = array(
				'error' => 'Es wurden keine Unternehmen gefunden.',
			);

			header('Content-Type: application/json');
			echo json_encode($data);

			return;
		}

		// No search-criteria was sent -> show all partners
		if (!$filter_name && !$filter_location && !$filter_sector) {
			foreach ($query->result() as $i => $partner) {
				$data = array(
					'id' => $partner->company_id,
					'image_url' => base_url() . $partner->company_logo_image_url,
					'name' => $partner->company_name,
					'main_location' => $partner->address_city .', '. $partner->country_name,
					'sectors' => $this->Partner->get_partner_sectors($partner->company_id)->result_array(),
					'html_before' => '<div class="col-lg-4 col-md-6">',
					'html_after' => '</div>',
				);

				echo $this->parser->parse('template/profile/partner-card', $data, true);
			}

			return;
		}

		$response = '';

		foreach ($query->result() as $i => $partner) {
			$has_name = false;
			$has_location = false;
			$has_sector = false;

			if ($filter_name) {
				// The company_name contains the entered name
				$has_name = (stripos($partner->company_name, $name) !== false);
			}

			if ($filter_location) {
				$location = mb_strtoupper($location, 'UTF-8');

				// The address_city or the country_name equals the entered location
				$has_location = (mb_strtoupper($partner->address_city, 'UTF-8') == $location || mb_strtoupper($partner->country_name, 'UTF-8') == $location);
			}

			// Get sectors
			$sectors_query = $this->Partner->get_partner_sectors($partner->company_id);

			if ($filter_sector) {
				if ($sectors_query->num_rows() > 0) {
					// One of the sector_id's is one of the selected sectors
					foreach ($sectors_query->result() as $sector) {
						if (in_array($sector->sector_id, $sectors)) {
							$has_sector = true;
							break;
						}
					}
				}
			}

			$filter = $has_name || $has_location || $has_sector;

			if ($filter_name) {
				$filter = $has_name;
			}

			if ($filter_sector) {
				$filter = $has_sector;
			}

			if ($filter_location) {
				$filter = $has_location;
			}

			if ($filter_name && $filter_location) {
				$filter = $has_name && $has_location;
			}

			if ($filter_name && $filter_sector) {
				$filter = $has_name && $has_sector;
			}

			if ($filter_sector && $filter_location) {
				$filter = $has_sector && $has_location;
			}

			if ($filter_name && $filter_location && $filter_sector) {
				$filter = $has_name && $has_location && $has_sector;
			}

			if ($filter) {
				$data = array(
					'id' => $partner->company_id,
					'image_url' => base_url() . $partner->company_logo_image_url,
					'name' => $partner->company_name,
					'main_location' => $partner->address_city .', '. $partner->country_name,
					'sectors' => $this->Partner->get_partner_sectors($partner->company_id)->result_array(),
					'html_before' => '<div class="col-lg-4 col-md-6">',
					'html_after' => '</div>',
				);

				$response .= $this->parser->parse('template/profile/partner-card', $data, true);
			}
		}

		if (empty($response)) {
			// There was no partner which matched the filter

			$data = array(
				'error' => 'Es wurde kein passendes Unternehmen gefunden.',
			);

			header('Content-Type: application/json');
			echo json_encode($data);
		} else {
			echo $response;
		}
	}

	public function reset()
	{
		$email = html_escape($this->input->get('email'));
		$token = html_escape($this->input->get('token'));

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_partner'), 
			'page' => 'partner',
		);

		$this->load->view('elements/header', $header_data);

		$message = array(
			'type' => 'error',
			'message' => 'Der Link ist ungültig!',
		);

		if (!empty($email) && valid_email($email) && !empty($token)) {
			$query = $this->Partner->get_partner('filter:email', $email);

			if ($query->num_rows() == 1) {
				$partner = $query->first_row();

				if ($partner->user_password_reset_token == $token) {
					$this->User->renew_password_reset_token($email);

					$new_password = bin2hex(openssl_random_pseudo_bytes(4));

					$this->User->update_password($partner->company_id, $new_password);

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
					$this->email->to($email);

					$this->email->subject('Ihr Passwort wurde zurückgesetzt');

					$email_data = array(
						'salutation' => 'Sehr geehrte Damen und Herren!',
						'email' => $partner->user_email,
						'date' => date('d.m.Y'),
						'time' => date('H:i:s'),
						'new_password' => $new_password,
					);

					$this->email->message($this->parser->parse('template/email/partner/reset-password', $email_data, true));

					$this->email->send();

					$message = array(
						'type' => 'success',
						'message' => 'Das Passwort von Ihrem Account wurde erfolgreich zurückgesetzt!<br />Wir haben Ihnen eine E-Mail mit Ihrem neuen Passwort gesendet.<br />Wir empfehlen dieses Passwort umgehend im Einstellungsmenü zu ändern!',
					);
				}
			}
		}

		$this->load->view('partner/reset', $message);

		$this->load->view('elements/footer');
	}

	public function login()
	{
		if ($this->session->partner['logged_in']) {
			redirect(base_url() .'partner/index');
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_partner'), 
			'page' => 'partner',
		);

		$this->load->view('elements/header', $header_data);

		// User clicked on 'Forgot password'
		if ($this->input->get('forgot') == 'password') {
			$message = array();

			if ($this->input->post('form') != NULL) {
				$email = html_escape($this->input->post('email'));

				if (empty($email) || !valid_email($email)) {
					$message = array(
						'type' => 'error',
						'message' => 'Die eingegebene E-Mail-Adresse ist ungültig!',
					);
				} else {
					$query = $this->Partner->get_partner('filter:email', $email);

					if ($query->num_rows() == 1) {
						$partner = $query->first_row();

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
						$this->email->to($email);

						$this->email->subject('Passwort zurücksetzten');

						$email_data = array(
							'salutation' => 'Sehr geehrte Damen und Herren!',
							'email' => $partner->user_email,
							'reset_url' => prep_url(base_url() .'partner/reset?email='. $email .'&token='. $partner->user_password_reset_token),
						);

						$this->email->message($this->parser->parse('template/email/partner/forgot-password', $email_data, true));

						$this->email->send();

						$message = array(
							'type' => 'success',
							'message' => 'Wir haben Ihnen eine E-Mail gesendet, bitte überprüfen Sie Ihr E-Mail-Postfach!',
						);
					} else {
						$message = array(
							'type' => 'error',
							'message' => 'Die eingegebene E-Mail-Adresse ist ungültig!',
						);
					}
				}
			}

			$this->load->view('partner/forgot-password', $message);
		} 

		// User tried to log in but validation failed
		else if ($this->form_validation->run() == FALSE) {
			$this->load->view('partner/login');
		}

		// User tried to log in and validation succeeded
		else {
			$email = html_escape($this->input->post('email'));
			$password = html_escape($this->input->post('password'));
			$remember = $this->input->post('remember') != NULL;

			$query = $this->Partner->get_partner("filter:email", $email);

			if ($query->num_rows() == 1) {
				$user = $query->row();
				
				if ($user->user_password_hash == $this->User->password_hash($email, $password)) {
					$session_data = $query->result_array()[0];
					$session_data['logged_in'] = true;

					$this->session->set_userdata(array('partner' => $session_data));
				} else {
					$error = '<li>Das eingegebene Passwort ist falsch.</li>';
				}
			} else {
				$error = '<li>Ein Account mit den angegebenen Daten existiert nicht.</li>';
			}

			if (!empty($error)) {
				$message = array(
					'type' => 'error',
					'message' => '<strong>Sie können sich aus folgenden Gründen nicht anmelden:</strong><ul>'. $error .'</ul>',
				);
			}

			if (isset($message['type']) && $message['type'] != 'success') {
				$this->load->view('partner/login', $message);
			} else {
				redirect(base_url() .'partner/index');
			}
		}
		
		$this->load->view('elements/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata(array('partner'));

		redirect(base_url() .'partner/index');
	}

	public function feed($action = '', $post_id = '')
	{
		if (!$this->session->partner['logged_in']) {
			redirect(base_url() .'partner/index');
		}

		if (!partner_has_permission('feed')) {
			redirect(base_url() .'partner/index');
		}

		// Ensure that edit-post and delete-post have a post_id set, which is a positive integer
		if (($action == 'edit-post' || $action == 'delete-post') && (!isset($post_id) || !ctype_digit($post_id) || $post_id <= 0)) {
			$action = '';
		}

		switch ($action) {
			case 'create-post':
				// Request from: application/views/partner/appilications/feed/create-post.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					$title = html_escape($this->input->post('title'));
					$text = html_escape($this->input->post('text'));

					if ($this->form_validation->run('feed/create-post') == FALSE) {
						$this->load->view('partner/applications/feed/create-post');

						return;
					}

					// TODO: Make path absolute? (with asset_url function)
					$upload_path = 'assets/images/feed/'. $this->session->partner['user_id'] .'/';

					if (!create_directory($upload_path, 0777, true)) {
						$this->load->view('partner/applications/feed/create-post', array(
							'image_error' => 'Das Bild konnte nicht hochgeladen werden: Der Ordner konnte nicht erstellt werden.',
						));

						return;
					}

					// Create the post in the database to get the id for the image upload
					// TODO: Insert post into database with correct author_id
					$post_id = $this->Feed->create_post($this->session->partner['user_id'], $this->session->partner['user_id'], $title, $text, null, null);

					if ($post_id <= 0) {
						// Delete the post because an error happened
						$this->Feed->delete_post($post_id);

						$message = array(
							'type' => 'error',
							'message' => 'Ihr Post <strong>'. $title .'</strong> konnte nicht erstellt werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}

					$this->upload->initialize(array(
						'upload_path' => $upload_path,
						'allowed_types' => 'jpeg|jpg|png',
						'file_name' => uniqid($post_id .'i'),
						'file_ext_tolower' => true,
						'optional' => true,
						'overwrite' => true,
						'max_size' => 4 * 1024,
						'max_width' => 2048,
						'max_height' => 2048,
					));

					if (!$this->upload->do_upload('image')) {
						// Delete the post because an error happened
						$this->Feed->delete_post($post_id);

						$this->load->view('partner/applications/feed/create-post', array(
							'image_error' => $this->upload->display_errors(),
						));

						return;
					}
					
					if ($this->upload->data()['file_size'] != NULL) {
						$image_url = $upload_path . $this->upload->data()['file_name'];
					} else {
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
						// Delete the post because an error happened
						$this->Feed->delete_post($post_id);

						$this->load->view('partner/applications/feed/create-post', array(
							'file_error' => $this->upload->display_errors(),
						));

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
					
					
					
					//video upload
					$this->upload->initialize(array(
						'upload_path' => $upload_path,
						'allowed_types' => 'mp4',
						'file_ext_tolower' => true,
						'optional' => true,
						'overwrite' => true,
						'max_size' => 90 * 1024
					));
					if (!$this->upload->do_upload('video')) 
					{
						$this->load->view('partner/applications/feed/create-post', array(
							'video_error' => $this->upload->display_errors(),
						));

						return;
					}

					if ($this->upload->data()['file_size'] != NULL) 
					{
						$video_url = $upload_path . $this->upload->data()['file_name'];
					} 
					else 
					{
						$video_url = NULL;
					}
					
					

					// TODO: Update post in database with correct video_url
					if (!$this->Feed->edit_post($post_id, array('image_url' => $image_url, 'attachment_url' => $attachment_url, 'video_url' => $video_url))) {
						// Delete the post because an error happened
						$this->Feed->delete_post($post_id);

						// Delete the uploaded image because an error happened
						if ($this->upload->data()['file_size'] != NULL) {
							unlink($image_url);
						}

						$message = array(
							'type' => 'error',
							'message' => 'Ihr Post <strong>'. $title .'</strong> konnte nicht erstellt werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}

					$message = array(
						'type' => 'success',
						'message' => 'Ihr Post <strong>'. $title .'</strong> wurde erfolgreich erstellt.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} else {
					$this->load->view('partner/applications/feed/create-post');
				}

				return;
			case 'edit-post':
				$query = $this->Feed->get_post('filter:id', $post_id);

				if ($query->num_rows() != 1) {
					$message = array(
						'type' => 'error',
						'message' => 'Der Post kann nicht bearbeitet werden: Der Post konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$post = $query->first_row();

				$data = array(
					'id' => $post_id,
					'title' => $post->post_title,
					'text' => $post->post_text,
					'image_url' => !empty($post->post_image_url) ? base_url() . $post->post_image_url : '',
					'attachment_url' => !empty($post->post_attachment_url) ? base_url() . $post->post_attachment_url : '',
					'video_url' => !empty($post->post_video_url) ? base_url() . $post->post_video_url : '',
				);

				// TODO: Implement employee somehow
				if ($post->company_id != $this->session->partner['user_id']) {
					$message = array(
						'type' => 'error',
						'message' => 'Sie haben keine Berechtigung diesen Post zu bearbeiten.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				// Request from: application/views/partner/appilications/feed/edit-post.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					if ($this->form_validation->run('feed/edit-post') == FALSE) {
						$this->load->view('partner/applications/feed/edit-post', $data);

						return;
					}

					$data = array(
						'id' => $post_id,
						'title' => html_escape($this->input->post('title')),
						'text' => html_escape($this->input->post('text')),
						'image_url' => !empty($post->post_image_url) ? base_url() . $post->post_image_url : '',
						'attachment_url' => !empty($post->post_attachment_url) ? base_url() . $post->post_attachment_url : '',
						'video_url' => !empty($post->post_video_url) ? base_url() . $post->post_video_url : '',
					);

					// TODO: Make path absolute? (with asset_url function)
					$upload_path = 'assets/images/feed/'. $this->session->partner['user_id'] .'/';

					if (!create_directory($upload_path, 0777, true)) {
						$data['image_error'] = 'Das Bild konnte nicht hochgeladen werden: Der Ordner konnte nicht erstellt werden.';

						$this->load->view('partner/applications/feed/edit-post', $data);

						return;
					}

					$this->upload->initialize(array(
						'upload_path' => $upload_path,
						'allowed_types' => 'jpeg|jpg|png',
						'file_name' => uniqid($post_id .'i'),
						'file_ext_tolower' => true,
						'optional' => true,
						'overwrite' => true,
						'max_size' => 4 * 1024,
						'max_width' => 2048,
						'max_height' => 2048,
					));

					if (!$this->upload->do_upload('image')) {
						$data['image_error'] = $this->upload->display_errors();

						$this->load->view('partner/applications/feed/edit-post', $data);

						return;
					}

					if ($this->upload->data()['file_size'] != NULL) {
						unlink($post->post_image_url);
						$data['image_url'] = $upload_path . $this->upload->data()['file_name'];
					} else {
						$data['image_url'] = $post->post_image_url;
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

						$this->load->view('partner/applications/feed/edit-post', $data);

						return;
					}

					if ($this->upload->data()['file_size'] != NULL) 
					{
						unlink($post->post_attachment_url);
						$data['attachment_url'] = $upload_path . $this->upload->data()['file_name'];
					} 
					else 
					{
						$data['attachment_url'] = NULL;
					}
					
					//video upload
					$this->upload->initialize(array(
						'upload_path' => $upload_path,
						'allowed_types' => 'mp4',
						'file_ext_tolower' => true,
						'optional' => true,
						'overwrite' => true,
						'max_size' => 90 * 1024
					));
					if (!$this->upload->do_upload('video')) 
					{
						$data['video_error'] = $this->upload->display_errors();

						$this->load->view('partner/applications/feed/edit-post', $data);

						return;
					}

					if ($this->upload->data()['file_size'] != NULL) 
					{
						unlink($post->post_video_url);
						$data['video_url'] = $upload_path . $this->upload->data()['file_name'];
					} 
					else 
					{
						$data['video_url'] = NULL;
					}

					// TODO: Update post in database with correct video_url
					if ($this->Feed->edit_post($post_id, $data)) {

						$message = array(
							'type' => 'success',
							'message' => 'Sie haben Ihren Post <strong>'. $post->post_title .'</strong> erfolgreich bearbeitet.',
							'on_close' => 'reload',
						);

						$this->load->view('elements/modal-alert', $message);
					} else {
						// Delete the uploaded image because an error happened
						if ($this->upload->data()['file_size'] != NULL) {
							unlink($data['image_url']);
						}

						$message = array(
							'type' => 'error',
							'message' => 'Der Post kann nicht bearbeitet werden.',
						);

						$this->load->view('elements/modal-alert', $message);
					}
				} else {
					$this->load->view('partner/applications/feed/edit-post', $data);
				}

				return;
			case 'delete-post':
				$query = $this->Feed->get_post('filter:id', $post_id);

				if ($query->num_rows() != 1) {
					$message = array(
						'type' => 'error',
						'message' => 'Der Post kann nicht gelöscht werden: Der Post konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$post = $query->first_row();

				// TODO: Implement employee somehow
				if ($post->company_id != $this->session->partner['user_id']) {
					$message = array(
						'type' => 'error',
						'message' => 'Sie haben keine Berechtigung diesen Post zu löschen.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				// Request from: application/views/partner/appilications/feed/delete-post.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					if (!$this->Feed->delete_post($post_id)) {
						$message = array(
							'type' => 'error',
							'message' => 'Der Post konnte nicht gelöscht werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}

					// Delete the old data
					if ($post->post_image_url != NULL) {
						unlink($post->post_image_url);
					}
					
					if ($post->post_attachment_url != NULL) {
						unlink($post->post_attachment_url);
					}
					
					if ($post->post_video_url != NULL) {
						unlink($post->post_video_url);
					}
					
					$message = array(
						'type' => 'success',
						'message' => 'Ihr Post <strong>'. $post->post_title .'</strong> wurde erfolgreich gelöscht.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} else {
					$data = array(
						'id' => $post_id,
						'title' => $post->post_title,
					);

					$this->load->view('partner/applications/feed/delete-post', $data);
				}

				return;
			case 'preview-post':
				// Request from: application/views/partner/appilications/feed/create-post.php or edit-post.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					$title = html_escape($this->input->post('title'));
					$text = html_escape($this->input->post('text'));

					$data = array(
						'user' => 'partner',
						'post_id' => '',
						'date' => date('d.m.Y'),
						'author' => html_escape($this->session->partner['company_name']),
						'author_url' => '/profile/partner/'. $this->session->partner['user_id'],
						'title' => $title,
						'media_tag' => '',
						'text' => nl2br($text),
					);

					echo $this->parser->parse('template/feed/post', $data, true);
				}

				return;
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_partner'), 
			'page' => 'partner',
			'subpage' => 'feed',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('partner/header', $header_data);

		$this->load->view('partner/adblock');
		$this->load->view('partner/applications/feed');
		
		$this->load->view('elements/footer');
	}

	public function overview()
	{
		if (!$this->session->partner['logged_in']) {
			redirect(base_url() .'partner/index');
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_partner'), 
			'page' => 'partner',
			'subpage' => 'overview',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('partner/header', $header_data);

		$this->load->view('partner/adblock');
		$this->load->view('partner/applications/overview');
		
		$this->load->view('elements/footer');
	}

	public function contacts($action = '', $employee_id = '')
	{
		if (!$this->session->partner['logged_in']) {
			redirect(base_url() .'partner/index');
		}

		// Ensure that edit-contact and delete-contact have a employee_id set, which is a positive integer
		if (($action == 'edit-contact' || $action == 'delete-contact') && (!isset($employee_id) || !ctype_digit($employee_id) || $employee_id <= 0)) {
			$action = '';
		}

		switch ($action) {
			case 'create-contact':
				// Request from: application/views/partner/appilications/contacts/create-contact.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					$salutation = html_escape($this->input->post('salutation'));
					$title = html_escape($this->input->post('title'));
					$firstname = html_escape($this->input->post('firstname'));
					$lastname = html_escape($this->input->post('lastname'));
					$email = html_escape($this->input->post('email'));
					$phone = html_escape($this->input->post('phone'));

					if ($this->form_validation->run('contacts/create-contact') == FALSE) {
						$this->load->view('partner/applications/contacts/create-contact');

						return;
					}

					// Create the post in the database to get the id for the image upload
					$employee_id = $this->Employee->create_employee($this->session->partner['user_id'], $salutation, $title, $firstname, $lastname, $email, $phone, NULL);

					if ($employee_id <= 0) {
						// Delete the employee because an error happened
						$this->Employee->delete_employee($employee_id);

						$message = array(
							'type' => 'error',
							'message' => 'Ihre Kontaktperson <strong>'. $title .' '. $firstname .' '. $lastname .'</strong> konnte nicht erstellt werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}

					// TODO: Make path absolute? (with asset_url function)
					$upload_path = 'assets/images/employee/'. $employee_id .'/';

					if (!create_directory($upload_path, 0777, true)) {
						$this->load->view('partner/applications/contacts/create-contact', array(
							'image_error' => 'Das Bild konnte nicht hochgeladen werden: Der Ordner konnte nicht erstellt werden.',
						));

						return;
					}

					$this->upload->initialize(array(
						'upload_path' => $upload_path,
						'allowed_types' => 'jpeg|jpg|png',
						'file_name' => 'profile',
						'file_ext_tolower' => true,
						'optional' => true,
						'overwrite' => true,
						'max_size' => 2 * 1024,
						'max_width' => 1024,
						'max_height' => 1024,
					));

					if (!$this->upload->do_upload('image')) {
						// Delete the employee because an error happened
						$this->Employee->delete_employee($employee_id);

						$this->load->view('partner/applications/contacts/create-contact', array(
							'image_error' => $this->upload->display_errors(),
						));

						return;
					}

					if ($this->upload->data()['file_size'] != NULL) {
						$image_url = $upload_path . $this->upload->data()['file_name'];
					} else {
						$image_url = NULL;
					}

					if (!$this->Employee->edit_employee($employee_id, array('image_url' => $image_url))) {
						// Delete the employee because an error happened
						$this->Employee->delete_employee($employee_id);

						// Delete the uploaded image because an error happened
						if ($this->upload->data()['file_size'] != NULL) {
							unlink($image_url);
						}

						$message = array(
							'type' => 'error',
							'message' => 'Ihre Kontaktperson <strong>'. $title .' '. $firstname .' '. $lastname .'</strong> konnte nicht erstellt werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}

					$message = array(
						'type' => 'success',
						'message' => 'Ihre Kontaktperson <strong>'. $title .' '. $firstname .' '. $lastname .'</strong> wurde erfolgreich erstellt.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} else {
					$this->load->view('partner/applications/contacts/create-contact');
				}

				return;
			case 'edit-contact':
				$query = $this->Employee->get_employee('filter:id', $employee_id);

				if ($query->num_rows() != 1) {
					$message = array(
						'type' => 'error',
						'message' => 'Die Kontaktperson kann nicht bearbeitet werden: Die Kontaktperson konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$employee = $query->first_row();

				$data = array(
					'id' => $employee_id,
					'salutation' => $employee->gender_salutation,
					'title' => $employee->employee_title,
					'firstname' => $employee->employee_firstname,
					'lastname' => $employee->employee_lastname,
					'email' => $employee->user_email,
					'phone' => $employee->employee_phone,
					'image_url' => $employee->employee_profile_image_url,
				);

				// TODO: Implement employee somehow
				if ($employee->company_id != $this->session->partner['user_id']) {
					$message = array(
						'type' => 'error',
						'message' => 'Sie haben keine Berechtigung diese Kontaktperson zu bearbeiten.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				// Request from: application/views/partner/appilications/contacts/edit-contact.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					if ($this->form_validation->run('contacts/edit-contact') == FALSE) {
						$this->load->view('partner/applications/contacts/edit-contact', $data);

						return;
					}

					$data = array(
						'id' => $employee_id,
						'salutation' => html_escape($this->input->post('salutation')),
						'title' => html_escape($this->input->post('title')),
						'firstname' => html_escape($this->input->post('firstname')),
						'lastname' => html_escape($this->input->post('lastname')),
						'email' => html_escape($this->input->post('email')),
						'phone' => html_escape($this->input->post('phone')),
					);

					// TODO: Make path absolute? (with asset_url function)
					$upload_path = 'assets/images/employee/'. $employee_id .'/';

					if (!create_directory($upload_path, 0777, true)) {
						$data['image_error'] = 'Das Bild konnte nicht hochgeladen werden: Der Ordner konnte nicht erstellt werden.';

						$this->load->view('partner/applications/contacts/edit-contact', $data);

						return;
					}

					$this->upload->initialize(array(
						'upload_path' => $upload_path,
						'allowed_types' => 'jpeg|jpg|png',
						'file_name' => 'profile',
						'file_ext_tolower' => true,
						'optional' => true,
						'overwrite' => true,
						'max_size' => 2 * 1024,
						'max_width' => 1024,
						'max_height' => 1024,
					));

					if (!$this->upload->do_upload('image')) {
						$data['image_error'] = $this->upload->display_errors();

						$this->load->view('partner/applications/contacts/edit-contact', $data);

						return;
					}

					if ($this->upload->data()['file_size'] != NULL) {
						$data['image_url'] = $upload_path . $this->upload->data()['file_name'];
					} else {
						$data['image_url'] = $employee->employee_profile_image_url;
					}

					if ($this->Employee->edit_employee($employee_id, $data)) {
						$message = array(
							'type' => 'success',
							'message' => 'Sie haben Ihre Kontaktperson <strong>'. $employee->employee_title .' '. $employee->employee_firstname .' '. $employee->employee_lastname .'</strong> erfolgreich bearbeitet.',
							'on_close' => 'reload',
						);

						$this->load->view('elements/modal-alert', $message);
					} else {
						$message = array(
							'type' => 'error',
							'message' => 'Die Kontaktperson kann nicht bearbeitet werden.',
						);

						$this->load->view('elements/modal-alert', $message);
					}
				} else {
					$this->load->view('partner/applications/contacts/edit-contact', $data);
				}

				return;
			case 'delete-contact':
				$query = $this->Employee->get_employee('filter:id', $employee_id);

				if ($query->num_rows() != 1) {
					$message = array(
						'type' => 'error',
						'message' => 'Die Kontaktperson kann nicht gelöscht werden: Die Kontaktperson konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$employee = $query->first_row();

				// The employee is the main contact of the company -> can't be deleted
				if ($employee->employee_id == $this->Partner->get_partner('filter:id', $this->session->partner['user_id'])->first_row()->company_main_contact) {
					$message = array(
						'type' => 'error',
						'message' => 'Diese Kontaktperson kann nicht gelöscht werden, da sie als Hauptkontaktperson eingetragen ist.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				// TODO: Implement employee somehow
				if ($employee->company_id != $this->session->partner['user_id']) {
					$message = array(
						'type' => 'error',
						'message' => 'Sie haben keine Berechtigung diese Kontaktperson zu löschen.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				// Request from: application/views/partner/appilications/contacts/delete-contact.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					if (!$this->Employee->delete_employee($employee_id)) {
						$message = array(
							'type' => 'error',
							'message' => 'Die Kontaktperson konnte nicht gelöscht werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}

					// Remove employee folder
					rrmdir('assets/images/employee/'. $employee_id .'/');

					$message = array(
						'type' => 'success',
						'message' => 'Ihre Kontaktperson <strong>'. $employee->employee_title .' '. $employee->employee_firstname .' '. $employee->employee_lastname .'</strong> wurde erfolgreich gelöscht.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} else {
					$data = array(
						'id' => $employee_id,
						'title' => $employee->employee_title,
						'firstname' => $employee->employee_firstname,
						'lastname' => $employee->employee_lastname,
					);

					$this->load->view('partner/applications/contacts/delete-contact', $data);
				}

				return;
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_partner'), 
			'page' => 'partner',
			'subpage' => 'contacts',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('partner/header', $header_data);

		$this->load->view('partner/adblock');
		$this->load->view('partner/applications/contacts');
		
		$this->load->view('elements/footer');
	}

	public function locations($action = '', $location_id = '')
	{
		if (!$this->session->partner['logged_in']) {
			redirect(base_url() .'partner/index');
		}

		// Ensure that edit-location and delete-location have a location_id set, which is a positive integer
		if (($action == 'edit-location' || $action == 'delete-location') && (!isset($location_id) || !ctype_digit($location_id) || $location_id <= 0)) {
			$action = '';
		}

		switch ($action) {
			case 'create-location':
				// Request from: application/views/partner/appilications/locations/create-location.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					$name = html_escape($this->input->post('name'));
					$street = html_escape($this->input->post('street'));
					$zipcode = html_escape($this->input->post('zipcode'));
					$city = html_escape($this->input->post('city'));
					$country = html_escape($this->input->post('country'));
					$phone = html_escape($this->input->post('phone'));
					$fax = html_escape($this->input->post('fax'));
					$email = html_escape($this->input->post('email'));
					$website = html_escape($this->input->post('website'));

					if ($this->form_validation->run('locations/create-location') == FALSE) {
						$this->load->view('partner/applications/locations/create-location');

						return;
					}

					// Create the location in the database
					$location_id = $this->Location->create_location($this->session->partner['user_id'], $name, $street, $zipcode, $city, $country, $phone, $fax, $email, $website);

					if ($location_id <= 0) {
						// Delete the location because an error happened
						$this->Location->delete_location($location_id);

						$message = array(
							'type' => 'error',
							'message' => 'Ihr Standort <strong>'. $name .'</strong> konnte nicht erstellt werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}

					$message = array(
						'type' => 'success',
						'message' => 'Ihr Standort <strong>'. $name .'</strong> wurde erfolgreich erstellt.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} else {
					$this->load->view('partner/applications/locations/create-location');
				}

				return;
			case 'edit-location':
				$query = $this->Location->get_location('filter:id', $location_id);

				if ($query->num_rows() != 1) {
					$message = array(
						'type' => 'error',
						'message' => 'Der Standort kann nicht bearbeitet werden: Der Standort konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$location = $query->first_row();

				$data = array(
					'id' => $location_id,
					'name' => $location->location_name,
					'street' => $location->address_street,
					'zipcode' => $location->address_zipcode,
					'city' => $location->address_city,
					'country' => $location->country_id,
					'phone' => $location->location_phone,
					'fax' => $location->location_fax,
					'email' => $location->location_email,
					'website' => $location->location_website,
				);

				// TODO: Implement employee somehow
				if ($location->company_id != $this->session->partner['user_id']) {
					$message = array(
						'type' => 'error',
						'message' => 'Sie haben keine Berechtigung diesen Standort zu bearbeiten.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				// Request from: application/views/partner/appilications/locations/edit-location.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					if ($this->form_validation->run('locations/edit-location') == FALSE) {
						$this->load->view('partner/applications/locations/edit-location', $data);

						return;
					}

					$data = array(
						'id' => $location_id,
						'name' => html_escape($this->input->post('name')),
						'street' => html_escape($this->input->post('street')),
						'zipcode' => html_escape($this->input->post('zipcode')),
						'city' => html_escape($this->input->post('city')),
						'country' => html_escape($this->input->post('country')),
						'phone' => html_escape($this->input->post('phone')),
						'fax' => html_escape($this->input->post('fax')),
						'email' => html_escape($this->input->post('email')),
						'website' => html_escape($this->input->post('website')),
					);

					if ($this->Location->edit_location($location_id, $data)) {
						$message = array(
							'type' => 'success',
							'message' => 'Sie haben Ihren Standort <strong>'. $location->location_name .'</strong> erfolgreich bearbeitet.',
							'on_close' => 'reload',
						);

						$this->load->view('elements/modal-alert', $message);
					} else {
						$message = array(
							'type' => 'error',
							'message' => 'Der Standort kann nicht bearbeitet werden.',
						);

						$this->load->view('elements/modal-alert', $message);
					}
				} else {
					$this->load->view('partner/applications/locations/edit-location', $data);
				}

				return;
			case 'delete-location':
				$query = $this->Location->get_location('filter:id', $location_id);

				if ($query->num_rows() != 1) {
					$message = array(
						'type' => 'error',
						'message' => 'Der Standort kann nicht gelöscht werden: Der Standort konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$location = $query->first_row();

				// The location is the main location of the company -> can't be deleted
				if ($location->location_id == $this->Partner->get_partner('filter:id', $this->session->partner['user_id'])->first_row()->company_main_location) {
					$message = array(
						'type' => 'error',
						'message' => 'Dieser Standort kann nicht gelöscht werden, da er als Hauptstandort eingetragen ist.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				// TODO: Implement employee somehow
				if ($location->company_id != $this->session->partner['user_id']) {
					$message = array(
						'type' => 'error',
						'message' => 'Sie haben keine Berechtigung diesen Standort zu löschen.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				// Request from: application/views/partner/appilications/locations/delete-location.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					if (!$this->Location->delete_location($location_id)) {
						$message = array(
							'type' => 'error',
							'message' => 'Der Standort konnte nicht gelöscht werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}

					$message = array(
						'type' => 'success',
						'message' => 'Ihr Standort <strong>'. $location->location_name .'</strong> und alle an diesem Standort verfügbaren Jobangebote wurden erfolgreich gelöscht.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} else {
					$data = array(
						'id' => $location_id,
						'name' => $location->location_name,
						'street' => $location->address_street,
						'zipcode' => $location->address_zipcode,
						'city' => $location->address_city,
						'country' => $location->country_name,
					);

					$this->load->view('partner/applications/locations/delete-location', $data);
				}

				return;
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_partner'), 
			'page' => 'partner',
			'subpage' => 'locations',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('partner/header', $header_data);

		$this->load->view('partner/adblock');
		$this->load->view('partner/applications/locations');
		
		$this->load->view('elements/footer');
	}

	public function jobs($action = '', $job_id = '')
	{
		if (!$this->session->partner['logged_in']) {
			redirect(base_url() .'partner/index');
		}

		if (!partner_has_permission('jobs')) {
			redirect(base_url() .'partner/index');
		}

		// Ensure that edit-job and toggle-job have a job_id set, which is a positive integer
		if (($action == 'edit-job' || $action == 'toggle-job') && (!isset($job_id) || !ctype_digit($job_id) || $job_id <= 0)) {
			$action = '';
		}

		switch ($action) {
			case 'create-job':
				// Request from: application/views/partner/appilications/jobs/create-job.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					$title = html_escape($this->input->post('title'));
					$lead_text = html_escape($this->input->post('lead-text'));
					$text = html_escape($this->input->post('text'));
					$salary_text = html_escape($this->input->post('salary-text'));
					$start_date = DateTime::createFromFormat('d.m.Y', html_escape($this->input->post('start-date')));
					$status = html_escape($this->input->post('status'));
					$contact = ($this->input->post('contact') == '-' ? NULL : html_escape($this->input->post('contact')));
					$type = html_escape($this->input->post('type'));
					$location = html_escape($this->input->post('location'));
					$sector = html_escape($this->input->post('sector'));

					parse_str($this->input->post('tasks')[0], $tasks);
					$tasks = $tasks['tasks'];

					parse_str($this->input->post('requirements')[0], $requirements);
					$requirements = $requirements['requirements'];

					if ($this->form_validation->run('jobs/create-job') == FALSE) {
						$this->load->view('partner/applications/jobs/create-job');

						return;
					}

					// Create the job in the database
					$job_id = $this->Job->create_job($this->session->partner['user_id'], $title, $lead_text, $text, $salary_text, $start_date->format('Y-m-d'), $status, $contact, $type, $location, $sector, $tasks, $requirements);

					if ($job_id <= 0) {
						// Delete the job because an error happened
						$this->Job->delete_job($job_id);

						$message = array(
							'type' => 'error',
							'message' => 'Ihr Jobangebot <strong>'. $title .'</strong> konnte nicht erstellt werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}

					$message = array(
						'type' => 'success',
						'message' => 'Ihr Jobangebot <strong>'. $title .'</strong> wurde erfolgreich erstellt.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} else {
					$this->load->view('partner/applications/jobs/create-job');
				}

				return;
			case 'edit-job':
				$query = $this->Job->get_job('filter:id', $job_id);

				if ($query->num_rows() != 1) {
					$message = array(
						'type' => 'error',
						'message' => 'Das Jobangebot kann nicht bearbeitet werden: Das Jobangebot konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$job = $query->first_row();

				$data = array(
					'id' => $job_id,
					'title' => $job->job_title,
					'lead_text' => $job->job_lead_text,
					'text' => $job->job_text,
					'salary_text' => $job->job_salary_text,
					'start_date' => DateTime::createFromFormat('Y-m-d', $job->job_start_date)->format('d.m.Y'),
					'status' => $job->job_open,
					'contact' => $job->contact_id,
					'type' => $job->type_id,
					'location' => $job->location_id,
					'sector' => $job->sector_id,
				);

				// Get tasks of job
				$tasks = array();
				$query = $this->Job->get_job_tasks($job_id);

				foreach ($query->result() as $i => $row) {
					$tasks[$i] = $row->task;
				}

				$data['tasks'] = $tasks;

				// Get requirements of job
				$requirements = array();
				$query = $this->Job->get_job_requirements($job_id);

				foreach ($query->result() as $i => $row) {
					$requirements[$i] = $row->requirement;
				}

				$data['requirements'] = $requirements;

				// TODO: Implement employee somehow
				if ($job->company_id != $this->session->partner['user_id']) {
					$message = array(
						'type' => 'error',
						'message' => 'Sie haben keine Berechtigung dieses Jobangebot zu bearbeiten.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				// Request from: application/views/partner/appilications/jobs/edit-job.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					if ($this->form_validation->run('jobs/edit-job') == FALSE) {
						$this->load->view('partner/applications/jobs/edit-job', $data);

						return;
					}

					$data = array(
						'id' => $job_id,
						'title' => html_escape($this->input->post('title')),
						'lead_text' => html_escape($this->input->post('lead-text')),
						'text' => html_escape($this->input->post('text')),
						'salary_text' => html_escape($this->input->post('salary-text')),
						'start_date' => DateTime::createFromFormat('d.m.Y', html_escape($this->input->post('start-date')))->format('Y-m-d'),
						'status' => html_escape($this->input->post('status')),
						'contact' => html_escape($this->input->post('contact')),
						'type' => html_escape($this->input->post('type')),
						'location' => html_escape($this->input->post('location')),
						'sector' => html_escape($this->input->post('sector')),
					);

					// Get tasks
					parse_str($this->input->post('tasks')[0], $tasks);
					if (isset($tasks['tasks'])) {
						$data['tasks'] = $tasks['tasks'];
					}

					// Get requirements
					parse_str($this->input->post('requirements')[0], $requirements);
					if (isset($requirements['requirements'])) {
						$data['requirements'] = $requirements['requirements'];
					}

					if ($this->Job->edit_job($job_id, $data)) {
						$message = array(
							'type' => 'success',
							'message' => 'Sie haben Ihr Jobangebot <strong>'. $job->job_title .'</strong> erfolgreich bearbeitet.',
							'on_close' => 'reload',
						);

						$this->load->view('elements/modal-alert', $message);
					} else {
						$message = array(
							'type' => 'error',
							'message' => 'Das Jobangebot kann nicht bearbeitet werden.',
						);

						$this->load->view('elements/modal-alert', $message);
					}
				} else {
					$this->load->view('partner/applications/jobs/edit-job', $data);
				}

				return;
			case 'toggle-job':
				$query = $this->Job->get_job('filter:id', $job_id);

				if ($query->num_rows() != 1) {
					$message = array(
						'type' => 'error',
						'message' => 'Das Jobangebot kann nicht geöffnet/geschlossen werden: Das Jobangebot konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$job = $query->first_row();

				// TODO: Implement employee somehow
				if ($job->company_id != $this->session->partner['user_id']) {
					$message = array(
						'type' => 'error',
						'message' => 'Sie haben keine Berechtigung dieses Jobangebot zu '. ($job->job_open == 0 ? 'öffnen' : 'schließen') .'.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				// Request from: application/views/partner/appilications/jobs/toggle-job.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					if (!$this->Job->toggle_job($job_id)) {
						$message = array(
							'type' => 'error',
							'message' => 'Das Jobangebot konnte nicht '. ($job->job_open == 0 ? 'geöffnet' : 'geschlossen') .' werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}

					$message = array(
						'type' => 'success',
						'message' => 'Ihr Jobangebot <strong>'. $job->job_title .'</strong> wurde erfolgreich '.  ($job->job_open == 0 ? 'geöffnet' : 'geschlossen') .'.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} else {
					$data = array(
						'id' => $job_id,
						'open' => $job->job_open,
						'title' => $job->job_title,
					);

					$this->load->view('partner/applications/jobs/toggle-job', $data);
				}

				return;
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_partner'), 
			'page' => 'partner',
			'subpage' => 'jobs',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('partner/header', $header_data);

		$this->load->view('partner/adblock');
		$this->load->view('partner/applications/jobs');
		
		$this->load->view('elements/footer');
	}

	public function products()
	{
		if (!$this->session->partner['logged_in']) {
			redirect(base_url() .'partner/index');
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_partner'), 
			'page' => 'partner',
			'subpage' => 'products',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('partner/header', $header_data);

		$this->load->view('partner/adblock');
		$this->load->view('partner/applications/products');
		
		$this->load->view('elements/footer');
	}

	public function statistics($action = '')
	{
		if (!$this->session->partner['logged_in']) {
			redirect(base_url() .'partner/index');
		}

		if (!partner_has_permission('statistics')) {
			redirect(base_url() .'partner/index');
		}

		switch ($action) {
			case 'add-post-view':
				$post_id = html_escape($this->input->post('id'));
				$this->Statistics->add_post_view($post_id);
				break;
			case 'add-advertisement-view':
				$advertisement_id = html_escape($this->input->post('id'));
				$this->Statistics->add_advertisement_view($advertisement_id);
				break;
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_partner'), 
			'page' => 'partner',
			'subpage' => 'statistics',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('partner/header', $header_data);

		$this->load->view('partner/adblock');
		$this->load->view('partner/applications/statistics');
		
		$this->load->view('elements/footer');
	}

	public function bills()
	{
		if (!$this->session->partner['logged_in']) {
			redirect(base_url() .'partner/index');
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_partner'), 
			'page' => 'partner',
			'subpage' => 'bills',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('partner/header', $header_data);

		$this->load->view('partner/adblock');
		$this->load->view('partner/applications/bills');
		
		$this->load->view('elements/footer');
	}

	public function advertisements($action = '', $advertisement_id = '')
	{
		if (!$this->session->partner['logged_in']) {
			redirect(base_url() .'partner/index');
		}

		if (!partner_has_permission('advertisements')) {
			redirect(base_url() .'partner/index');
		}

		// Ensure that edit-advertisement and toggle-advertisement have a advertisement_id set, which is a positive integer
		if (($action == 'edit-advertisement' || $action == 'toggle-advertisement') && (!isset($advertisement_id) || !ctype_digit($advertisement_id) || $advertisement_id <= 0)) {
			$action = '';
		}

		switch ($action) {
			case 'create-advertisement':
				// Request from: application/views/partner/appilications/advertisements/create-advertisement.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					$title = html_escape($this->input->post('title'));
					$text = html_escape($this->input->post('text'));
					$start_date = DateTime::createFromFormat('d.m.Y', html_escape($this->input->post('start-date')));
					$end_date = DateTime::createFromFormat('d.m.Y', html_escape($this->input->post('end-date')));
					$url = html_escape($this->input->post('url'));
					$url_text = html_escape($this->input->post('url-text'));

					if ($this->form_validation->run('advertisements/create-advertisement') == FALSE) {
						$this->load->view('partner/applications/advertisements/create-advertisement');

						return;
					}

					// TODO: Make path absolute? (with asset_url function)
					$upload_path = 'assets/images/advertisements/'. $this->session->partner['user_id'] .'/';

					if (!create_directory($upload_path, 0777, true)) {
						$this->load->view('partner/applications/advertisements/create-advertisement', array(
							'image_error' => 'Das Bild konnte nicht hochgeladen werden: Der Ordner konnte nicht erstellt werden.',
						));

						return;
					}

					// Create the advertisement in the database to get the id for the image upload
					$advertisement_id = $this->Advertisement->create_advertisement($this->session->partner['user_id'], $title, $text, $start_date->format('Y-m-d'), $end_date->format('Y-m-d'), $url, $url_text, null);

					if ($advertisement_id <= 0) {
						// Delete the advertisement because an error happened
						$this->Advertisement->delete_advertisement($advertisement_id);

						$message = array(
							'type' => 'error',
							'message' => 'Ihre Werbung <strong>'. $title .'</strong> konnte nicht erstellt werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}

					$this->upload->initialize(array(
						'upload_path' => $upload_path,
						'allowed_types' => 'jpeg|jpg|png',
						'file_name' => uniqid($advertisement_id .'i'),
						'file_ext_tolower' => true,
						'optional' => false,
						'overwrite' => true,
						'max_size' => 1 * 1024,
						'max_width' => 512,
						'max_height' => 512,
					));

					if (!$this->upload->do_upload('image')) {
						// Delete the advertisement because an error happened
						$this->Advertisement->delete_advertisement($advertisement_id);

						$this->load->view('partner/applications/advertisements/create-advertisement', array(
							'image_error' => $this->upload->display_errors(),
						));

						return;
					}

					$image_url = $upload_path . $this->upload->data()['file_name'];

					if (!$this->Advertisement->edit_advertisement($advertisement_id, array('image_url' => $image_url))) {
						// Delete the advertisement because an error happened
						$this->Advertisement->delete_advertisement($advertisement_id);

						// Delete the uploaded image because an error happened
						if ($this->upload->data()['file_size'] != NULL) {
							unlink($image_url);
						}

						$message = array(
							'type' => 'error',
							'message' => 'Ihre Werbung <strong>'. $title .'</strong> konnte nicht erstellt werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}

					$message = array(
						'type' => 'success',
						'message' => 'Ihre Werbung <strong>'. $title .'</strong> wurde erfolgreich erstellt.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} else {
					$this->load->view('partner/applications/advertisements/create-advertisement');
				}

				return;
			case 'edit-advertisement':
				$query = $this->Advertisement->get_advertisement('filter:id', $advertisement_id);

				if ($query->num_rows() != 1) {
					$message = array(
						'type' => 'error',
						'message' => 'Die Werbung kann nicht bearbeitet werden: Die Werbung konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$advertisement = $query->first_row();

				$data = array(
					'id' => $advertisement_id,
					'title' => $advertisement->advertisement_title,
					'text' => $advertisement->advertisement_text,
					'start_date' => DateTime::createFromFormat('Y-m-d', $advertisement->advertisement_start_date)->format('d.m.Y'),
					'end_date' => DateTime::createFromFormat('Y-m-d', $advertisement->advertisement_end_date)->format('d.m.Y'),
					'url' => $advertisement->advertisement_url,
					'url_text' => $advertisement->advertisement_url_text,
					'image_url' => base_url() . $advertisement->advertisement_image_url,
				);

				// TODO: Implement employee somehow
				if ($advertisement->company_id != $this->session->partner['user_id']) {
					$message = array(
						'type' => 'error',
						'message' => 'Sie haben keine Berechtigung diese Werbung zu bearbeiten.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				// Request from: application/views/partner/appilications/advertisements/edit-advertisement.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					if ($this->form_validation->run('advertisements/edit-advertisement') == FALSE) {
						$this->load->view('partner/applications/advertisements/edit-advertisement', $data);

						return;
					}

					$data = array(
						'id' => $advertisement_id,
						'title' => html_escape($this->input->post('title')),
						'text' => html_escape($this->input->post('text')),
						'start_date' => html_escape($this->input->post('start-date')),
						'end_date' => html_escape($this->input->post('end-date')),
						'url' => html_escape($this->input->post('url')),
						'url_text' => html_escape($this->input->post('url-text')),
						'image_url' => base_url() . $advertisement->advertisement_image_url,
					);

					// TODO: Make path absolute? (with asset_url function)
					$upload_path = 'assets/images/advertisements/'. $this->session->partner['user_id'] .'/';

					if (!create_directory($upload_path, 0777, true)) {
						$data['image_error'] = 'Das Bild konnte nicht hochgeladen werden: Der Ordner konnte nicht erstellt werden.';

						$this->load->view('partner/applications/advertisements/edit-advertisement', $data);

						return;
					}

					$this->upload->initialize(array(
						'upload_path' => $upload_path,
						'allowed_types' => 'jpeg|jpg|png',
						'file_name' => uniqid($advertisement_id .'i'),
						'file_ext_tolower' => true,
						'optional' => true,
						'overwrite' => true,
						'max_size' => 1 * 1024,
						'max_width' => 512,
						'max_height' => 512,
					));

					if (!$this->upload->do_upload('image')) {
						$data['image_error'] = $this->upload->display_errors();

						$this->load->view('partner/applications/advertisements/edit-advertisement', $data);

						return;
					}

					if ($this->upload->data()['file_size'] != NULL) {
						$data['image_url'] = $upload_path . $this->upload->data()['file_name'];
					} else {
						$data['image_url'] = $advertisement->advertisement_image_url;
					}

					if ($this->Advertisement->edit_advertisement($advertisement_id, $data)) {
						// Delete the old image because the user uploaded a new one
						if ($this->upload->data()['file_size'] != NULL) {
							unlink($advertisement->advertisement_image_url);
						}

						$message = array(
							'type' => 'success',
							'message' => 'Sie haben Ihre Werbung <strong>'. $advertisement->advertisement_title .'</strong> erfolgreich bearbeitet.',
							'on_close' => 'reload',
						);

						$this->load->view('elements/modal-alert', $message);
					} else {
						// Delete the uploaded image because an error happened
						if ($this->upload->data()['file_size'] != NULL) {
							unlink($data['image_url']);
						}

						$message = array(
							'type' => 'error',
							'message' => 'Die Werbung kann nicht bearbeitet werden.',
						);

						$this->load->view('elements/modal-alert', $message);
					}
				} else {
					$this->load->view('partner/applications/advertisements/edit-advertisement', $data);
				}

				return;
			case 'toggle-advertisement':
				$query = $this->Advertisement->get_advertisement('filter:id', $advertisement_id);

				if ($query->num_rows() != 1) {
					$message = array(
						'type' => 'error',
						'message' => 'Die Werbung kann nicht aktiviert/deaktiviert werden: Die Werbung konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$advertisement = $query->first_row();

				// TODO: Implement employee somehow
				if ($advertisement->company_id != $this->session->partner['user_id']) {
					$message = array(
						'type' => 'error',
						'message' => 'Sie haben keine Berechtigung diese Werbung zu '. ($advertisement->advertisement_enabled == 0 ? '' : 'de') .'aktivieren.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				// Request from: application/views/partner/appilications/advertisements/toggle-advertisement.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					if (!$this->Advertisement->toggle_advertisement($advertisement_id)) {
						$message = array(
							'type' => 'error',
							'message' => 'Die Werbung konnte nicht '. ($advertisement->advertisement_enabled == 0 ? '' : 'de') .'aktiviert werden.',
						);

						$this->load->view('elements/modal-alert', $message);

						return;
					}

					$message = array(
						'type' => 'success',
						'message' => 'Ihre Werbung <strong>'. $advertisement->advertisement_title .'</strong> wurde erfolgreich '. ($advertisement->advertisement_enabled == 0 ? '' : 'de') .'aktiviert.',
						'on_close' => 'reload',
					);

					$this->load->view('elements/modal-alert', $message);
				} else {
					$data = array(
						'id' => $advertisement_id,
						'enabled' => $advertisement->advertisement_enabled,
						'title' => $advertisement->advertisement_title,
					);

					$this->load->view('partner/applications/advertisements/toggle-advertisement', $data);
				}

				return;
			case 'preview-advertisement':
				// Request from: application/views/partner/appilications/advertisements/create-advertisement.php or edit-advertisement.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					$title = html_escape($this->input->post('title'));
					$url = html_escape($this->input->post('url'));
					$url_text = html_escape($this->input->post('url-text'));
					$text = html_escape($this->input->post('text'));

					$data = array(
						'user' => 'partner',
						'ad_id' => '',
						'title' => $title,
						'url' => $url,
						'url_text' => $url_text,
						'media_tag' => '',
						'text' => nl2br($text),
					);

					echo $this->parser->parse('template/feed/side-ad', $data, true);
				}

				return;
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_partner'), 
			'page' => 'partner',
			'subpage' => 'advertisements',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('partner/header', $header_data);

		$this->load->view('partner/adblock');
		$this->load->view('partner/applications/advertisements');
		
		$this->load->view('elements/footer');
	}

	public function members()
	{
		if (!$this->session->partner['logged_in']) {
			redirect(base_url() .'partner/index');
		}

		if (!partner_has_permission('members')) {
			redirect(base_url() .'partner/index');
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_partner'), 
			'page' => 'partner',
			'subpage' => 'members',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('partner/header', $header_data);

		$this->load->view('partner/adblock');
		$this->load->view('partner/applications/members');
		
		$this->load->view('elements/footer');
	}

	public function settings()
	{
		if (!$this->session->partner['logged_in']) {
			redirect(base_url() .'partner/index');
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_partner'), 
			'page' => 'partner',
			'subpage' => 'settings',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('partner/header', $header_data);

		$this->load->view('partner/adblock');

		$company_id = $this->session->partner['user_id'];
		$query = $this->Partner->get_partner('filter:id', $company_id);

		if ($query->num_rows() != 1) {
			redirect(base_url() .'partner/index');
		}

		$partner = $query->first_row();
		$partner_array = $query->first_row('array');

		if ($this->input->post('form') == 'company-settings') 
		{
			if ($this->form_validation->run('parnter/settings/company-settings') == FALSE) {
				$this->load->view('partner/applications/settings', $partner_array);
				$this->load->view('elements/footer');

				return;
			}

			// TODO: Make path absolute? (with asset_url function)
			$upload_path = 'assets/images/partner/'. $company_id .'/';

			if (!create_directory($upload_path, 0777, true)) {
				$partner_array['logo_error'] = 'Das Bild konnte nicht hochgeladen werden: Der Ordner konnte nicht erstellt werden.';
				$partner_array['profile_error'] = 'Das Bild konnte nicht hochgeladen werden: Der Ordner konnte nicht erstellt werden.';
				$partner_array['banner_error'] = 'Das Bild konnte nicht hochgeladen werden: Der Ordner konnte nicht erstellt werden.';

				$this->load->view('partner/applications/settings', $partner_array);
				$this->load->view('elements/footer');

				return;
			}

			$this->upload->initialize(array(
				'upload_path' => $upload_path,
				'allowed_types' => 'jpeg|jpg|png',
				'file_name' => 'logo',
				'file_ext_tolower' => true,
				'optional' => true,
				'overwrite' => true,
				'max_size' => 4 * 1024,
				'max_width' => 3072,
				'max_height' => 3072,
			));

			if (!$this->upload->do_upload('logo')) {
				$partner_array['logo_error'] = $this->upload->display_errors();

				$this->load->view('partner/applications/settings', $partner_array);
				$this->load->view('elements/footer');

				return;
			}

			if ($this->upload->data()['file_size'] != NULL) {
				$logo_url = $upload_path . $this->upload->data()['file_name'];
			} else {
				$logo_url = $partner->company_logo_image_url;
			}

			$this->upload->initialize(array(
				'upload_path' => $upload_path,
				'allowed_types' => 'jpeg|jpg|png',
				'file_name' => 'profile',
				'file_ext_tolower' => true,
				'optional' => true,
				'overwrite' => true,
				'max_size' => 4 * 1024,
				'max_width' => 2048,
				'max_height' => 2048,
			));

			if (!$this->upload->do_upload('profile')) {
				$partner_array['profile_error'] = $this->upload->display_errors();

				$this->load->view('partner/applications/settings', $partner_array);
				$this->load->view('elements/footer');

				return;
			}

			if ($this->upload->data()['file_size'] != NULL) {
				$profile_url = $upload_path . $this->upload->data()['file_name'];
			} else {
				$profile_url = $partner->company_profile_image_url;
			}

			$this->upload->initialize(array(
				'upload_path' => $upload_path,
				'allowed_types' => 'jpeg|jpg|png',
				'file_name' => 'banner',
				'file_ext_tolower' => true,
				'optional' => true,
				'overwrite' => true,
				'max_size' => 8 * 1024,
				'max_width' => 4096,
				'max_height' => 4096,
			));

			if (!$this->upload->do_upload('banner')) {
				$partner_array['banner_error'] = $this->upload->display_errors();

				$this->load->view('partner/applications/settings', $partner_array);
				$this->load->view('elements/footer');

				return;
			}

			if ($this->upload->data()['file_size'] != NULL) {
				$banner_url = $upload_path . $this->upload->data()['file_name'];
			} else {
				$banner_url = $partner->company_banner_image_url;
			}

			$data = array(
				'name' => html_escape($this->input->post('name')),
				'description' => html_escape($this->input->post('description')),
				'location' => html_escape($this->input->post('location')),
				'contact' => html_escape($this->input->post('contact')),
				'job_email' => html_escape($this->input->post('job-email')),
				'contact_email' => html_escape($this->input->post('contact-email')),
				'logo_image_url' => $logo_url,
				'profile_image_url' => $profile_url,
				'banner_image_url' => $banner_url,
			);

			$this->Partner->edit_partner($company_id, $data);

			$session_data = $this->Partner->get_partner('filter:id', $company_id)->result_array()[0];
			$session_data['logged_in'] = true;

			$this->session->set_userdata(array('partner' => $session_data));

			redirect(base_url() .'partner/settings');
		} 
		else if ($this->input->post('form') == 'sector-settings') 
		{
			$data = array(
				'sectors' => html_escape($this->input->post('sectors[]')),
			);

			$this->Partner->edit_partner($company_id, $data);

			redirect(base_url() .'partner/settings');
		} 
		else if ($this->input->post('form') == 'web-settings') 
		{
			$data = array(
				'website' => html_escape($this->input->post('website')),
				'facebook' => html_escape($this->input->post('facebook')),
				'google' => html_escape($this->input->post('google')),
				'linkedin' => html_escape($this->input->post('linkedin')),
				'twitter' => html_escape($this->input->post('twitter')),
				'xing' => html_escape($this->input->post('xing')),
				'youtube' => html_escape($this->input->post('youtube')),
			);

			$this->Partner->edit_partner($company_id, $data);

			redirect(base_url() .'partner/settings');
		} 
		else if ($this->input->post('form') == 'change-password') 
		{
			if ($this->form_validation->run('partner/settings/change-password') == FALSE) {
				$this->load->view('partner/applications/settings', $partner_array);
				$this->load->view('elements/footer');

				return;
			}

			$current_password = $this->input->post('current-password');
			$new_password = $this->input->post('new-password');

			// The entered current password is wrong
			if ($partner->user_password_hash != $this->User->password_hash($partner->user_email, $current_password)) {
				$partner_array['current_password_error'] = 'Das eingegebene Passwort ist falsch.';

				$this->load->view('partner/applications/settings', $partner_array);
				$this->load->view('elements/footer');

				return;
			}

			$this->User->update_password($company_id, $new_password);

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
			$this->email->to($email);

			$this->email->subject('Ihr Passwort wurde geändert');

			$email_data = array(
				'salutation' => 'Sehr geehrte Damen und Herren!',
				'email' => $partner->user_email,
				'date' => date('d.m.Y'),
				'time' => date('H:i:s'),
			);

			$this->email->message($this->parser->parse('template/email/partner/change-password', $email_data, true));

			$this->email->send();

			$session_data = $this->Partner->get_partner('filter:id', $company_id)->result_array()[0];
			$session_data['logged_in'] = true;

			$this->session->set_userdata(array('partner' => $session_data));

			redirect(base_url() .'partner/settings');
		} 
		else if ($this->input->post('form') == 'misc-settings') 
		{
			$settings = get_cookie_array('pr_partner_settings');

			if ($settings == null) {
				$settings = array();
			}

			$settings['last_update'] = date('d.m.Y H:i:s');
			$settings['adblock_notification'] = $this->input->post('adblock-notification') != NULL;
			
			$this->User->set_allow_newsletter($company_id, ($this->input->post('allow-newsletter') != NULL));

			$cookie = array(
				'name'   => 'partner_settings',
				'value'  => json_encode($settings),
				'expire' => $this->config->item('cookie_default_expiration'),
			);

			$this->input->set_cookie($cookie);

			redirect(base_url() .'partner/settings');
		}

		$this->load->view('partner/applications/settings', $partner_array);
		
		$this->load->view('elements/footer');
	}

}
