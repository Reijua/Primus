<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends CI_Controller {
	public function __construct(){
		parent::__construct();
		/*if(!$this->input->is_ajax_request()){
			show_404();
		}*/
	}

	public function index(){
		show_404();
	}

	public function recovery_password(){
		if(!$this->session->userdata("login")){
			$this->load->model("Account_Model");
			$this->load->helper("email");
			$p_email = $this->input->get_post("email");
			if(empty($p_email)){
				$data['error'] = TRUE;
				$data['p_element_focus'] = "recovery_password_email";
				$data['message'] = "Bitte geben Sie die E-Mail-Adresse ein.";
			}else if(!valid_email($p_email)){
				$data['error'] = TRUE;
				$data['p_element_reset'] = array("recovery_password_email");
				$data['p_element_focus'] = "recovery_password_email";
				$data['message'] = "Bitte geben Sie eine gültige E-Mail-Adresse ein.";
			}else if($this->Account_Model->get_account("filter:email", $p_email)->num_rows() == 0){
				$data['error'] = TRUE;
				$data['p_element_reset'] = array("recovery_password_email");
				$data['message'] = "Dieses Partnerkonto existiert nicht.";
			}else{
				$object_account = $this->Account_Model->get_account("filter:email",$p_email)->row();
				if($this->Account_Model->is_locked($object_account->company_id)->num_rows()==1){
					$data['error']=TRUE;
					$data['p_element_reset'] = array("recovery_password_email");
					$data['message'] = "Ihr Konto ist zurzeit gesperrt deswegen können Sie Ihr Passwort nicht zurücksetzen.";
				}else if($this->Account_Model->get_code("filter:last:24hours",$object_account->company_id)->num_rows()==5){
					$data['error']=TRUE;
					$data['p_element_reset'] = array("recovery_password_email");
					$data['message'] = "Sie können Ihr Passwort nur 5 Mal innerhalb von 24 Stunden wiederherstellen.";
				}else{
					$this->load->helper("string");

					$v_base_url = $this->config->item("base_url");
					$v_code = random_string("alnum", 32);

					$this->Account_Model->create_recovery_code($object_account->company_id, $v_code);
					$template["cdn_url"] = $this->config->item("cdn_url");
					$template["base_url"] = $v_base_url;
					$template["object_code"] = $v_code;
					$template["object_account"] = $object_account;
					
					/*$this->load->library("email");
					$this->email->from('support@primus-romulus.net', "Primus Romulus Support");
					$this->email->to($object_account->member_email); 
					$this->email->subject("Passwort zurücksetzen");
					$this->email->message($this->load->view("template/email/recovery", $template, true));
					$this->email->set_alt_message("Sehr geehrte Damen und Herren!\r\n\r\nDamit du Sie das Passwort zurücksetzen können, öffnen Sie folgenden Link in Ihrem Browser:\r\n\r\n{$v_base_url}support/recovery/?code={v_code}&email={$object_account->member_email}\r\n\r\nSollten Sie sich nach der Eingabe Ihres neuen Passwortes noch immer nicht anmelden können, wende Sie sich bitte per E-Mail an support@primus-romulus.net .\r\n\r\nMit freundlichen Grüßen\r\n\r\n\r\nPrimus Romulus");
					$this->email->send();*/
					
					$data['error']=FALSE;
					$data['message']="Bitte rufen Sie Ihr E-Mails ab und befolgen Sie die Schritte in der E-Mail.";
				}
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function send_problem(){
		if(!$this->session->userdata("login")){
			$this->load->helper("email");

			$p_partner_name = $this->input->get_post("name");
			$p_firstname = $this->input->get_post("firstname");
			$p_lastname = $this->input->get_post("lastname");
			$p_email = $this->input->get_post("email");
			$p_description = $this->input->get_post("description");

			if(empty($p_partner_name)){
				$data['error'] = TRUE;
				$data['p_element_focus'] = "problem_name";
				$data['message'] = "Bitte geben Sie den Firmennamen ein.";
			}else if(empty($p_firstname)){
				$data['error'] = TRUE;
				$data['p_element_focus'] = "problem_firstname";
				$data['message'] = "Bitte geben Sie Ihren Vornamen ein.";
			}else if(empty($p_lastname)){
				$data['error'] = TRUE;
				$data['p_element_focus'] = "problem_lastname";
				$data['message'] = "Bitte geben Sie Ihren Nachnamen ein.";
			}else if(empty($p_email)){
				$data['error'] = TRUE;
				$data['p_element_focus'] = "problem_email";
				$data['message'] = "Bitte geben Sie eine E-Mail-Adresse ein.";
			}else if(!valid_email($p_email)){
				$data['error'] = TRUE;
				$data['p_element_focus'] = "problem_email";
				$data['p_element_reset'] = array("problem_email");
				$data['message'] = "Bitte geben Sie eine gültige E-Mail-Adresse ein.";
			}else if(empty($p_description)){
				$data['error'] = TRUE;
				$data['p_element_focus'] = "problem_description";
				$data['message'] = "Diese E-Mail-Adresse ist breits in unserem System vorhanden.";
			}else{
				$this->load->library('email');
				$this->email->from($p_email);
				$this->email->to('support@primus-romulus.net'); 
				$this->email->subject("[Ticket][{$p_partner_name}] {p_firstname} {$p_lastname}");
				$this->email->message($description."<br /><br /><br />IP-Adresse: {$this->input->ip_address()}<br />Browser: {$this->agent->browser()}<br />Betriebssystem: ".($this->agent->is_mobile() ? $this->agent->mobile() : $this->agent->platform() )."");
				$this->email->set_alt_message($description."\r\n\r\n\r\nIP-Adresse: {$this->input->ip_address()}\r\nBrowser: {$this->agent->browser()}\r\nBetriebssystem: ".($this->agent->is_mobile() ? $this->agent->mobile() : $this->agent->platform() )."");
				$this->email->send();
				$data['error'] = FALSE;
				$data['message'] = "Die Nachricht wurde erfolgreich abgeschickt. Wir werden uns so schnell es geht bei Ihnen melden.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}
}