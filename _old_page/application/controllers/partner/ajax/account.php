<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('partner/P_account_model'); 
		if(!$this->input->is_ajax_request()){
			show_404();
		}
	}

	public function index(){
		show_404();
	}

	public function signin(){
		if(!$this->session->userdata('login')){
			$this->load->helper('email');

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
				if($this->P_account_model->get_account("filter:email", $username)->num_rows()==1){
					$v_account = $this->P_account_model->get_account("filter:email", $username)->row();
					if($this->P_account_model->is_locked($v_account->company_id)->num_rows() == 1){
						$data['error']=TRUE;
						$data['p_element_reset']=array("signin_password");
						$data['message'] = "Ihr Konto ist zurzeit gesperrt.".($this->P_account_model->is_locked($v_account->company_id)->row()->blocking_reason != "" ? "\n\n".$this->P_account_model->is_locked($v_account->member_id)->row()->blocking_reason."" : "")."\n\nBei Fragen wenden sie sich bitte an support@primus-romulus.net.";
					}else if($v_account->company_password_hash == $this->P_account_model->password_hash($username,$password)){
						if($this->input->get_post('email_save') == 1){
							$this->input->set_cookie("partner_id", $v_account->company_id, 31104000);
						}else{
							$this->load->helper("cookie");
							delete_cookie("partner_id");
						}
						$this->P_account_model->delete_failed_login($v_account->company_id);
						$this->P_account_model->log_activity($v_account->company_id, "SIGN_IN_SUCCESS", $this->input->ip_address(), $this->agent->browser(), (!$this->agent->is_mobile() ? $this->agent->platform() : $this->agent->mobile()));
						$this->P_account_model->log_last_signin($v_account->company_id, $this->input->ip_address());
						$session_data = array(
							'login'=> TRUE,
							'account_id' => $v_account->company_id,
							'account_last_ip' => $v_account->company_last_ip,
							'account_last_login' => $v_account->company_last_login
						);
						$this->session->set_userdata($session_data);
						$data['error']=FALSE;
						$data['message']="Sie haben sich erfolgreich angemeldet.";
					}else{
						$this->P_account_model->log_failed_login($v_account->company_id, $this->input->ip_address());
						$v_count_failed_login = $this->P_account_model->get_failed_login($v_account->company_id)->num_rows();
						switch ($v_count_failed_login) {
							case 3:
							case 4:
							case 5:
								$v_try = 6 - $v_count_failed_login;
								$data['message'] = "Das eingegeben Passwort ist falsch.\n\nSie haben noch ".( $v_try > 1 ? $v_try.' Versuche' : 'einen Versuch')." bis Ihr Konto für eine Stunde gesperrt wird.\n\nSollte Sie das Passwort nicht mehr wissen, dann setzen Sie es bitte zurück bevor Ihr Konto gesperrt wird.";
							break;
							case 6:
								$this->P_account_model->lock_account($v_account->company_id, 3600, "Sie haben zu oft ein falsches Passwort eingegeben! Bitte versuchen Sie es später noch einmal.");
								$data['message'] = "Ihr Konto wurde für eine Stunde gesperrt, da Sie Ihr Passwort 6 Mal infolge falsch eingegeben haben.";
							break;
							case 7:
							case 8:
								$v_try = 9 - $v_count_failed_login;
								$data['message'] = "Das eingegeben Passwort ist falsch.\n\nSie haben noch ".( $v_try > 1 ? $v_try.' Versuche' : 'einen Versuch')." bis Ihr Konto für 24 Stunde gesperrt wird.\n\nSollte Sie das Passwort nicht mehr wissen, dann setzen Sie es bitte zurück bevor Ihr Konto gesperrt wird.";
							break;
							case 9:
								$this->P_account_model->lock_account($v_account->member_id, 86400, "Sie haben zu oft ein falsches Passwort eingegeben! Bitte versuchen Sie es später noch einmal.");
								$data['message'] = "Ihr Konto wurde für 24 Stunden gesperrt, da Sie Ihr Passwort 9 Mal infolge falsch eingegeben haben.";
							break;
							case 10:
							case 11:
								$v_try = 12 - $v_count_failed_login;
								$data['message'] = "Das eingegeben Passwort ist falsch.\n\nSie haben noch ".( $v_try > 1 ? $v_try.' Versuche' : 'einen Versuch')." bis Ihr Konto für immer gesperrt wird.\n\nSollte Sie das Passwort nicht mehr wissen, dann setzen Sie es bitte zurück bevor Ihr Konto gesperrt wird.";
							break;
							case 12:
								$this->P_account_model->lock_account($v_account->member_id, -1, "Ihr Konto wurde gesperrt, da Ihr Passwort zu oft falsch eingegeben wurde. Bitte wenden Sie sich an die unten angegebene E-Mail-Adresse.");
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
			$this->load->view("partner/plugin/system/form_response",$data);
		}else{
			show_404();
		}		
	}

	public function signup_password(){
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
			}else if(empty($p_email) OR empty($p_code) OR strlen($p_code) != 16 OR !valid_email($p_email)){
				$data['error']=TRUE;
				$data['p_element_reset']=array("signup_password","signup_password_confirm");
				$data['message']="Der Link ist ungültig.";
			}else{
				if($this->P_account_model->get_account("filter:email", $p_email)->num_rows() == 1){
					$v_account = $this->P_account_model->get_account("filter:email", $p_email)->row();
					if($v_account->member_password_hash == $p_code && strtolower($v_account->group_name) == strtolower("Interested Person")){
						$this->P_account_model->update_password($v_account->member_id, $this->P_account_model->password_hash($v_account->member_email, $p_password));
						$this->P_account_model->set_group($v_account->member_id, "Member");
						$data['error']=FALSE;
						$data['message']="Das Passwort wurde erfolgreich gesetzt. Sie können sich jetzt einloggen.";
					}else{
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
			$this->session->sess_destroy();
			$data['error']=FALSE;
			$data['message']= "Sie haben sich erfolgreich abgemeldet.";
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}		
	}

	public function update_account(){
		if($this->session->userdata("login")){
			$this->load->model('General_Model');
			$this->load->model('Location_Model');
			$this->load->model('Contact_Model');
			$p_location = $this->input->get_post("location");
			$p_contact = $this->input->get_post("contact");
			$p_description = $this->input->get_post("description");
			$p_branche = $this->input->get_post("branche");
			$p_property_name = $this->input->get_post("property_name");
			$p_property_text = $this->input->get_post("property_text");
			$p_website_type = $this->input->get_post("website_type");
			$p_website_name = $this->input->get_post("website_name");
			$p_website_url = $this->input->get_post("website_url");
			if($this->Location_Model->get_location(intval($this->session->userdata("account_id")), "all", $p_location)->num_rows() != 1 || $p_location == NULL){
				$data['error']=TRUE;
				$data['message']="Bitte wählen Sie Ihr Headquarter aus.";
			}else if($this->Contact_Model->get_contact(intval($this->session->userdata("account_id")), "all", $p_contact)->num_rows() != 1 || $p_contact == NULL){
				$data['error']=TRUE;
				$data['message']="Bitte wählen Sie Ihre Hauptkontaktperson aus.";
			}else if(empty($p_description)){
				$data['error']=TRUE;
				$data['p_element_focus']="partner_description";
				$data['message']="Bite geben Sie eine Beschreibung ein.";
			}else{
				$this->P_account_model->update_account(intval($this->session->userdata("account_id")), $p_location, $p_contact, $p_description);
				if($p_branche != NULL){
					$this->P_account_model->remove_branche(intval($this->session->userdata("account_id")));
					$p_branche = array_unique($p_branche);
					for ($i=0; $i < count($p_branche); $i++) {
						if($this->General_Model->get_branche($p_branche[$i])->num_rows() == 1 ){
							$this->P_account_model->add_branche(intval($this->session->userdata("account_id")), $p_branche[$i]);
						}						
					}
				}
				if($p_property_name != NULL && $p_property_text != NULL){
					if(count($p_property_name) == count($p_property_text)){
						$this->P_account_model->remove_properties(intval($this->session->userdata("account_id")));
						for ($i=0; $i < count($p_property_name) ; $i++) {
							if($p_property_name[$i] != "" && $p_property_text[$i] != ""){
								$this->P_account_model->add_property(intval($this->session->userdata("account_id")), $p_property_name[$i], $p_property_text[$i]);
							}
						}
					}
				}
				if($p_website_type != NULL && $p_website_name != NULL && $p_website_url != NULL){
					if(count($p_website_type) == count($p_website_name) && count($p_website_name) == count($p_website_url)){
						$this->P_account_model->remove_websites(intval($this->session->userdata("account_id")));
						for ($i=0; $i < count($p_website_name) ; $i++) {
							if($this->General_Model->get_website_type($p_website_type[$i])->num_rows() == 1 && $p_website_name[$i] != "" && $p_website_url[$i] != ""){
								$this->P_account_model->add_website(intval($this->session->userdata("account_id")), $p_website_name[$i], $p_website_type[$i], $p_website_url[$i]);
							}
						}
					}
				}
				$data['error']=FALSE;
				$data['message']="Das Profil wurde erfolgreich bearbeitet.";
			}
			$this->load->view("plugin/system/form_response", $data);
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
				$object_account = $this->P_account_model->get_account("all", intval($this->session->userdata('account_id')))->row();
				if($object_account->company_password_hash == $this->P_account_model->password_hash($object_account->company_email, $current) ){
					$this->P_account_model->log_activity($object_account->company_id, "PASSWORD_CHANGE", $this->input->ip_address(), $this->agent->browser(), (!$this->agent->is_mobile() ? $this->agent->platform() : $this->agent->mobile()));
					$this->P_account_model->update_password($this->session->userdata('account_id'), $this->P_account_model->password_hash($object_account->company_email, $new));
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
			if($this->P_account_model->get_detail(intval($this->session->userdata('account_id')))->num_rows() == 1){
				$resource_url = $this->config->item('resource_url');
				$object_account = $this->P_account_model->get_detail(intval($this->session->userdata('account_id')))->row();
				$this->P_account_model->remove_avatar(intval($this->session->userdata('account_id')));
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
	public function upload_logo(){
		$v_image_types = array('image/png','image/jpeg','image/jpg');
		if(!isset($_FILES['file'])){
			$data['error']=TRUE;
			$data['message']="Bitte wählen Sie eine Datei aus.";
		}else if(count($_FILES['file']['name'])>1){
			$data['error']=TRUE;
			$data['message']="Es darf nur eine Datei ausgewählt werden.";
		}else if(!in_array(strtolower($_FILES['file']['type'][0]), $v_image_types)){
			$data['error']=TRUE;
			$data['message']="Es können nur Bilder im Format .png, .jpg und .jpeg hochgeladen werden.";
		}else{
			list($v_img_width, $v_img_height, $v_type, $v_attr) = getimagesize($_FILES['file']['tmp_name'][0]);
			if ($v_img_width > 500) {
				$data['error']=TRUE;
				$data['message']="Das Bild darf nur maximal 500px breit sein.";
			}else if($v_img_height > 500){
				$data['error']=TRUE;
				$data['message']="Das Bild darf nur maximal 500px hoch sein.";
			}else{
				$this->P_account_model->delete_logo(intval($this->session->userdata("account_id")));
				move_uploaded_file($_FILES["file"]["tmp_name"][0], FCPATH."../resource/image/partner/logo/".intval($this->session->userdata("account_id")).".".strtolower(end(explode('.',$_FILES["file"]["name"][0]))));
				$data['error']=FALSE;
				$data['message']="Das Logo wurde erfolgreich hochgeladen.";
			}
		}
		$this->load->view("plugin/system/form_response",$data);
	}

	public function upload_banner(){
		$v_image_types = array('image/png','image/jpeg','image/jpg');
		if(!isset($_FILES['file'])){
			$data['error']=TRUE;
			$data['message']="Bitte wählen Sie eine Datei aus.";
		}else if(count($_FILES['file']['name'])>1){
			$data['error']=TRUE;
			$data['message']="Es darf nur eine Datei ausgewählt werden.";
		}else if(!in_array(strtolower($_FILES['file']['type'][0]), $v_image_types)){
			$data['error']=TRUE;
			$data['message']="Es können nur Bilder im Format .png, .jpg und .jpeg hochgeladen werden.";
		}else{
			list($v_img_width, $v_img_height, $v_type, $v_attr) = getimagesize($_FILES['file']['tmp_name'][0]);
			if ($v_img_width > 3000) {
				$data['error']=TRUE;
				$data['message']="Das Bild darf nur maximal 3000px breit sein.";
			}else if($v_img_height > 1000){
				$data['error']=TRUE;
				$data['message']="Das Bild darf nur maximal 1000px hoch sein.";
			}else{
				$this->P_account_model->delete_banner(intval($this->session->userdata("account_id")));
				move_uploaded_file($_FILES["file"]["tmp_name"][0], FCPATH."../resource/image/partner/banner/".intval($this->session->userdata("account_id")).".".strtolower(end(explode('.',$_FILES["file"]["name"][0]))));
				$data['error']=FALSE;
				$data['message']="Der Banner wurde erfolgreich hochgeladen.";
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
		}else if($this->P_account_model->get_code("filter:current:email", $v_email)->num_rows()==0){
			$data['error']=TRUE;
			$data['message']="Der Code ist leider ungültig, bitte versuchen Sie den Vorgang erneut.";
		}else{
			$object_account = $this->P_account_model->get_account("filter:email", $v_email)->row();
			$this->P_account_model->update_password($object_account->company_id, $this->P_account_model->password_hash($object_account->company_email, $v_password));
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
				}else if($this->P_account_model->get_account("filter:email",$email)->num_rows()==0){
					$data['error']=TRUE;
					$data['p_element_reset'] = array("recovery_password_email");
					$data['message'] = "Leider existiert zu dieser E-Mail-Adresse kein Konto.";
				}else{
					$object_account = $this->P_account_model->get_account("filter:email",$email)->row();
					if($this->P_account_model->is_locked($object_account->member_id)->num_rows()==1){
						$data['error']=TRUE;
						$data['p_element_reset'] = array("recovery_password_email");
						$data['message'] = "Ihr Konto ist zurzeit gesperrt deswegen können Sie Ihr Passwort nicht zurücksetzen.";
					}else if($this->P_account_model->get_code("last 24 hours",$object_account->member_id)->num_rows()==5){
						$data['error']=TRUE;
						$data['p_element_reset'] = array("recovery_password_email");
						$data['message'] = "Sie können Ihr Passwort nur 5 Mal innerhalb von 24 Stunden wiederherstellen.";
					}else{
						$this->load->helper("string");

						$v_base_url = $this->config->item("base_url");
						$v_code = random_string("alnum", 32);

						$this->P_account_model->create_recovery_code($object_account->member_id, $v_code);
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

	/***************/
	/* Contact (s) */
	/***************/

	public function add_contact(){
		if($this->session->userdata('login')){

		}else{
			show_404();
		}
	}

	/***************/
	/* Contact (e) */
	/***************/
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */