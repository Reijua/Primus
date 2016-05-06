<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('member/M_account_model');
		if(!$this->input->is_ajax_request()){
			show_404();
		}
	}

	public function index()
	{
		show_404();
	}

	public function login(){
		if(!$this->session->userdata('login')){
			$this->load->helper('email');
			$this->load->library('user_agent');

			$username=html_escape($this->input->get_post('username'));
			$password=html_escape($this->input->get_post('password'));

			if(empty($username)){
				$data['error']=TRUE;
				$data['p_element_focus']="signin_username";
				$data['message'] = "Bitte geben Sie Ihre E-Mail-Adresse ein.";
			}else if(!valid_email($username)){
				$data['error']=TRUE;
				$data['p_element_reset']=array("signin_username");
				$data['p_element_focus']="signin_username";
				$data['message'] = "Bitte geben Sie ein gültige E-Mail-Adresse ein.";
			}else if(empty($password)){
				$data['error']=TRUE;
				$data['p_element_focus']="signin_password";
				$data['message'] = "Bitte geben Sie Ihr Passwort ein.";
			}else{
				if($this->M_account_model->get_account("filter:email", $username)->num_rows()==1){
					$v_account = $this->M_account_model->get_account("filter:email", $username)->row();
					if($this->M_account_model->is_locked($v_account->member_id)->num_rows() == 1){
						$data['error']=TRUE;
						$data['p_element_reset']=array("signin_password");
						$data['message'] = "Ihr Konto ist zurzeit gesperrt.".($this->M_account_model->is_locked($v_account->member_id)->row()->blocking_reason != "" ? "\n\n".$this->M_account_model->is_locked($v_account->member_id)->row()->blocking_reason."" : "")."\n\nBei Fragen wenden sie sich bitte an support@primus-romulus.net.";
					}else if($v_account->member_password_hash == $this->M_account_model->password_hash($username,$password)){
						if($this->input->get_post('email_save') == 1){
							$this->input->set_cookie("account_id", $v_account->member_id, 31104000);
						}else{
							$this->load->helper("cookie");
							delete_cookie("account_id");
						}
						$this->M_account_model->delete_failed_login($v_account->member_id);
						$this->M_account_model->log_activity($v_account->member_id, "login success", $this->input->ip_address(), $this->agent->browser(), (!$this->agent->is_mobile() ? $this->agent->platform() : $this->agent->mobile()));
						$this->M_account_model->log_last_login($v_account->member_id, $this->input->ip_address());
						$session_data = array(
							'login'=> TRUE,
							'account_id' => $v_account->member_id,
							'account_last_ip' => $v_account->member_last_ip,
							'account_last_login' => $v_account->member_last_login
						);
						$this->session->set_userdata($session_data);
						$data['error']=FALSE;
						$data['message']="Sie haben sich erfolgreich angemeldet.";
					}else{
						$this->M_account_model->log_failed_login($v_account->member_id, $this->input->ip_address());
						$v_count_failed_login = $this->M_account_model->get_failed_login($v_account->member_id)->num_rows();
						switch ($v_count_failed_login) {
							case 3:
							case 4:
							case 5:
								$v_try = 6 - $v_count_failed_login;
								$data['message'] = "Das eingegeben Passwort ist falsch.\n\nSie haben noch ".( $v_try > 1 ? $v_try.' Versuche' : 'einen Versuch')." bis Ihr Konto für eine Stunde gesperrt wird.\n\nSollte Sie das Passwort nicht mehr wissen, dann setzen Sie es bitte zurück bevor Ihr Konto gesperrt wird.";
							break;
							case 6:
								$this->M_account_model->lock_account($v_account->member_id, 3600, "Sie haben zu oft ein falsches Passwort eingegeben! Bitte versuchen Sie es später noch einmal.");
								$data['message'] = "Ihr Konto wurde für eine Stunde gesperrt, da Sie Ihr Passwort 6 Mal infolge falsch eingegeben haben.";
							break;
							case 7:
							case 8:
								$v_try = 9 - $v_count_failed_login;
								$data['message'] = "Das eingegeben Passwort ist falsch.\n\nSie haben noch ".( $v_try > 1 ? $v_try.' Versuche' : 'einen Versuch')." bis Ihr Konto für 24 Stunde gesperrt wird.\n\nSollte Sie das Passwort nicht mehr wissen, dann setzen Sie es bitte zurück bevor Ihr Konto gesperrt wird.";
							break;
							case 9:
								$this->M_account_model->lock_account($v_account->member_id, 86400, "Sie haben zu oft ein falsches Passwort eingegeben! Bitte versuchen Sie es später noch einmal.");
								$data['message'] = "Ihr Konto wurde für 24 Stunden gesperrt, da Sie Ihr Passwort 9 Mal infolge falsch eingegeben haben.";
							break;
							case 10:
							case 11:
								$v_try = 12 - $v_count_failed_login;
								$data['message'] = "Das eingegeben Passwort ist falsch.\n\nSie haben noch ".( $v_try > 1 ? $v_try.' Versuche' : 'einen Versuch')." bis Ihr Konto für immer gesperrt wird.\n\nSollte Sie das Passwort nicht mehr wissen, dann setzen Sie es bitte zurück bevor Ihr Konto gesperrt wird.";
							break;
							case 12:
								$this->M_account_model->lock_account($v_account->member_id, -1, "Ihr Konto wurde gesperrt, da Ihr Passwort zu oft falsch eingegeben wurde. Bitte wenden Sie sich an die unten angegebene E-Mail-Adresse.");
								$data['message'] = "Ihr Konto wurde für immer gesperrt, da Sie Ihr Passwort 12 Mal infolge falsch eingegeben haben. Damit Ihr Konto wieder freigeschaltet werden kann, wenden Sie sich bitte an support@primus-romulus.net.";
							break;
							default:
								$data['message'] = "Das eingegeben Passwort ist falsch.";
							break;
						}
						$data['error']=TRUE;
						$data['p_element_reset']=array("signin_password");
					}
				}else{
					$data['error']=TRUE;
					$data['p_element_reset']=array("signin_username","signin_password");
					$data['message'] = "Dieses Konto existiert noch nicht";
				}
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}		
	}

	public function register(){
		if(!$this->session->userdata('login')){
			$this->load->helper("email");

			$salutation = html_escape($this->input->get_post("salutation"));
			$title = html_escape($this->input->get_post("title"));
			$firstname = html_escape($this->input->get_post("firstname"));
			$lastname = html_escape($this->input->get_post("lastname"));
			$birthday_day = html_escape($this->input->get_post("birthday_day"));
			$birthday_month = html_escape($this->input->get_post("birthday_month"));
			$birthday_year = html_escape($this->input->get_post("birthday_year"));
			$email = html_escape($this->input->get_post("email"));

			if($this->M_account_model->check_sign_up_blocking($this->input->ip_address())->num_rows()>=1){
				$data['error'] = TRUE;
				$data['message']= "Sie haben bereits ein Konto erstellt.";
			}else if($salutation == 0){
				$data['error'] = TRUE;
				$data['message']= "Bitte wählen Sie Ihre Anrede aus.";				
	        }else if(empty($firstname)){
	        	$data['error'] = TRUE;
	        	$data['p_element_focus']="signup_firstname";
				$data['message']= "Bitte geben Sie Ihren Vornamen ein.";
	        }else if(empty($lastname)){
	        	$data['error'] = TRUE;
	        	$data['p_element_focus']="signup_lastname";
	        	$data['message']= "Bitte geben Sie Ihren Nachnamen ein.";
	        }else if(empty($birthday_day)){
	        	$data['error'] = TRUE;
	        	$data['p_element_focus']="signup_birthday_day";
	        	$data['message']= "Bitte geben Sie den Tag Ihres Geburtstages ein.";
	        }else if(!is_int(intval($birthday_day)) || !is_numeric($birthday_day) || $birthday_day > 31 ||  $birthday_day < 1 || strlen(intval($birthday_day)) > 2){
	        	$data['error'] = TRUE;
	        	$data['p_element_reset']=array("signup_birthday_day");
	        	$data['p_element_focus']="signup_birthday_day";
	        	$data['message']= "Der Tag wurde nicht richtig eingegeben. Achten Sie darauf, das die Zahl zwischen 1 und 31 ist.";
	        }else if($birthday_month==0){
	        	$data['error'] = TRUE;
				$data['message']= "Bitte wählen Sie den Monat Ihres Geburtstages aus.";
	        }else if(empty($birthday_year)){
	        	$data['error'] = TRUE;
	        	$data['p_element_focus']="signup_birthday_year";
	        	$data['message']= "Bitte geben Sie das Jahr Ihres Geburtstages ein.";
	        }else if(!is_int(intval($birthday_year)) || !is_numeric($birthday_year) || strlen(intval($birthday_year)) != 4){
	        	$data['error'] = TRUE;
	        	$data['p_element_focus']="signup_birthday_year";
	        	$data['p_element_reset']=array("signup_birthday_year");
	        	$data['message']= "Das Jahr wurde nicht richtig eingegeben. Achten Sie darauf, vier Ziffern zu verwenden.";
	        }else if(!checkdate($birthday_month, $birthday_day, $birthday_year)){
	        	$data['error'] = TRUE;
	        	$data['p_element_reset']=array("signup_birthday_day", "signup_birthday_year");
	        	if($birthday_day >= 29 && $birthday_month == 2){
	        		$data['message']= "Der Februar hatte nur 28 Tage im Jahr {$birthday_year}.";
	        	}else if($birthday_day > 30 && ($birthday_month == 4|| $birthday_month == 6 || $birthday_month == 9 || $birthday_month == 11)){
	        		$data['message']= "Dieses Monat hat nur 30 Tage.";
	        	}else{
	        		$data['message']= "Das Geburtsdatum ist ungültig.";
	        	}	        	
	        }else if(empty($email)){
	        	$data['error']=TRUE;
	        	$data['p_element_focus']="signup_email";
	        	$data['message']= "Bitte geben Sie Ihre E-Mail-Adresse ein.";
	        }else if(!valid_email($email)){
	        	$data['error']=TRUE;
	        	$data['p_element_reset']=array("signup_email");
	        	$data['p_element_focus']="signup_email";
	        	$data['message']= "Bitte geben Sie eine gültige E-Mail-Adresse ein.";
	        }else{
				if($this->M_account_model->get_account("filter:email", $email)->num_rows() == 0){
	        		$birthday = $birthday_year.'-'.$birthday_month.'-'.$birthday_day;

	        		//Berechne ersten Passworthash, der das zu Erst angelegte Standardpasswort ist
					$rand = rand(1000, 9999);
					$firstPassword = md5($rand);
					$hash = $this->M_account_model->password_hash($email, $firstPassword);
					
					//Erstelle Account mit dem Passworthash
	        		$v_id = $this->M_account_model->create_account($salutation, $title, $firstname, $lastname, $birthday, $email, $hash);

					// Registrierungstoken anlegen
					$this->M_account_model->create_register_token($v_id, $firstPassword);
					
					//Verschicke E-Mail mit dem $firstPassword als GET-Parameter in einem Link, z.B. /member/verify?code=$firstPassword
	        		$config = Array(
						'protocol'	=> 'smtp',
						'smtp_host'	=> 'smtp.world4you.com',
						'smtp_port'	=> 587,
						'smtp_user'	=> 'noreply@primus-romulus.net', // Ersetzen mit richtiger Mail
						'smtp_pass'	=> 'maborD8*',
						'mailtype'	=> 'html',
						'charset'	=> 'utf-8', // iso-8859-1
						'starttls'	=> true,
					);

					$this->load->library('email', $config);

					$this->email->set_newline("\r\n");
					$this->email->from('noreply@primus-romulus.net', 'Primus Romulus');
					$this->email->to($email); // Ersetzen mit $email
					$this->email->subject('Registrierung bei Primus Romulus');
					$link = "http://primus-romulus.net/member/register?email=$email&code=$firstPassword";
					$this->email->message('Danke, dass Sie sich bei Primus Romulus registriert haben.<br />'.
					'Um den Vorgang abzuschließen klicken sie bitte auf folgenden Link: <a href="'.$link.'">'.$link.'</a>');
					$this->email->send();
					
					//Derzeit deaktiviert, um leichter testen zu können.
					$this->M_account_model->lock_account($v_id, -1, "Ihre eingegeben Daten werden zur Zeit überprüft. Wir melden uns sobald wir mit diesem Vorgang fertig sind.");
	        		$this->M_account_model->create_sign_up_blocking($this->input->ip_address());

					

	        		$data['error'] = FALSE;
	        		$data['message'] = "Danke, dass Sie sich bei Primus Romulus angemeldet haben. Wir werden Ihre Daten so schnell es geht überprüfen.";
	        	}else{
	        		$data['error'] = TRUE;
	        		$data['message']="Sie besitzen bereits ein Konto bei Primus Romulus.";
	        	}
	        }
			$this->load->view("plugin/system/form_response",$data);
    	}else{
    		show_404();
    	}
	}

	public function register_password(){
		if(!$this->session->userdata('login')){
			$this->load->helper("email");
			$p_email = html_escape($this->input->get_post("email"));
			$p_code = html_escape($this->input->get_post("code"));
			$p_password = html_escape($this->input->get_post("password"));
			$p_password_confirm = html_escape($this->input->get_post("password_confirm"));
			if(empty($p_password)){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_password";
				$data['message']="Bitte gib dein neues Passwort ein.";
			}else if(empty($p_password_confirm)){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_password_confirm";
				$data['message']="Bitte bestätige dein neues Passwort.";
			}else if($p_password!=$p_password_confirm){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_password";
				$data['p_element_reset']=array("signup_password","signup_password_confirm");
				$data['message']="Das neue Passwort stimmt mit der Bestätigung nicht überein.";
			}else if(strlen($p_password) < 8){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_password";
				$data['p_element_reset']=array("signup_password","signup_password_confirm");
				$data['message']="Das Passwort muss mindestens 8 Zeichen enthalten.";
			}else if(!preg_match("/[A-Z]/", $p_password)){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_password";
				$data['p_element_reset']=array("signup_password","signup_password_confirm");
				$data['message']="Das Passwort muss mindestens einen Großbuchstaben enthalten.";
			}else if(!preg_match("/[a-z]/", $p_password)){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_password";
				$data['p_element_reset']=array("signup_password","signup_password_confirm");
				$data['message']="Das Psswort muss mindestens einen Kleinbuchstaben enthalten.";
			}else if(!preg_match("/[0-9]/", $p_password)){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_password";
				$data['p_element_reset']=array("signup_password","signup_password_confirm");
				$data['message']="Das Passwort muss mindestens eine Ziffer einhalten.";
			}else if(empty($p_email) OR empty($p_code) OR strlen($p_code) != 32 OR !valid_email($p_email)){
				$data['error']=TRUE;
				$data['p_element_reset']=array("signup_password","signup_password_confirm");
				$data['message']="Der Link ist ungültig.";
			}else{
				if($this->M_account_model->get_account("filter:email", $p_email)->num_rows() == 1){
					$v_account = $this->M_account_model->get_account("filter:email", $p_email)->row();
					$v_token = $this->M_account_model->get_register_token($p_email);

					if ($v_token->num_rows() == 1) {
						$v_token_row = $v_token->row();
						if($v_token_row->register_token == $p_code && $v_token_row->token_used == 0 && strtolower($v_account->group_name) == strtolower("Interested Person")){
							$this->M_account_model->update_password($v_account->member_id, $this->M_account_model->password_hash($v_account->member_email, $p_password));
							$this->M_account_model->set_group($v_account->member_id, "Member");
							$this->M_account_model->use_register_token($p_email, $p_code);

							$data['error']=FALSE;
							$data['message']="Das Passwort wurde erfolgreich gesetzt. Sie können sich jetzt einloggen.";
						}else{
							$data['error']=FALSE;
							$data['message']="Der Link ist ungültig.";
						}
					} else {
						$data['error']=FALSE;
						$data['message']="Der Link ist ungültig.";
					}
				}else{
					$data['error']=FALSE;
					$data['message']="Der Link ist ungültig.";
				}
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function logout(){
		if($this->session->userdata('login')){
			$this->lang->load("account",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$this->session->sess_destroy();
			$data['error']=FALSE;
			$data['message']= "Sie haben sich erfolgreich abgemeldet.";
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}		
	}

	public function password_change(){
		if($this->session->userdata('login')){
			$this->lang->load("account",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$current=html_escape($this->input->get_post('password_current'));
			$new=html_escape($this->input->get_post('password_new'));
			$confirm=html_escape($this->input->get_post('password_confirm'));

			if(empty($current)){
				$data['error']=TRUE;
				$data['p_element_focus']="password_current";
				$data['message']="Bitte geben dein derzeitiges Passwort ein.";
			}else if(empty($new)){
				$data['error']=TRUE;
				$data['p_element_focus']="password_new";
				$data['message']="Bitte gib dein neues Passwort ein.";
			}else if(empty($confirm)){
				$data['error']=TRUE;
				$data['p_element_focus']="password_confirm";
				$data['message']="Bitte bestätige dein neues Passwort.";
			}else if($new!=$confirm){
				$data['error']=TRUE;
				$data['p_element_focus']="password_new";
				$data['p_element_reset']=array("password_new","password_confirm");
				$data['message']="Das neue Passwort stimmt mit der Bestätigung nicht überein.";
			}else if(strlen($new) < 8){
				$data['error']=TRUE;
				$data['p_element_focus']="password_new";
				$data['p_element_reset']=array("password_new","password_confirm");
				$data['message']="Das Passwort muss mindestens 8 Zeichen enthalten.";
			}else if(!preg_match("/[A-Z]/", $new)){
				$data['error']=TRUE;
				$data['p_element_focus']="password_new";
				$data['p_element_reset']=array("password_new","password_confirm");
				$data['message']="Das Passwort muss mindestens einen Großbuchstaben enthalten.";
			}else if(!preg_match("/[a-z]/", $new)){
				$data['error']=TRUE;
				$data['p_element_focus']="password_new";
				$data['p_element_reset']=array("password_new","password_confirm");
				$data['message']="Das Psswort muss mindestens einen Kleinbuchstaben enthalten.";
			}else if(!preg_match("/[0-9]/", $new)){
				$data['error']=TRUE;
				$data['p_element_focus']="password_new";
				$data['p_element_reset']=array("password_new","password_confirm");
				$data['message']="Das Passwort muss mindestens eine Ziffer einhalten.";
			}else {
				$obj_account = $this->M_account_model->get_account("all", intval($this->session->userdata('account_id')))->row();
				if($obj_account->member_password_hash == $this->M_account_model->password_hash($obj_account->member_email, $current) ){
					$this->M_account_model->log_activity($obj_account->member_id, "password change", $this->input->ip_address(), $this->agent->browser(), (!$this->agent->is_mobile() ? $this->agent->platform() : $this->agent->mobile()));
					$this->M_account_model->update_password($this->session->userdata('account_id'), $this->M_account_model->password_hash($obj_account->member_email, $new));
					$data['error']=FALSE;
					$data['p_element_reset']=array("password_current","password_new","password_confirm");
					$data['message']="Das Passwort wurde erfolgreich geändert.";
				}else{
					$data['error']=TRUE;
					$data['p_element_focus']="password_current";
					$data['p_element_reset']=array("password_current");
					$data['message']="Das derzeitige Passwort stimmt nicht mit dem Passwort in der Datenbank überein.";
				}
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}
	/* Avatar */
	public function remove_avatar(){
		if($this->session->userdata('login')){
			if($this->M_account_model->get_detail(intval($this->session->userdata('account_id')))->num_rows() == 1){
				$resource_url = $this->config->item('resource_url');
				$object_account = $this->M_account_model->get_detail(intval($this->session->userdata('account_id')))->row();
				$this->M_account_model->remove_avatar(intval($this->session->userdata('account_id')));
				$data['error']=FALSE;
				$data['p_format']='<img src="{0}" />';
				$data['p_target']='#avatar-preview';
				$data['p_file_list']=array();
				array_push($data['p_file_list'],($object_account->gender_name=='female' ? $resource_url.'image/avatar/female.png' : $resource_url.'image/avatar/male.png'));
				$data['message']="Das Profilbild wurde erfolgreich gelöscht.";
			}else{
				$data['error']=TRUE;
				$data['message']="Das Profilbild konnte nicht gelöscht werden, da ein Fehler aufgetreten ist.";
			}
			$this->load->view("plugin/system/form_response",$data);		
		}else{
			show_404();
		}
		
	}
	public function upload_avatar(){
		$v_image_types = array('image/png','image/jpeg','image/jpg');
		if(!isset($_FILES['file'])){
			$data['error']=TRUE;
			$data['message']="Bitte wählen Sie ein Bild aus.";
		}else if(count($_FILES['file']['name'])>1){
			$data['error']=TRUE;
			$data['message']="Es darf nur ein Bild ausgewählt sein.";
		}else if(!in_array(strtolower($_FILES['file']['type'][0]), $v_image_types)){
			$data['error']=TRUE;
			$data['message']="Es können nur PNGs und JPEGs hochgeladen werden.";
		}else{
			list($v_img_width, $v_img_height, $type, $attr) = getimagesize($_FILES['file']['tmp_name'][0]);
			if($v_img_width != $v_img_height){
				$data['error']=TRUE;
				$data['message']="Das Bild muss quadratisch sein.";
			}else if ($v_img_width > 500) {
				$data['error']=TRUE;
				$data['message']="Das Bild darf nur maximal 500px breit sein.";
			}else if($v_img_height > 500){
				$data['error']=TRUE;
				$data['message']="Das Bild darf nur maximal 500px hoch sein.";
			}else{
				$type = $_FILES['file']['type'][0];
				$content = file_get_contents($_FILES['file']['tmp_name'][0]);
				$base64url = 'data:' . $type . ';base64,' . base64_encode($content);
				$this->M_account_model->upload_avatar(intval($this->session->userdata('account_id')),$base64url);
				$data['error']=FALSE;
				$data['message']="Das Profilbild wurde erfolgreich geändert.";
			}

		}
		$this->load->view("plugin/system/form_response",$data);
	}

	public function recovery(){
		$v_code = html_escape($this->input->get_post("code"));
		$v_email= html_escape($this->input->get_post("email"));
		$v_password = html_escape($this->input->get_post("password"));
		$v_password_confirm = html_escape($this->input->get_post("confirm_password"));

		if(empty($v_password)){
			$data['error']=TRUE;
			$data['p_element_focus']="recovery_password";
			$data['message']= "Bitte gib dein neues Passwort ein.";
		}else if(empty($v_password_confirm)){
			$data['error']=TRUE;
			$data['p_element_focus']="recovery_password_confirm";
			$data['message']="Bitte bestätige dein Passwort.";
		}else if($v_password!=$v_password_confirm){
			$data['error']=TRUE;
			$data['p_element_focus']="recovery_password";
			$data['p_element_reset']=array("recovery_password","recovery_onfirm_password");
			$data['message']="Die Passwörter stimmen nicht überein.";
		}else if(strlen($v_password) < 8){
			$data['error']=TRUE;
			$data['p_element_focus']="recovery_password";
			$data['p_element_reset']=array("recovery_password","recovery_confirm_password");
			$data['message']="Das Passwort muss mindestens 8 Stellen haben.";
		}else if(!preg_match("/[A-Z]/", $v_password)){
			$data['error']=TRUE;
			$data['p_element_focus']="recovery_password";
			$data['p_element_reset']=array("recovery_password","recovery_confirm_password");
			$data['message']="Das Passwort muss mindestens einen Großbuchstaben enthalten.";
		}else if(!preg_match("/[a-z]/", $v_password)){
			$data['error']=TRUE;
			$data['p_element_focus']="recovery_password";
			$data['p_element_reset']=array("recovery_password","recovery_confirm_password");
			$data['message']="Das Passwort muss mindestens einen Kleinbuchstaben enthalten.";
		}else if(!preg_match("/[0-9]/", $v_password)){
			$data['error']=TRUE;
			$data['p_element_focus']="recovery_password";
			$data['p_element_reset']=array("recovery_password","recovery_confirm_password");
			$data['message']="Das Passwort muss mindestens eine Zahl enthalten.";
		}else if($this->M_account_model->get_code("current", $v_email, $v_code)->num_rows()!=1){
			$data['error']=TRUE;
			$data['message']="Der Code ist leider ungültig, bitte versuchen Sie den Vorgang erneut.";
		}else{
			$object_account = $this->M_account_model->get_code("current", $v_email, $v_code)->row();
			$this->M_account_model->update_password($object_account->member_id, $this->M_account_model->password_hash($object_account->member_email, $v_password));
			$data['error']=FALSE;
			$data['message']="Du hast erfolgreich dein Passwort geändert.";
		}
		$this->load->view("plugin/system/form_response",$data);

	}

	public function support($type = ""){
		switch ($type) {
			case 'password_recovery':
				$this->load->helper('email');
				$email = html_escape($this->input->get_post("email"));
				if(empty($email)){
					$data['error']=TRUE;
					$data['p_element_focus'] = "recovery_password_email";
					$data['message'] = "Bitte geben Sie Ihre E-Mail-Adresse ein.";
				}else if(!valid_email($email)){
					$data['error']=TRUE;
					$data['p_element_focus'] = "recovery_password_email";
					$data['p_element_reset'] = array("recovery_password_email");
					$data['message'] = "Bitte geben Sie eine gültige E-Mail-Adresse ein.";
				}else if($this->M_account_model->get_account("filter:email",$email)->num_rows()==0){
					$data['error']=TRUE;
					$data['p_element_reset'] = array("recovery_password_email");
					$data['message'] = "Leider existiert zu dieser E-Mail-Adresse kein Konto.";
				}else{
					$object_account = $this->M_account_model->get_account("filter:email",$email)->row();
					if($this->M_account_model->is_locked($object_account->member_id)->num_rows()==1){
						$data['error']=TRUE;
						$data['p_element_reset'] = array("recovery_password_email");
						$data['message'] = "Ihr Konto ist zurzeit gesperrt deswegen können Sie Ihr Passwort nicht zurücksetzen.";
					}else if($this->M_account_model->get_code("last 24 hours",$object_account->member_id)->num_rows()==5){
						$data['error']=TRUE;
						$data['p_element_reset'] = array("recovery_password_email");
						$data['message'] = "Sie können Ihr Passwort nur 5 Mal innerhalb von 24 Stunden wiederherstellen.";
					}else{
						$this->load->helper("string");

						$v_base_url = $this->config->item("base_url");
						$v_code = random_string("alnum", 32);

						$this->M_account_model->create_recovery_code($object_account->member_id, $v_code);
						$template["cdn_url"] = $this->config->item("cdn_url");
						$template["base_url"] = $v_base_url;
						$template["object_code"] = $v_code;
						$template["object_account"] = $object_account;
						
						$this->load->library("email");
						$this->email->from('support@primus-romulus.net', "Primus Romulus Support");
						$this->email->to($object_account->member_email); 
						$this->email->subject("Passwort zurücksetzen");
						$this->email->message($this->load->view("template/email/recovery", $template, true));
						$this->email->set_alt_message("Hallo {$object_account->member_firstname}!\r\n\r\nDamit du dein Passwort zurücksetzen kannst, öffne den folgenden Link in deinem Browser:\r\n\r\n{$v_base_url}support/recovery/?code={v_code}&email={$object_account->member_email}\r\n\r\nSolltest du dich nach der Eingabe deines neuen Passwortes noch immer nicht anmelden können, wende dich bitte per E-Mail an support@primus-romulus.net .\r\n\r\nMit freundlichen Grüßen\r\n\r\n\r\nPrimus Romulus");
						$this->email->send();
						
						$data['error']=FALSE;
						$data['message']="Bitte rufen Sie Ihr E-Mails ab und befolgen Sie die Schritte in der E-Mail.";
					}					
				}
			break;
			case 'other_problem':
				$this->load->helper('email');
				$email = html_escape($this->input->get_post("email"));
				$description = html_escape($this->input->get_post("description"));
				if(empty($email)){
					$data['error']=TRUE;
					$data['p_element_focus'] = "problem_other_email";
					$data['message'] = "Bitte geben Sie Ihre E-Mail-Adresse ein.";
				}else if(!valid_email($email)){
					$data['error']=TRUE;
					$data['p_element_focus'] = "problem_other_email";
					$data['p_element_reset'] = array("recovery_password_email");
					$data['message'] = "Bitte geben Sie eine gültige E-Mail-Adresse ein, damit wir mit Ihnen in Kontakt treten können.";
				}else if(empty($description)){
					$data['error']=TRUE;
					$data['p_element_focus'] = "problem_other_description";
					$data['message'] = "Bitte beschreiben Sie Ihr Problem näher.";
				}else{
					$this->load->library('email');
					$this->email->from($email);
					$this->email->to('support@primus-romulus.net'); 
					$this->email->subject('Problem von '.$email);
					$this->email->message($description."<br /><br /><br />IP-Adresse: {$this->input->ip_address()}<br />Browser: {$this->agent->browser()}<br />Betriebssystem: ".($this->agent->is_mobile() ? $this->agent->mobile() : $this->agent->platform() )."");
					$this->email->set_alt_message($description."\r\n\r\n\r\nIP-Adresse: {$this->input->ip_address()}\r\nBrowser: {$this->agent->browser()}\r\nBetriebssystem: ".($this->agent->is_mobile() ? $this->agent->mobile() : $this->agent->platform() )."");
					$this->email->send();

					$data['error']=FALSE;
					$data['message']="Danke, dass Sie sich die Mühe gemacht haben, Ihr Problem näher zu beschreiben. Wir melden uns in den nächsten Tagen bei Ihnen.";
				}
			break;
			default: 
				$data['error']=TRUE;
				$data['message']="";
			break;
		}
		$this->load->view("plugin/system/form_response",$data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */