<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		show_404();
	}

	public function send_contact_form(){
		$this->load->helper("email");

		$firstname = $this->input->get_post("firstname");
		$lastname = $this->input->get_post("lastname");
		$email = $this->input->get_post("email");
		$subject = $this->input->get_post("subject");
		$message = $this->input->get_post("message");

		if(empty($firstname)){
			$data['error'] = TRUE;
			$data['p_element_focus'] = "contact_firstname";
			$data['message'] = "Bitte geben Sie einen Vornamen ein.";
		}else if(empty($lastname)){
			$data['error'] = TRUE;
			$data['p_element_focus'] = "contact_lastname";
			$data['message'] = "Bitte geben Sie einen Nachnamen ein.";
		}else if(empty($email)){
			$data['error'] = TRUE;
			$data['p_element_focus'] = "contact_email";
			$data['message'] = "Bitte geben Sie eine E-Mail-Adresse ein.";
		}else if(!valid_email($email)){
			$data['error'] = TRUE;
			$data['p_element_focus'] = "contact_email";
			$data['message'] = "Bitte geben Sie eine gültige E-Mail-Adresse ein.";
		}else if($subject == 0){
			$data['error'] = TRUE;
			$data['p_element_focus'] = "contact_subject";
			$data['message'] = "Bitte wählen Sie einen Betreff aus.";
		}else if(empty($message)){
			$data['error'] = TRUE;
			$data['p_element_focus'] = "contact_message";
			$data['message'] = "Bitte geben Sie eine Nachricht ein.";
		}else{
			$this->load->library("email");
			$this->email->from($email, $firstname." ".strtoupper($lastname));
			switch($subject){
				case 1:
				$this->email->to('office@primus-romulus.net'); 
				$this->email->subject('Feedback von '.$firstname.' '.$lastname);
				break;
				case 2:
				$this->email->to('support@primus-romulus.net');
				$this->email->subject('Frage von '.$firstname.' '.$lastname);
				break;
				case 3:
				$this->email->to('hello@primus-romulus.net'); 
				$this->email->subject('Grüße von '.$firstname.' '.$lastname);
				break;	
			}
			$this->email->message($message);	
			$this->email->send();

			$data['error'] = FALSE;
			$data['p_element_reset'] = array("contact_firstname", "contact_lastname", "contact_email", "contact_subject", "contact_message");
			$data['message'] = "Das Formular wurde erfolgreich abgesendet.";
		}
		$this->load->view("plugin/system/form_response",$data);
	}

	public function send_partner_request(){
		$this->load->helper("email");

		$salutation = $this->input->get_post('salutation');
		$title = $this->input->get_post('title');
		$firstname = $this->input->get_post('firstname');
		$lastname = $this->input->get_post('lastname');
		$email = $this->input->get_post('email');
		$company_name = $this->input->get_post('company_name');
		$address = $this->input->get_post('address');
		$pc = $this->input->get_post('pc');
		$city = $this->input->get_post('city');
		$phone = $this->input->get_post('phone');
		$website = $this->input->get_post('website');

		if($salutation==0){
			$data['error'] = TRUE;
			$data['p_element_focus'] = "partner_salutation";
			$data['message'] = "Bitte wählen Sie eine Anrede aus.";
		}else if(empty($firstname)){
			$data['error'] = TRUE;
			$data['p_element_focus'] = "partner_firstname";
			$data['message'] = "Bitte geben Sie einen Vornamen ein.";
		}else if(empty($lastname)){
			$data['error'] = TRUE;
			$data['p_element_focus'] = "partner_lastname";
			$data['message'] = "Bitte geben Sie einen Nachnamen ein.";
		}else if(empty($email)){
			$data['error'] = TRUE;
			$data['p_element_focus'] = "partner_email";
			$data['message'] = "Bitte geben Sie eine E-Mail-Adresse ein.";
		}else if(!valid_email($email)){
			$data['error'] = TRUE;
			$data['p_element_focus'] = "partner_email";
			$data['message'] = "Bitte geben Sie eine gültige E-Mail-Adresse ein.";
		}else if(empty($company_name)){
			$data['error'] = TRUE;
			$data['p_element_focus'] = "partner_company_name";
			$data['message'] = "Bitte geben Sie Ihren Firmennamen ein.";
		}else{
			$this->load->library("email");
			$this->email->from($email, ( $title != "" ? $title.' ' : '' ).''.$firstname.' '.strtoupper($lastname));
			//Flucher: Testzweck, ob E-Mails gehen -- Was nicht der Fall ist ;)
			//$this->email->to('partner@primus-romulus.net'); 
			$this->email->to('info@nitec.at'); 
			$this->email->subject('Partneranfrage: '.strtoupper($company_name));
			$this->email->message("{$company_name}\n{$address}\n{$pc} {$city}\n\nKontaktdaten: \n".($salutation == 1 ? "Frau" : "Herr")."\n".(trim($title)!="" ? $title.' ' : '' )."{$firstname} {$lastname}\n\nE-Mail: {$email}\nTel.: {$phone}");	
			$this->email->send();

			$data['error'] = FALSE;
			$data['message'] = "Ihre Anfrage wurde erfolgreich versendet. Wir werden uns in kürze bei Ihnen melden.";
		}
		$this->load->view("plugin/system/form_response",$data);
	}

}