<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Account_Model');
	}

	public function index()
	{
		show_404();
	}

	public function signup(){
		if(!$this->session->userdata('login')){

			$this->load->helper("email");

			//Account
			$name=$this->input->get_post("name");
			$email=$this->input->get_post("email");
			$password=$this->input->get_post("password");
			$password_confirm=$this->input->get_post("password_confirm");

			//Bill
			$package=$this->input->get_post("package");
			$address=$this->input->get_post("address");
			$pc=$this->input->get_post("pc");
			$city=$this->input->get_post("city");

			if(empty($name)){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_name";
				$data['message']='Bitte geben Sie den Firmennamen ein.';
			}else if(empty($email)){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_email";
				$data['message']='Bitte geben Sie eine E-Mail-Adresse ein.';
			}else if(!valid_email($email)){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_email";
				$data['p_element_reset']=array("signup_email");
				$data['message']='Bitte geben Sie eine gültige E-Mail-Adresse ein.';
			}else if(empty($password)){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_password";
				$data['message']='Bitte geben Sie ein Passwort ein.';
			}else if(strlen($password) < 8){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_password";
				$data['p_element_reset']=array("signup_password");
				$data['message']="Ihr Passwort muss mindestens 8 Zeichen lang sein.";
			}else if(!preg_match("/[A-Z]/", $password)){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_password";
				$data['p_element_reset']=array("signup_password");
				$data['message']="Ihr Passwort muss Großbuchstaben enthalten.";
			}else if(!preg_match("/[a-z]/", $password)){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_password";
				$data['p_element_reset']=array("signup_password");
				$data['message']="Ihr Passwort muss Kleinbuchstaben enthalten.";
			}else if(!preg_match("/[0-9]/", $password)){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_password";
				$data['p_element_reset']=array("signup_password");
				$data['message']="Ihr Passwort muss Zahlen enthalten.";
			}else if($password!=$password_confirm){
				$data['error']=TRUE;
				$data['p_element_focus']="signup_password";
				$data['p_element_reset']=array("signup_password","signup_password_confirm");
				$data['message']="Ihr Passwort stimmt nicht mit der Bestätigung überein. Bitte versuchen Sie es nochmal.";
			}else if($package==0){
				$data['error']=TRUE;
				$data['message']='Bitte wählen Sie ein Paket aus.';
			}else if(empty($address)){
				$data['error']=TRUE;
				$data['p_element_focus']="bill_address";
				$data['message']='Bitte geben Sie die Straße ein.';
			}else if(empty($pc)){
				$data['error']=TRUE;
				$data['p_element_focus']="bill_pc";
				$data['message']='Bitte geben Sie die Postleitzahl ein.';
			}else if(empty($city)){
				$data['error']=TRUE;
				$data['p_element_focus']="bill_city";
				$data['message']='Bitte geben Sie den Ort ein.';
			}else{

				if($this->Account_Model->get_detail($email)->num_rows()==0){
					//CREATE ACCOUNT
					$this->load->helper("security");
					$password_hash = do_hash("$email:$password","md5");
					$this->Account_Model->create_account($name,$email,$password_hash,($package+1));
					$object_account = $this->Account_Model->get_detail($email)->row();

					// CREATE BILL
					$this->load->model('Bill_Model');
					$this->load->model('Package_Model');
					
					$list = array();
					$object_package = $this->Bill_Model->get_item($this->Package_Model->get_package(intval($package))->row()->package_name." Package")->row();
					$object_shipping = $this->Bill_Model->get_item("By E-Mail")->row();
					array_push($list, array($object_package->item_name,$object_package->item_price));
					array_push($list, array($object_shipping->item_name,$object_shipping->item_price));
					
					$this->Bill_Model->create_bill(date("Y"),$object_account->company_id, $list, $address, $pc, $city);
					
					$this->load->helper("dompdf");
					$this->lang->load("bill",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
					$v_last_id = $this->Bill_Model->get_last_bill_id($object_account->company_id,date("Y"))->row()->last_id;
					$template_bill['resource_url'] = $this->config->item('resource_url');
					$template_bill['company_name']=$object_account->company_name;

					$template_bill['bill'] = $this->Bill_Model->get_bill($object_account->company_id,intval(date('Y')),$v_last_id)->row();
					$template_bill['array_bill_item'] = $this->Bill_Model->get_item_list($object_account->company_id,intval(date('Y')),$v_last_id)->result();

					$content = $this->load->view('template/bill/default',$template_bill,true);
					file_put_contents(dirname(BASEPATH).'/resource/temp/Bill_'.$template_bill['bill']->bill_year.''.$template_bill['bill']->bill_id.'.pdf', pdf_create('Bill_'.$template_bill['bill']->bill_year.''.$template_bill['bill']->bill_id,$content,FALSE));
			     	//SEND E-Mail
			     	$this->load->library("email");
			     	$this->email->from('hello@primus-romulus.net', 'Primus Romulus');
			     	$this->email->reply_to('office@primus-romulus.net','Primus Romulus');
					$this->email->to($object_account->company_email); 
					$this->email->subject('[Primus Romulus] Herzlich Willkommen');
					$object_template['email']=$email;
			     	$object_template['password']=$password;
			     	$message = $this->load->view("template/email/signup",$object_template,true);
					$this->email->message($message);
					$this->email->set_alt_message("Sehr geehrte Damen und Herren,\r\n\r\ndanke, dass Sie sich für Primus Romulus entschieden haben. Nutzen Sie unser Angebot aus und repräsentieren Sie Ihr Unternehmen so gut wie möglich, damit viel Aufmerksamkeit auf Sie gezogen wird. Im folgenden Abschnitt finden Sie Ihre Zugangsdaten.\r\n\r\nE-Mail-Adresse:\t\t".$object_template['email']."\r\n\r\nPasswort:\t\t".$object_template['password']."\r\n\r\nDie Rechnung für die Mitgliedschaft befindet sich im Anhang und kann natürlich auch online gedownloadet werden.\r\n\r\nZum Schluss kann man nur mehr sagen, dass wir uns freuen, dass Sie ein Teil unserer Community geworden sind. Wir hoffen für Sie die richtigen Arbeiternehmer in unserem Netzwerk zu finden.\r\n\r\nMit freundlichen Grüßen\r\n\r\n\r\nPrimus Romulus");
					$this->email->attach(dirname(BASEPATH).'/resource/temp/Bill_'.$template_bill['bill']->bill_year.''.$template_bill['bill']->bill_id.'.pdf','inline');
					$this->email->send();
					unlink(dirname(BASEPATH).'/resource/temp/Bill_'.$template_bill['bill']->bill_year.''.$template_bill['bill']->bill_id.'.pdf');
					$data['error']=FALSE;
					$data['message']="Sie haben erfolgreich ein Konto erstellt. Die Zugangsdaten und die Rechnung wurde an $email versendet.";
				}else{
					$data['error']=TRUE;
					$data['message']="Sie sind bereits in unserem System vorhanden.";
				}
				
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}
	public function signin(){
		if(!$this->session->userdata('login')){
			$this->load->helper('email');
			$this->load->helper('security');
			$this->lang->load("account",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			
			$username=$this->input->get_post('username');
			$password=$this->input->get_post('password');
			$data['message']="";

			if(empty($username)){
				$data['error']=TRUE;
				$data['p_element_focus']="login_username";
				$data['message']=$this->lang->line('login_username_empty');
			}else if(!valid_email($username)){
				$data['error']=TRUE;
				$data['p_element_reset']=array("login_username");
				$data['p_element_focus']="login_username";
				$data['message']=$this->lang->line('login_username_valid');
			}else{
				if($this->Account_Model->get_detail($username)->num_rows()==1){
					$obj_account = $this->Account_Model->get_detail($username)->row();
					if($obj_account->company_password_hash==do_hash("$username:$password",'md5')){
						//$this->Account_Model->log($obj_account->account_id,1,$this->agent->browser().";".($this->agent->is_mobile()? $this->agent->mobile():$this->agent->platform()),$this->input->ip_address());
						$this->input->set_cookie('account_id', $obj_account->company_id, 31449600);
						$this->input->set_cookie('account_email', $obj_account->company_email, 31449600);
						$session_data = array(
							'login'=> TRUE,
							'account_id' => $obj_account->company_id,
							'account_last_ip' => $obj_account->company_last_ip,
							'account_last_login' => $obj_account->company_last_login
						);

						$this->session->set_userdata($session_data);
						$this->Account_Model->log_last_login($obj_account->company_id,$this->input->ip_address());
						$data['error']=FALSE;
						$data['message']=$this->lang->line('login_success');
					}else{
						$data['error']=TRUE;
						if($this->input->cookie('account_id') == null){
							$data['p_element_reset']=array("login_username","login_password");
						}else{
							$data['p_element_reset']=array("login_password");
						}
						
						$data['message']=$this->lang->line('login_no_data_match');
					}
				}else{
					$data['error']=TRUE;
					if($this->input->cookie('account_id') == null){
						$data['p_element_reset']=array("login_username","login_password");
					}else{
						$data['p_element_reset']=array("login_password");
					}
					$data['message']=$this->lang->line('login_no_data_found');
				}
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}		
	}

	public function signout(){
		if($this->session->userdata('login')){
			$this->lang->load("account",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$this->session->sess_destroy();
			$data['error']=FALSE;
			$data['message']=$this->lang->line('logout_success');
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}		
	}

	public function password_change(){
		if($this->session->userdata('login')){
			$this->lang->load("account",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$current=$this->input->get_post('password_current');
			$new=$this->input->get_post('password_new');
			$confirm=$this->input->get_post('password_confirm');

			if(empty($current)){
				$data['error']=TRUE;
				$data['p_element_focus']="password_current";
				$data['message']=$this->lang->line('password_current_empty');
			}else if(empty($new)){
				$data['error']=TRUE;
				$data['p_element_focus']="password_new";
				$data['message']=$this->lang->line('password_new_empty');
			}else if(empty($confirm)){
				$data['error']=TRUE;
				$data['p_element_focus']="password_confirm";
				$data['message']=$this->lang->line('password_confirm_empty');
			}else if($new!=$confirm){
				$data['error']=TRUE;
				$data['p_element_focus']="password_new";
				$data['p_element_reset']=array("password_new","password_confirm");
				$data['message']=$this->lang->line('password_confirm_do_not_match');
			}else if(strlen($new) < 8){
				$data['error']=TRUE;
				$data['p_element_focus']="password_new";
				$data['p_element_reset']=array("password_new","password_confirm");
				$data['message']=$this->lang->line('password_length');
			}else if(!preg_match("/[A-Z]/", $new)){
				$data['error']=TRUE;
				$data['p_element_focus']="password_new";
				$data['p_element_reset']=array("password_new","password_confirm");
				$data['message']=$this->lang->line('password_no_uppercase');
			}else if(!preg_match("/[a-z]/", $new)){
				$data['error']=TRUE;
				$data['p_element_focus']="password_new";
				$data['p_element_reset']=array("password_new","password_confirm");
				$data['message']=$this->lang->line('password_no_lowercase');
			}else if(!preg_match("/[0-9]/", $new)){
				$data['error']=TRUE;
				$data['p_element_focus']="password_new";
				$data['p_element_reset']=array("password_new","password_confirm");
				$data['message']=$this->lang->line('password_no_numbers');
			}else {
				$this->load->helper('security');
				$obj_account = $this->Account_Model->get_detail(intval($this->session->userdata('account_id')))->row();
				if($obj_account->company_password_hash == do_hash($obj_account->company_email.':'.$current,'md5') ){
					$this->Account_Model->update_password($this->session->userdata('account_id'),do_hash($obj_account->company_email.":$new",'md5'));
					$data['error']=FALSE;
					$data['p_element_reset']=array("password_current","password_new","password_confirm");
					$data['message']=$this->lang->line('password_success');
				}else{
					$data['error']=TRUE;
					$data['p_element_focus']="password_current";
					$data['p_element_reset']=array("password_current");
					$data['message']=$this->lang->line('password_error');
				}				
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}
	public function recovery(){
		if(!$this->session->userdata('login')){
			$this->load->helper("email");
			$name = $this->input->get_post('name');
			$email = $this->input->get_post('email');
			$object_account = $this->Account_Model->get_detail($email)->row();
			if(empty($name)){
				$data['error']=TRUE;
				$data['p_element_focus']="recovery_name";
				$data['message']="Bitte geben Sie den Firmennamen ein.";
			}else if(empty($email)){
				$data['error']=TRUE;
				$data['p_element_focus']="recovery_email";
				$data['message']="Bitte geben Sie die E-Mail-Adresse ein.";
			}else if(!valid_email($email)){
				$data['error']=TRUE;
				$data['p_element_focus']="recovery_email";
				$data['p_element_reset']=array("recovery_email");
				$data['message']="Bitte geben Sie eine gültige E-Mail-Adresse ein.";
			}else if($this->Account_Model->get_detail($email)->num_rows() == 0){
				$data['error']=TRUE;
				$data['p_element_focus']="recovery_email";
				$data['p_element_reset']=array("recovery_email");
				$data['message']="Die E-Mail-Adresse existiert in unserem System nicht.";
			}else if(strtolower($object_account->company_name) != strtolower($name)){
				$data['error']=TRUE;
				$data['p_element_reset']=array("recovery_name","recovery_email");
				$data['message']="Der Firmenname und die E-Mail-Adresse stimmen nicht überein.";
			}else{
				$this->load->library('email');
				$this->load->helper("string");
				$this->load->helper("security");

				$object_template['email'] = $object_account->company_email;
				$object_template['password'] = random_string('alnum', 10);;
				$this->Account_Model->update_password($object_account->company_id,do_hash($object_account->company_email.":".$object_template['password'],'md5'));
				
				$message = $this->load->view("template/email/recovery",$object_template,true);
				$this->email->from('support@primus-romulus.net', 'Primus Romulus Support');
				$this->email->to($object_account->company_email); 
				$this->email->subject('[Primus Romulus] Neue Zugangsdaten');
				$this->email->message($message);
				$this->email->set_alt_message("Sehr geehrte Damen und Herren,\r\n\r\nim folgenden Abschnitt finden Sie Ihre neuen Zugangsdaten. Bitte ändern Sie Ihr Passwort nachdem Sie sich eingeloggt haben.\r\n\r\nE-Mail-Adresse:\t\t".$object_account->company_email."\r\nPasswort:\t\t".$object_template['password']."\r\n\r\nSollten Sie sich weiterhin nicht anmelden können, wenden Sie sich bitte per E-Mail an support@primus-romulus.net.\r\n\r\nMit freundlichen Grüßen\r\n\r\n\r\nPrimus Romulus");
				$this->email->send();


				$data['error']=FALSE;
				$data['message']=sprintf("Die Anmeldedaten wurden an %s versendet.",$object_account->company_email);
			}
			$this->load->view("plugin/system/form_response",$data);		
		}else{
			show_404();
		}		
	}
	/* Logo */
	public function remove_logo(){
		if($this->session->userdata('login')){
			if($this->Account_Model->get_detail(intval($this->session->userdata('account_id')))->num_rows() == 1){
				$resource_url = $this->config->item('resource_url');
				$object_account = $this->Account_Model->get_detail(intval($this->session->userdata('account_id')))->row();
				$this->Account_Model->remove_logo(intval($this->session->userdata('account_id')));
				$data['error']=FALSE;
				$data['p_format']='<img src="{0}" />';
				$data['p_target']='#avatar-preview';
				$data['p_file_list']=array();
				array_push($data['p_file_list'],$resource_url.'image/company/logo/default.png');
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
		$v_image_types = array('image/gif','image/png','image/jpeg','image/jpg');
		
		if(!isset($_FILES['file'])){
			$data['error']=TRUE;
			$data['message']="Bitte eine Datei auswählen";
		}else if(count($_FILES['file']['name'])>1){
			$data['error']=TRUE;
			$data['message']="Nur eine Datei auswählen";
		}else if(!in_array(strtolower($_FILES['file']['type'][0]), $v_image_types)){
			$data['error']=TRUE;
			$data['message']="Es können nur PNGs, GIFs und JPEGs hochgeladen werden.";
		}else if($_FILES['file']['size'][0] > 1000000){
			$data['error']=TRUE;
			$data['message']="Bild muss kleiner sein";
		}else{
			$type = $_FILES['file']['type'][0];
			$content = file_get_contents($_FILES['file']['tmp_name'][0]);
			$base64url = 'data:' . $type . ';base64,' . base64_encode($content);
			$this->Account_Model->upload_logo(intval($this->session->userdata('account_id')),$base64url);
			$data['error']=FALSE;
			$data['message']="Das Profilbild wurde erfolgreich geändert.";
			$data['p_format']='<img src="{0}" />';
			$data['p_target']='#plugin-logo-preview';
			$data['p_file_list']=array();
			for($i = 0; $i < count($_FILES['file']['name']); $i++){
				array_push($data['p_file_list'],'data:'.$_FILES['file']['type'][$i].';base64,' . base64_encode(file_get_contents($_FILES['file']['tmp_name'][$i])));
			}
			
		}
		$this->load->view("plugin/system/form_response",$data);
	}
	public function add_contact(){
		if($this->session->userdata('login')){
			$this->load->helper("email");

			$salutation=$this->input->get_post('salutation');
			$title=$this->input->get_post('title');
			$firstname=$this->input->get_post('firstname');
			$lastname=$this->input->get_post('lastname');
			$position=$this->input->get_post('position');
			$email=$this->input->get_post('email');
			$phone=$this->input->get_post('phone');

			if($salutation == 0){
				$data['error']=TRUE;
				$data['message']="Bitte wählen Sie die Anrede aus.";
			}else if(empty($firstname)){
				$data['error']=TRUE;
				$data['p_element_focus']="contact_firstname";
				$data['message']="Bitte geben Sie den Vornamen ein.";
			}else if(empty($lastname)){
				$data['error']=TRUE;
				$data['p_element_focus']="contact_lastname";
				$data['message']="Bitte geben Sie den Nachnamen ein.";
			}else if(empty($email)){
				$data['error']=TRUE;
				$data['p_element_focus']="contact_email";
				$data['message']="Bitte geben Sie die E-Mail-Adresse ein.";
			}else if(!valid_email($email)){
				$data['error']=TRUE;
				$data['p_element_focus']="contact_email";
				$data['p_element_reset']=array("contact_email");
				$data['message']="Bitte geben Sie eine gültige E-Mail-Adresse ein.";
			}else{
				if(isset($_FILES['file']['type'][0])){
					$type = $_FILES['file']['type'][0];
					$content = file_get_contents($_FILES['file']['tmp_name'][0]);
					$portrait = 'data:'.$type.';base64,' . base64_encode($content);
				}else{
					$portrait = "";
				}
				$this->Account_Model->add_contact($this->session->userdata('account_id'), $portrait, $salutation, $title, $firstname, $lastname, $position, $email, $phone);
				$data['error']=FALSE;
				$data['message']="Der Kontakt wurde erfolgreich hinzugefügt.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function update_contact(){
		if($this->session->userdata('login')){
			$this->load->helper("email");

			$contact_id=$this->input->get_post('id');
			$salutation=$this->input->get_post('salutation');
			$title=$this->input->get_post('title');
			$firstname=$this->input->get_post('firstname');
			$lastname=$this->input->get_post('lastname');
			$position=$this->input->get_post('position');
			$email=$this->input->get_post('email');
			$phone=$this->input->get_post('phone');

			if($salutation == 0){
				$data['error']=TRUE;
				$data['message']="Bitte wählen Sie die Anrede aus.";
			}else if(empty($firstname)){
				$data['error']=TRUE;
				$data['p_element_focus']="contact_firstname";
				$data['message']="Bitte geben Sie den Vornamen ein.";
			}else if(empty($lastname)){
				$data['error']=TRUE;
				$data['p_element_focus']="contact_lastname";
				$data['message']="Bitte geben Sie den Nachnamen ein.";
			}else if(empty($email)){
				$data['error']=TRUE;
				$data['p_element_focus']="contact_email";
				$data['message']="Bitte geben Sie die E-Mail-Adresse ein.";
			}else if(!valid_email($email)){
				$data['error']=TRUE;
				$data['p_element_focus']="contact_email";
				$data['p_element_reset']=array("contact_email");
				$data['message']="Bitte geben Sie eine gültige E-Mail-Adresse ein.";
			}else{
				if(isset($_FILES['file']['type'][0])){
					$type = $_FILES['file']['type'][0];
					$content = file_get_contents($_FILES['file']['tmp_name'][0]);
					$portrait = 'data:'.$type.';base64,' . base64_encode($content);
				}else{
					$portrait = $this->Account_Model->get_contact(intval($this->session->userdata('account_id')),$contact_id)->row()->contact_portrait;
				}

				$this->Account_Model->update_contact($this->session->userdata('account_id'), $contact_id, $portrait, $salutation, $title, $firstname, $lastname, $position, $email, $phone);
				$data['error']=FALSE;
				$data['message']="Der Kontakt wurde erfolgreich bearbeitet.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function delete_contact(){
		if($this->session->userdata('login')){
			$contact_id = $this->input->get_post('id');
			if($this->Account_Model->get_detail(intval($this->session->userdata('account_id')))->row()->contact_id==$contact_id){
				$data['error']=TRUE;
				$data['message']='Bitte ändern Sie die Ansprechperson.';
			}else if($this->Account_Model->get_contact($this->session->userdata('account_id'),$contact_id)->num_rows()==1){
				$this->Account_Model->delete_contact($this->session->userdata('account_id'),$contact_id);
				$data['error']=FALSE;
				$data['message']='Der Kontakt wurde erfolgreich gelöscht.';
			}else{
				$data['error']=TRUE;
				$data['message']='Der Kontakt konnte nicht gelöscht werden, da ein Fehler aufgetreten ist.';
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function add_location(){
		if($this->session->userdata('login')){
			$this->load->helper("email");
			$name = $this->input->get_post('name');
			$address = $this->input->get_post('address');
			$pc = $this->input->get_post('pc');
			$city = $this->input->get_post('city');
			$country = $this->input->get_post('country');
			$email = $this->input->get_post('email');
			$phone = $this->input->get_post('phone');
			$fax = $this->input->get_post('fax');
			$website = $this->input->get_post('website');
			if(empty($name)){
				$data['error']=TRUE;
				$data['p_element_focus']="location_name";
				$data['message']="Bitte geben Sie eine Bezeichnung für den Standort an.";
			}else if(empty($address)){
				$data['error']=TRUE;
				$data['p_element_focus']="location_address";
				$data['message']="Bitte geben Sie die Adresse an.";
			}else if(empty($pc)){
				$data['error']=TRUE;
				$data['p_element_focus']="location_pc";
				$data['message']="Bitte geben Sie die PLZ an.";
			}else if(empty($city)){
				$data['error']=TRUE;
				$data['p_element_focus']="location_city";
				$data['message']="Bitte geben Sie den Ort an.";
			}else if($country==0){
				$data['error']=TRUE;
				$data['message']="Bitte wählen Sie ein Land aus.";
			}else if(!empty($email) && !valid_email($email)){
				$data['error']=TRUE;
				$data['p_element_focus']="location_email";
				$data['p_element_reset']=array("location_email");
				$data['message']="Bitte geben Sie eine gültige E-Mail-Adresse an.";
			}else{
				$this->Account_Model->add_location($this->session->userdata("account_id"),$name, $address, $pc, $city, $country, $email, $phone, $fax, $website);
				$data['error']=FALSE;
				$data['message']="Der Standort wurde erfolgreich hinzugefügt.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
		
	}

	public function update_location(){
		if($this->session->userdata('login')){
			$this->load->helper("email");
			$location_id = $this->input->get_post('id');
			$name = $this->input->get_post('name');
			$address = $this->input->get_post('address');
			$pc = $this->input->get_post('pc');
			$city = $this->input->get_post('city');
			$country = $this->input->get_post('country');
			$email = $this->input->get_post('email');
			$phone = $this->input->get_post('phone');
			$fax = $this->input->get_post('fax');
			$website = $this->input->get_post('website');
			if(empty($name)){
				$data['error']=TRUE;
				$data['p_element_focus']="location_name";
				$data['message']="Bitte geben Sie eine Bezeichnung für den Standort an.";
			}else if(empty($address)){
				$data['error']=TRUE;
				$data['p_element_focus']="location_address";
				$data['message']="Bitte geben Sie die Adresse an.";
			}else if(empty($pc)){
				$data['error']=TRUE;
				$data['p_element_focus']="location_pc";
				$data['message']="Bitte geben Sie die PLZ an.";
			}else if(empty($city)){
				$data['error']=TRUE;
				$data['p_element_focus']="location_city";
				$data['message']="Bitte geben Sie den Ort an.";
			}else if($country==0){
				$data['error']=TRUE;
				$data['message']="Bitte wählen Sie ein Land aus.";
			}else if(!empty($email) && !valid_email($email)){
				$data['error']=TRUE;
				$data['p_element_focus']="location_email";
				$data['p_element_reset']=array("location_email");
				$data['message']="Bitte geben Sie eine gültige E-Mail-Adresse an.";
			}else{
				$this->Account_Model->update_location($this->session->userdata("account_id"), $location_id, $name, $address, $pc, $city, $country, $email, $phone, $fax, $website);
				$data['error']=FALSE;
				$data['message']="Der Standort wurde erfolgreich bearbeitet.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
		
	}

	public function delete_location(){
		if($this->session->userdata('login')){
			$location_id = $this->input->get_post('id');
			if($this->Account_Model->get_detail(intval($this->session->userdata('account_id')))->row()->location_id==$location_id){
				$data['error']=TRUE;
				$data['message']='Bitte ändern Sie Ihren Hauptsitz.';
			}else if($this->Account_Model->get_location($this->session->userdata('account_id'),$location_id)->num_rows()==1){
				$this->Account_Model->delete_location($this->session->userdata('account_id'),$location_id);
				$data['error']=FALSE;
				$data['message']='Der Standort wurde erfolgreich gelöscht.';
			}else{
				$data['error']=TRUE;
				$data['message']='Der Standort konnte nicht gelöscht werden, da ein Fehler aufgetreten ist.';
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function bill($bill_year, $bill_id){
		if($this->session->userdata('login')){
			$this->load->helper("dompdf");
			$this->load->model("Bill_Model");
			if($this->Bill_Model->get_bill(intval($this->session->userdata('account_id')), $bill_year, $bill_id)->num_rows()==1){
				$this->lang->load("bill",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
				$object_account = $this->Account_Model->get_detail(intval($this->session->userdata('account_id')))->row();
				$template_bill['resource_url'] = $this->config->item('resource_url');
				$template_bill['company_name']=$object_account->company_name;

				$template_bill['bill'] = $this->Bill_Model->get_bill($object_account->company_id, $bill_year, $bill_id)->row();
				$template_bill['array_bill_item'] = $this->Bill_Model->get_item_list($object_account->company_id, $bill_year, $bill_id)->result();

				$content = $this->load->view('template/bill/default',$template_bill,true);
				pdf_create('Bill_'.$bill_year.''.$bill_id, $content);
			}else{
				show_404();
			}			
		}else{
			show_404();
		}		
	}

	public function add_job(){
		if($this->session->userdata('login')){
			$title = $this->input->get_post('title');
			$category = $this->input->get_post('category');
			$mode = $this->input->get_post('employee_mode');
			$month_rate = str_replace(',','.',str_replace('.', '', $this->input->get_post('month_rate')));
			$interval = $this->input->get_post('interval');
			$currency = $this->input->get_post('currency');
			$location = $this->input->get_post('location');
			$contact = $this->input->get_post('contact');
			$task = $this->input->get_post('task');
			$qualification = $this->input->get_post('qualification');
			$preface = $this->input->get_post('preface');
			$acknowledgment = $this->input->get_post('acknowledgment');
			
			if(empty($title)){
				$data['error']=TRUE;
				$data['message']='Bitte geben Sie die Bezeichnung des Jobangebotes ein.';
				$data['p_element_focus']="job_title";
			}else if($category==0){
				$data['error']=TRUE;
				$data['message']='Bitte wählen Sie eine Kategorie aus.';
			}else if($mode==0){
				$data['error']=TRUE;
				$data['message']='Bitte wählen Sie eine Beschäftigungsart aus.'.$mode;
			}else if(empty($month_rate) || !is_numeric($month_rate)){
				$data['error']=TRUE;
				$data['message']='Bitte geben Sie das Monatsgehalt ein.';
				$data['p_element_focus']="job_month_rate";
				$data['p_element_reset']=array("job_month_rate");
			}else if($location==0){
				$data['error']=TRUE;
				$data['message']='Bitte wählen Sie einen Standort aus.';
			}else if($contact==0){
				$data['error']=TRUE;
				$data['message']='Bitte wählen Sie einen Kontakt aus.';
			}else if(empty($preface)){
				$data['error']=TRUE;
				$data['message']='Bitte geben Sie die Firmenvorstellung ein.';
				$data['p_element_focus']="job_preface";
			}else if(empty($acknowledgment)){
				$data['error']=TRUE;
				$data['message']='Bitte geben Sie das Monatsgehalt ein.';
				$data['p_element_focus']="job_acknowledgment";
			}else{
				$this->load->model('Job_Model');
				$this->Job_Model->add_job($this->session->userdata('account_id'), $title, $category, $mode, $month_rate, $interval, $currency, $location, $contact, $preface, $acknowledgment);
				$job_id = $this->Job_Model->get_last_job($this->session->userdata('account_id'))->row()->job_id;
				for ($i=0; $i < count($task); $i++) { 
					if(trim($task[$i])!=""){
						$this->Job_Model->add_section_item($job_id, "Task", $task[$i]);
					}
		        }
		        for ($i=0; $i < count($qualification); $i++) { 
					if(trim($qualification[$i])!=""){
						$this->Job_Model->add_section_item($job_id, "Qualification", $qualification[$i]);
					}
		        }
				$data['error']=FALSE;
				$data['message']='Das Jobangebote wurde erfolgreich veröffentlicht';
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{

		}
	}

	public function update_job(){
		if($this->session->userdata('login')){
			$id = $this->input->get_post('id');
			$title = $this->input->get_post('title');
			$category = $this->input->get_post('category');
			$mode = $this->input->get_post('employee_mode');
			$month_rate = str_replace(',','.',str_replace('.', '', $this->input->get_post('month_rate')));
			$interval = $this->input->get_post('interval');
			$currency = $this->input->get_post('currency');
			$location = $this->input->get_post('location');
			$contact = $this->input->get_post('contact');
			$task = $this->input->get_post('task');
			$qualification = $this->input->get_post('qualification');
			$preface = $this->input->get_post('preface');
			$acknowledgment = $this->input->get_post('acknowledgment');
			
			if(empty($title)){
				$data['error']=TRUE;
				$data['message']='Bitte geben Sie die Bezeichnung des Jobangebotes ein.';
				$data['p_element_focus']="job_title";
			}else if($category==0){
				$data['error']=TRUE;
				$data['message']='Bitte wählen Sie eine Kategorie aus.';
			}else if($mode==0){
				$data['error']=TRUE;
				$data['message']='Bitte wählen Sie eine Beschäftigungsart aus.'.$mode;
			}else if(empty($month_rate) || !is_numeric($month_rate)){
				$data['error']=TRUE;
				$data['message']='Bitte geben Sie das Monatsgehalt ein.';
				$data['p_element_focus']="job_month_rate";
				$data['p_element_reset']=array("job_month_rate");
			}else if($location==0){
				$data['error']=TRUE;
				$data['message']='Bitte wählen Sie einen Standort aus.';
			}else if($contact==0){
				$data['error']=TRUE;
				$data['message']='Bitte wählen Sie einen Kontakt aus.';
			}else if(empty($preface)){
				$data['error']=TRUE;
				$data['message']='Bitte geben Sie die Firmenvorstellung ein.';
				$data['p_element_focus']="job_preface";
			}else if(empty($acknowledgment)){
				$data['error']=TRUE;
				$data['message']='Bitte geben Sie das Monatsgehalt ein.';
				$data['p_element_focus']="job_acknowledgment";
			}else{
				$this->load->model('Job_Model');
				if($this->Job_Model->get_job("all",$this->session->userdata('account_id'),$id)->num_rows()==1){

					$this->Job_Model->update_job($this->session->userdata('account_id'), $id, $title, $category, $this->Job_Model->get_job("all",$this->session->userdata('account_id'),$id)->row()->position_id, $mode, $month_rate, $interval, $currency, $location, $contact, $preface, $acknowledgment);
					$this->Job_Model->delete_section_item($id, "Task");
					for ($i=0; $i < count($task); $i++) { 
						if(trim($task[$i]) != ""){
							$this->Job_Model->add_section_item($id, "Task", $task[$i]);
						}
			        }
			        $this->Job_Model->delete_section_item($id, "Qualification");
			        for ($i=0; $i < count($qualification); $i++) { 
						if(trim($qualification[$i]) != ""){
							$this->Job_Model->add_section_item($id, "Qualification", $qualification[$i]);
						}
			        }
					$data['error']=FALSE;
					$data['message']='Das Jobangebote wurde erfolgreich bearbeitet';
				}else{
					$data['error']=TRUE;
					$data['message']='Das Jobangebote existiert nicht.';
				}
				
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{

		}
	}

	public function change_job_position($type){
		if($this->session->userdata('login')){
			$this->load->model('Job_Model');
			$id = $this->input->get_post('id');
			if($this->Job_Model->get_job("all", intval($this->session->userdata('account_id')), $id)->num_rows()==1 && strtolower($type) == 'closed' || strtolower($type) == 'open'){
				$this->Job_Model->change_position(intval($this->session->userdata('account_id')), $id, $type);
				$data['error']=FALSE;
				if(strtolower($type) == 'closed'){
					$data['message']='Das Jobangebot wurde erfolgreich geschlossen.';
				}				
			}else{
				$data['error']=TRUE;
				$data['message']='Die Position des Jobangebotes konnte nicht verändert werden, da ein Fehler aufgetreten ist.';
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function update_profile(){
		if($this->session->userdata('login')){
			$branche = $this->input->get_post('branche');
			$amount_of_employee = $this->input->get_post('amount_of_employee');
			$employee_per_year = $this->input->get_post('employee_per_year');
			$most_common_employees = $this->input->get_post('most_common_employees');
			$release_year = $this->input->get_post('release_year');
			$location = $this->input->get_post('location');
			$contact = $this->input->get_post('contact');
			$description = $this->input->get_post('description');
			$facebook = $this->input->get_post('facebook');
			$google_plus = $this->input->get_post('google_plus');
			$linkedin = $this->input->get_post('linkedin');
			$twitter = $this->input->get_post('twitter');
			$xing = $this->input->get_post('xing');
			$youtube = $this->input->get_post('youtube');

			$this->Account_Model->update_profile(intval($this->session->userdata('account_id')),$branche, $amount_of_employee, $employee_per_year, $most_common_employees, $release_year, $location, $contact, $description, $facebook, $google_plus, $linkedin, $twitter, $xing, $youtube);
			$data['error']=FALSE;
			$data['message']='Das Profil wurde erfolgreich bearbeitet.';

			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */