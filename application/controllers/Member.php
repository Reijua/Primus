<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if (($language = get_cookie('language')) != NULL && in_array($language, $this->config->item('supported_languages'))) {
			load_language($language);
		}
	}

	public function index()
	{
		if ($this->session->member['logged_in']) {
			redirect(base_url() .'member/feed');
		} else {
			redirect(base_url() .'member/login');
		}
	}

	public function search()
	{
		if ((!$this->session->member['logged_in'] && !$this->session->partner['logged_in']) || $this->input->post('form') == NULL) {
			redirect(base_url() .'member/index');
		}

		// Name entered
		$name = trim($this->input->post('name'));

		// Array of selected departments
		$departments = $this->input->post('departments');

		// Array of selected classes
		$classes = $this->input->post('classes');

		// Determine the filters
		$filter_name = !empty($name);
		$filter_department = !empty($departments);
		$filter_class = !empty($classes);

		$query = $this->Member->get_member('all');

		// No members were found
		if ($query->num_rows() == 0) {
			$data = array(
				'error' => 'Es wurden keine Absolventen gefunden.',
			);

			header('Content-Type: application/json');
			echo json_encode($data);

			return;
		}

		// No search-criteria was sent -> show all members
		if (!$filter_name && !$filter_department && !$filter_class) {
			foreach ($query->result() as $i => $member) {
				// Determine image tag
				if ($member->member_profile_image_url != NULL) {
					$image = '<img class="media-object dp img-circle" src="'. base_url() . $member->member_profile_image_url .'">';
				} else {
					$image = '<img class="media-object dp img-circle" src="'. asset_url('images/placeholder/'. $member->gender_salutation .'.png') .'">';
				}

				// Determine class tag
				if ($member->class_id != NULL) {
					$class = $member->department_name .' | '. $member->class_end_year .'<br />';
				} else {
					$class = '';
				}

				// Determine email tag
				/*if ($member->member_allows_email_contact == 1) {
					$email = '<i class="fa fa-envelope"></i> <a href="mailto:'. $member->user_email .'" target="_blank">'. $member->user_email .'</a>';
				} else {
					$email = '';
				}*/

				if ($this->input->post('usertype') == 'member') {
					$data = array(
						'gender' => $member->gender_description,
						'title' => '<a class="load-modal" data-source="/member/messages/write-message/'. $member->user_id .'">'. ($member->member_title != NULL ? $member->member_title : ''),
						'firstname' => $member->member_firstname,
						'lastname' => mb_strtoupper(mb_substr($member->member_lastname, 0, 1, "UTF-8"), "UTF-8") .'.</a>',
						'image' => '<a class="load-modal" data-source="/member/messages/write-message/'. $member->user_id .'">'. $image .'</a>',
						'class' => $class,
						'email' => '',
						'html_before' => '<div class="col-lg-4 col-md-6">',
						'html_after' => '</div>',
					);
				} else {
					$data = array(
						'gender' => $member->gender_description,
						'title' => ($member->member_title != NULL ? $member->member_title : ''),
						'firstname' => $member->member_firstname,
						'lastname' => mb_strtoupper(mb_substr($member->member_lastname, 0, 1, "UTF-8"), "UTF-8").'.',
						'image' => $image,
						'class' => $class,
						'email' => '',
						'html_before' => '<div class="col-lg-4 col-md-6">',
						'html_after' => '</div>',
					);
				}

				echo $this->parser->parse('template/profile/member-card', $data, true);
			}

			return;
		}

		$response = '';

		foreach ($query->result() as $i => $member) {
			$has_name = false;
			$has_department = false;
			$has_class = false;

			if ($filter_name) {
				// The entered name contains a space
				if (preg_match('/\s/', $name)) {
					// The member_firstname + the member_lastname contain the entered name
					$has_name = (stripos($member->member_firstname .' '. mb_strtoupper(mb_substr($member->member_lastname, 0, 1, "UTF-8"), "UTF-8"), $name) !== false);
				} else {
					// The member_firstname or the member_lastname contains the entered name
					$has_name = stripos($member->member_firstname, $name) !== false; // || stripos($member->member_lastname, $name) !== false);
				}
			}

			if ($filter_department) {
				// The department_id is one of the selected departments
				if (in_array($member->department_id, $departments)) {
					$has_department = true;
				}
			}

			if ($filter_class) {
				// The class_end_year is one of the selected classes
				if (in_array($member->class_end_year, $classes)) {
					$has_class = true;
				}
			}

			$filter = $has_name || $has_department || $has_class;

			if ($filter_name) {
				$filter = $has_name;
			}

			if ($filter_class) {
				$filter = $has_class;
			}

			if ($filter_department) {
				$filter = $has_department;
			}

			if ($filter_name && $filter_department) {
				$filter = $has_name && $has_department;
			}

			if ($filter_name && $filter_class) {
				$filter = $has_name && $has_class;
			}

			if ($filter_class && $filter_department) {
				$filter = $has_class && $has_department;
			}

			if ($filter_name && $filter_department && $filter_class) {
				$filter = $has_name && $has_department && $has_class;
			}

			if ($filter) {
				// Determine image tag
				if ($member->member_profile_image_url != NULL) {
					$image = '<img class="media-object dp img-circle" src="'. base_url() . $member->member_profile_image_url .'">';
				} else {
					$image = '<img class="media-object dp img-circle" src="'. asset_url('images/placeholder/'. $member->gender_salutation .'.png') .'">';
				}

				// Determine class tag
				if ($member->class_id != NULL) {
					$class = $member->department_name .' | '. $member->class_end_year .'<br />';
				} else {
					$class = '';
				}

				// Determine email tag
				/*if ($member->member_allows_email_contact == 1) {
					$email = '<i class="fa fa-envelope"></i> <a href="mailto:'. $member->user_email .'" target="_blank">'. $member->user_email .'</a>';
				} else {
					$email = '';
				}*/
				
				if ($this->input->post('usertype') == 'member') {
					$data = array(
						'gender' => $member->gender_description,
						'title' => '<a class="load-modal" data-source="/member/messages/write-message/'. $member->user_id .'">'. ($member->member_title != NULL ? $member->member_title : ''),
						'firstname' => $member->member_firstname,
						'lastname' => mb_strtoupper(mb_substr($member->member_lastname, 0, 1, "UTF-8"), "UTF-8") .'.</a>',
						'image' => '<a class="load-modal" data-source="/member/messages/write-message/'. $member->user_id .'">'. $image .'</a>',
						'class' => $class,
						'email' => '',
						'html_before' => '<div class="col-lg-4 col-md-6">',
						'html_after' => '</div>',
					);
				} else {
					$data = array(
						'gender' => $member->gender_description,
						'title' => ($member->member_title != NULL ? $member->member_title : ''),
						'firstname' => $member->member_firstname,
						'lastname' => mb_strtoupper(mb_substr($member->member_lastname, 0, 1, "UTF-8"), "UTF-8"),
						'image' => $image,
						'class' => $class,
						'email' => '',
						'html_before' => '<div class="col-lg-4 col-md-6">',
						'html_after' => '</div>',
					);
				}

				$response .= $this->parser->parse('template/profile/member-card', $data, true);
			}
		}

		if (empty($response)) {
			// There was no member who matched the filter

			$data = array(
				'error' => 'Es wurden keine passenden Absolventen gefunden.',
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
			'title' => 'Primus Romulus - '. lang('elements_header_member'), 
			'page' => 'member',
		);

		$this->load->view('elements/header', $header_data);

		$message = array(
			'type' => 'error',
			'message' => 'Der Link ist ungültig!',
		);

		if (!empty($email) && valid_email($email) && !empty($token)) {
			$query = $this->Member->get_member('filter:email', $email);

			if ($query->num_rows() == 1) {
				$member = $query->first_row();

				if ($member->user_password_reset_token == $token) {
					$this->User->renew_password_reset_token($email);

					$new_password = bin2hex(openssl_random_pseudo_bytes(4));

					$this->User->update_password($member->member_id, $new_password);

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
					$this->email->to($member->user_email);

					$this->email->subject('Ihr Passwort wurde zurückgesetzt');

					$email_data = array(
						'salutation' => 'Hallo '. $member->member_firstname .'!',
						'email' => $member->user_email,
						'date' => date('d.m.Y'),
						'time' => date('H:i:s'),
						'new_password' => $new_password,
					);

					$this->email->message($this->parser->parse('template/email/member/reset-password', $email_data, true));

					$this->email->send();

					$message = array(
						'type' => 'success',
						'message' => 'Das Passwort von Ihrem Account wurde erfolgreich zurückgesetzt!<br />Wir haben Ihnen eine E-Mail mit Ihrem neuen Passwort gesendet.<br />Wir empfehlen dieses Passwort umgehend im Einstellungsmenü zu ändern!',
					);
				}
			}
		}

		$this->load->view('member/reset', $message);

		$this->load->view('elements/footer');
	}

	public function activate()
	{
		$email = html_escape($this->input->get('email'));
		$token = html_escape($this->input->get('token'));

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_member'), 
			'page' => 'member',
		);

		$this->load->view('elements/header', $header_data);

		$message = array(
			'type' => 'error',
			'message' => 'Der Aktivierungs-Link ist ungültig!',
		);

		if (!empty($email) && valid_email($email) && !empty($token)) {
			$query = $this->Member->get_register_token($email);

			if ($query->num_rows() == 1) {
				$row = $query->first_row();

				if ($row->membertoken_used == 0 && $row->membertoken_register_token == $token) {
					$this->Member->use_register_token($email, $token);

					$message = array(
						'type' => 'success',
						'message' => 'Vielen Dank, dass Sie Ihren Account bestätigt haben!<br />Nachdem wir Ihre Account-Daten überprüft haben, können Sie diese Plattform nutzen!',
					);
				}
			}
		}

		$this->load->view('member/activate', $message);

		$this->load->view('elements/footer');
	}

	public function register()
	{
		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_member'), 
			'page' => 'member',
		);

		$this->load->view('elements/header', $header_data);

		// User tried to register but validation failed
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('member/register');
		}

		// User tried to register and validation succeeded
		else {
			$salutation = html_escape($this->input->post('salutation'));
			$title = html_escape($this->input->post('title'));
			$firstname = html_escape($this->input->post('firstname'));
			$lastname = html_escape($this->input->post('lastname'));
			$birthdate = DateTime::createFromFormat('d.m.Y', html_escape($this->input->post('birthdate')))->format('Y-m-d');
			$email = html_escape($this->input->post('email'));
			$password = html_escape($this->input->post('password'));

			$member_id = $this->Member->create_account($salutation, $title, $firstname, $lastname, $birthdate, $email, $password);

			if ($member_id > 0) {
				$message = array(
					'type' => 'success',
					'message' => 'Danke für Ihre Registrierung! Sie werden in Kürze eine E-Mail von uns erhalten, in der die nächsten Schritte erläutert werden.',
				);

				$token = rtrim(base64_encode(md5('register'. $email . microtime() . rand(1000, 9999))), '=');

				$this->Member->create_register_token($member_id, $token);

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

				$this->email->subject('Registrierung bei Primus Romulus');

				$email_data = array(
					'salutation' => 'Hallo '. $firstname .'!',
					'activation_url' => prep_url(base_url() .'member/activate?email='. $email .'&token='. $token),
				);

				$this->email->message($this->parser->parse('template/email/member/register', $email_data, true));

				$this->email->send();
			} else {
				$message = array(
					'type' => 'error',
					'message' => '<strong>Ihr Account konnte aus folgenden Gründen nicht angelegt werden:</strong><ul><li>E-Mail ist bereits registriert.</li></ul>',
				);
			}

			$this->load->view('member/register', $message);
		}

		$this->load->view('elements/footer');
	}

	public function login()
	{
		if ($this->session->member['logged_in']) {
			redirect(base_url() .'member/index');
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_member'), 
			'page' => 'member',
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
					$query = $this->Member->get_member('filter:email', $email);

					if ($query->num_rows() == 1) {
						$member = $query->first_row();

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
						$this->email->to($member->user_email);

						$this->email->subject('Passwort zurücksetzten');

						$email_data = array(
							'salutation' => 'Hallo '. $member->member_firstname .'!',
							'email' => $member->user_email,
							'reset_url' => prep_url(base_url() .'member/reset?email='. $email .'&token='. $member->user_password_reset_token),
						);

						$this->email->message($this->parser->parse('template/email/member/forgot-password', $email_data, true));

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

			$this->load->view('member/forgot-password', $message);
		}

		// User tried to log in but validation failed
		else if ($this->form_validation->run() == FALSE) {
			$this->load->view('member/login');
		}

		// User tried to log in and validation succeeded
		else {
			$email = html_escape($this->input->post('email'));
			$password = html_escape($this->input->post('password'));
			$remember = $this->input->post('remember') != NULL;

			$query = $this->Member->get_member('filter:email', $email);

			if ($query->num_rows() == 1) {
				$user = $query->row();
				if ($this->Member->verified_email($user->user_id)) {
					$locked = $this->Member->is_locked($user->user_id);
				
					if ($locked->num_rows() == 0) {
						if ($user->user_password_hash == $this->User->password_hash($email, $password)) {
							$session_data = $query->result_array()[0];
							$session_data['logged_in'] = true;
							$session_data['member_id'] = $user->user_id;

							$this->session->set_userdata(array('member' => $session_data));
						} else {
							$error = '<li>Das eingegebene Passwort ist falsch.</li>';
						}
					} else if ($locked->num_rows() == 1) {
						if(date('d.m.Y H:i', strtotime($locked->row()->memberblocking_end_date)) == '01.01.1970 01:00')
							$error = '<li>Ihr Account ist bis auf Widerruf gesperrt: '. $locked->row()->memberblocking_reason .'</li>';
						else
							$error = '<li>Ihr Account ist bis '. date('d.m.Y H:i', strtotime($locked->row()->memberblocking_end_date)) .' gesperrt: '. $locked->row()->memberblocking_reason .'</li>';
					} else {
						$error = '<li>Ihr Account ist derzeit gesperrt, bitte <a href="/contact">kontaktieren Sie uns.</a></li>';
					}
				} else {
					$error = '<li>Sie haben Ihren Account noch nicht bestätigt, bitte überprüfen Sie Ihr E-Mail-Postfach!</li>';
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
				$this->load->view('member/login', $message);
			} else {
				redirect(base_url() .'member/index');
			}
		}

		$this->load->view('elements/footer');
	}

	public function logout()
	{
		$this->session->unset_userdata(array('member'));

		redirect(base_url() .'member/index');
	}

	public function feed()
	{
		if (!$this->session->member['logged_in']) {
			redirect(base_url() .'member/index');
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_member'), 
			'page' => 'member',
			'subpage' => 'feed',
		);

		$this->load->view('elements/header', $header_data);

		$this->load->view('member/header', $header_data);
		$this->load->view('member/applications/feed');
		
		$this->load->view('elements/footer');
	}

	public function jobs()
	{
		if (!$this->session->member['logged_in']) {
			redirect(base_url() .'member/index');
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_member'), 
			'page' => 'member',
			'subpage' => 'jobs',
		);

		$this->load->view('elements/header', $header_data);

		$this->load->view('member/header', $header_data);
		$this->load->view('member/applications/jobs');
		
		$this->load->view('elements/footer');
	}

	public function partners()
	{
		if (!$this->session->member['logged_in']) {
			redirect(base_url() .'member/index');
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_member'), 
			'page' => 'member',
			'subpage' => 'partners',
		);

		$this->load->view('elements/header', $header_data);

		$this->load->view('member/header', $header_data);
		$this->load->view('member/applications/partners');
		
		$this->load->view('elements/footer');
	}

	public function members()
	{
		if (!$this->session->member['logged_in']) {
			redirect(base_url() .'member/index');
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_member'), 
			'page' => 'member',
			'subpage' => 'members',
		);

		$this->load->view('elements/header', $header_data);

		$this->load->view('member/header', $header_data);
		$this->load->view('member/applications/members');
		
		$this->load->view('elements/footer');
	}

	public function profile()
	{
		if (!$this->session->member['logged_in']) {
			redirect(base_url() .'member/index');
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_member'), 
			'page' => 'member',
			'subpage' => 'profile',
		);

		$this->load->view('elements/header', $header_data);

		$this->load->view('member/header', $header_data);
		$this->load->view('member/applications/profile');
		
		$this->load->view('elements/footer');
	}

	public function messages($action = '', $id = '')
	{
		if (!$this->session->member['logged_in']) {
			redirect(base_url() .'member/index');
		}

		// Ensure that get-received-message or get-sent-message or write-message have a id set, which is a positive integer
		if (($action == 'get-received-message' || $action == 'get-sent-message' || $action == 'write-message') && (!isset($id) || !ctype_digit($id) || $id <= 0)) {
			$action = '';
		}

		switch ($action) {
			case 'get-received-message':
				$query = $this->Message->get_message('filter:id', $id);

				if ($query->num_rows() != 1) {
					echo 'Fehler: Die Nachricht konnte nicht geladen werden!';

					return;
				}

				$message = $query->first_row();
				$this->Message->set_read_message($id);

				$sender = $this->Member->get_member('filter:id', $message->message_sender_id)->first_row();

				// Determine class tag
				if ($sender->class_id != NULL) {
					$class = $sender->department_name .' | '. $sender->class_end_year .' &#8211; ';
				} else {
					$class = '';
				}

				// Determine image tag
				if ($sender->member_profile_image_url != NULL) {
					$image = '<img class="media-object dp img-circle" src="'. base_url() . $sender->member_profile_image_url .'">';
				} else {
					$image = '<img class="media-object dp img-circle" src="'. asset_url('images/placeholder/'. $sender->gender_salutation .'.png') .'">';
				}

				$data = array(
					'user_id' => $sender->user_id,
					'gender' => $sender->gender_description,
					'title' => ($sender->member_title != NULL ? $sender->member_title : ''),
					'firstname' => $sender->member_firstname,
					'lastname' => $sender->member_lastname,
					'image' => $image,
					'class' => $class,
					'date' => date('d.m.Y H:i', strtotime($message->message_date_sent)),
					'subject' => $message->message_subject,
					'text' => nl2br(auto_link($message->message_text, 'url', true)),
				);

				echo $this->parser->parse('template/message/received-message', $data, true);

				return;
			case 'get-sent-message':
				$query = $this->Message->get_message('filter:id', $id);

				if ($query->num_rows() != 1) {
					echo 'Fehler: Die Nachricht konnte nicht geladen werden!';

					return;
				}

				$message = $query->first_row();

				$recipient = $this->Member->get_member('filter:id', $message->message_recipient_id)->first_row();

				// Determine class tag
				if ($recipient->class_id != NULL) {
					$class = $recipient->department_name .' | '. $recipient->class_end_year .' &#8211; ';
				} else {
					$class = '';
				}

				// Determine image tag
				if ($recipient->member_profile_image_url != NULL) {
					$image = '<img class="media-object dp img-circle" src="'. base_url() . $recipient->member_profile_image_url .'">';
				} else {
					$image = '<img class="media-object dp img-circle" src="'. asset_url('images/placeholder/'. $recipient->gender_salutation .'.png') .'">';
				}

				$data = array(
					'user_id' => $recipient->user_id,
					'gender' => $recipient->gender_description,
					'title' => ($recipient->member_title != NULL ? $recipient->member_title : ''),
					'firstname' => $recipient->member_firstname,
					'lastname' => $recipient->member_lastname,
					'image' => $image,
					'class' => $class,
					'date' => date('d.m.Y H:i', strtotime($message->message_date_sent)),
					'subject' => $message->message_subject,
					'text' => nl2br(auto_link($message->message_text, 'url', true)),
				);

				echo $this->parser->parse('template/message/sent-message', $data, true);

				return;
			case 'write-message':
				$query = $this->Member->get_member('filter:id', $id);

				if ($query->num_rows() != 1) {
					$message = array(
						'type' => 'error',
						'message' => 'Die Person kann nicht kontaktiert werden: Die Person konnte nicht gefunden werden.',
					);

					$this->load->view('elements/modal-alert', $message);

					return;
				}

				$member = $query->first_row();

				// Determine class tag
				if ($member->class_id != NULL) {
					$class = ', '. $member->department_name .' | '. $member->class_end_year;
				} else {
					$class = '';
				}

				$data = array(
					'id' => $id,
					'recipient' => $member->gender_description .' <strong>'. $member->member_firstname .' '. mb_strtoupper(mb_substr($member->member_lastname, 0, 1, "UTF-8"), "UTF-8") .'.</strong>'. $class,
				);

				// Request from: application/views/member/applications/messages/write-message.php
				// with $_POST data set
				if ($this->input->post('form') != NULL) {
					$subject = html_escape($this->input->post('subject'));
					$message = html_escape($this->input->post('message'));

					if ($this->form_validation->run('messages/write-message') == FALSE) {
						$this->load->view('member/applications/messages/write-message', $data);

						return;
					}

					if ($this->Message->write_message($this->session->member['user_id'], $id, $subject, $message) > 0) {
						$message = array(
							'type' => 'success',
							'message' => 'Ihre Nachricht <strong>'. $subject .'</strong> wurde erfolgreich gesendet.',
						);

						$this->load->view('elements/modal-alert', $message);
					} else {
						$message = array(
							'type' => 'error',
							'message' => 'Die Nachricht konnte nicht gesendet werden.',
						);

						$this->load->view('elements/modal-alert', $message);
					}
				} else {
					$this->load->view('member/applications/messages/write-message', $data);
				}

				return;
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_member'), 
			'page' => 'member',
			'subpage' => 'messages',
		);

		$this->load->view('elements/header', $header_data);

		$this->load->view('member/header', $header_data);
		$this->load->view('member/applications/messages');
		
		$this->load->view('elements/footer');
	}

	public function settings()
	{
		if (!$this->session->member['logged_in']) {
			redirect(base_url() .'member/index');
		}

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_member'), 
			'page' => 'member',
			'subpage' => 'settings',
		);

		$this->load->view('elements/header', $header_data);

		$this->load->view('member/header', $header_data);

		$member_id = $this->session->member['user_id'];
		$query = $this->Member->get_member('filter:id', $member_id);

		if ($query->num_rows() != 1) {
			redirect(base_url() .'member/index');
		}

		$member = $query->first_row();
		$member_array = $query->first_row('array');

		if ($this->input->post('form') == 'personal-settings') 
		{
			if ($this->form_validation->run('member/settings/personal-settings') == FALSE) 
			{
				$this->load->view('member/applications/settings', $member_array);
				$this->load->view('elements/footer');

				return;
			}

			// TODO: Make path absolute? (with asset_url function)
			$upload_path = 'assets/images/member/'. $member_id .'/';

			if (!create_directory($upload_path, 0777, true)) {
				$member_array['image_error'] = 'Das Bild konnte nicht hochgeladen werden: Der Ordner konnte nicht erstellt werden.';

				$this->load->view('member/applications/settings', $member_array);
				$this->load->view('elements/footer');

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
				$member_array['image_error'] = $this->upload->display_errors();

				$this->load->view('member/applications/settings', $member_array);
				$this->load->view('elements/footer');

				return;
			}

			if ($this->upload->data()['file_size'] != NULL) {
				$image_url = $upload_path . $this->upload->data()['file_name'];
			} else {
				$image_url = $member->member_profile_image_url;
			}

			$data = array(
				'title' => html_escape($this->input->post('title')),
				'firstname' => html_escape($this->input->post('firstname')),
				'lastname' => html_escape($this->input->post('lastname')),
				'profile_image_url' => $image_url,
			);

			$this->Member->edit_member($member_id, $data);

			$session_data = $this->Member->get_member('filter:id', $member_id)->result_array()[0];
			$session_data['logged_in'] = true;

			$this->session->set_userdata(array('member' => $session_data));

			redirect(base_url() .'member/settings');
		} 
		else if ($this->input->post('form') == 'specific-settings') 
		{
			$class_id = $this->input->post('class');
			$company = $this->input->post('company');

			// The class is not valid
			if (!isset($class_id) || !ctype_digit($class_id) || $class_id <= 0) {
				$class_id = NULL;
			}

			$data = array(
				'about_text' => html_escape($this->input->post('about-text')),
				'class_id' => $class_id,
				'company_name' => $company,
			);

			$this->Member->edit_member($member_id, $data);

			$session_data = $this->Member->get_member('filter:id', $member_id)->result_array()[0];
			$session_data['logged_in'] = true;

			$this->session->set_userdata(array('member' => $session_data));

			redirect(base_url() .'member/settings');
		} 
		else if ($this->input->post('form') == 'change-password') 
		{
			if ($this->form_validation->run('member/settings/change-password') == FALSE) {
				$this->load->view('member/applications/settings', $member_array);
				$this->load->view('elements/footer');

				return;
			}

			$current_password = $this->input->post('current-password');
			$new_password = $this->input->post('new-password');

			// The entered current password is wrong
			if ($member->user_password_hash != $this->User->password_hash($member->user_email, $current_password)) {
				$member_array['current_password_error'] = 'Das eingegebene Passwort ist falsch.';

				$this->load->view('member/applications/settings', $member_array);
				$this->load->view('elements/footer');

				return;
			}

			$this->User->update_password($member_id, $new_password);

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
			$this->email->to($member->user_email);

			$this->email->subject('Ihr Passwort wurde geändert');

			$email_data = array(
				'salutation' => 'Hallo '. $member->member_firstname .'!',
				'email' => $member->user_email,
				'date' => date('d.m.Y'),
				'time' => date('H:i:s'),
			);

			$this->email->message($this->parser->parse('template/email/member/change-password', $email_data, true));

			$this->email->send();

			$session_data = $this->Member->get_member('filter:id', $member_id)->result_array()[0];
			$session_data['logged_in'] = true;

			$this->session->set_userdata(array('member' => $session_data));

			redirect(base_url() .'member/settings');
		} 
		else if ($this->input->post('form') == 'misc-settings') 
		{
			$this->Member->set_allow_email_contact($member_id, ($this->input->post('allow-email-contact') != NULL));
			$this->User->set_allow_newsletter($member_id, ($this->input->post('allow-newsletter') != NULL));
			
			redirect(base_url() .'member/settings');
		}

		$this->load->view('member/applications/settings', $member_array);
		
		$this->load->view('elements/footer');
	}

	public function polls() {

		if (!$this->session->member['logged_in']) {
			redirect(base_url() .'member/feed');
		}

		$data['results'] = $this->Poll->get_polls();
		$data['options'] = $this->Poll->get_Options_For_Poll();
		$data['voted'] = $this->Poll->get_Votes_Poll();
		$data['member_id'] = $this->session->member['member_id'];

		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_member'), 
			'page' => 'member',
			'subpage' => 'polls',
		);

		$this->load->view('elements/header', $header_data);

		$this->load->view('member/header', $header_data);
		$this->load->view('member/applications/polls/index.php', $data);
		
		$this->load->view('elements/footer');
	}

		public function vote() {
			if (!$this->session->member['logged_in']) {
			redirect(base_url() .'member/feed');
			} 

			$option_id = $this->uri->segment(3);
			$poll_id = $this->uri->segment(4);
			$member_id = $this->uri->segment(5);

		if ($this->Poll->user_Voted($member_id, $poll_id) == 0)
		{
			$this->Poll->vote_For_Option($option_id, $member_id);
			$data['success'] = "Danke für's voten!";
		}	

		else {
			$data['success'] = "Nice Try :)";
		}	

		redirect(base_url() .'member/polls');
	}

}
