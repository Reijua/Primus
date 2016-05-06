<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if (!$this->input->is_ajax_request()) {
			show_404();
		}

		$this->load->model('Account_Model');
		$this->load->model('Member_Model');
	}

	public function index(){
		show_404();
	}

	public function get_member_with_name($name = "", $company = "", $class = "") {
		$name = ($name == 'XALLX' ? $name = "" : $name);
		$company = ($company == 'XALLX' ? $company = "" : $company);
		$class = ($class == 'XALLX' ? $class = "" : $class);

		$company = ""; // Woher weiß man wo ein Absolvent arbeitet??

		if (empty($name) && empty($company) && empty($class)) {
			$data['error'] = TRUE;
			$data['message'] = 'Bitte geben Sie an wonach Sie filtern möchten.';
			$this->load->view("plugin/system/form_response", $data);
		} else if (!empty($name) && !empty($company) && !empty($company)) {
			$data['members'] = $this->Member_Model->get_account("filter:name_company_class", $name .':'. $company .':'. $class);
			$this->load->view("member/search-result", $data);
		} else if (!empty($name) && !empty($company)) {
			$data['members'] = $this->Member_Model->get_account("filter:name_company", $name .':'. $company);
			$this->load->view("member/search-result", $data);
		} else if (!empty($name) && !empty($class)) {
			$data['members'] = $this->Member_Model->get_account("filter:name_class", $name .':'. $class);
			$this->load->view("member/search-result", $data);
		} else if (!empty($company) && !empty($class)) {
			$data['members'] = $this->Member_Model->get_account("filter:company_class", $company .':'. $class);
			$this->load->view("member/search-result", $data);
		} else if (!empty($name)) {
			$data['members'] = $this->Member_Model->get_account("filter:name", $name);
			$this->load->view("member/search-result", $data);
		} else if (!empty($company)) {
			$data['members'] = $this->Member_Model->get_account("filter:company", $company);
			$this->load->view("member/search-result", $data);
		} else if (!empty($class)) {
			$data['members'] = $this->Member_Model->get_account("filter:class", $class);
			$this->load->view("member/search-result", $data);
		}
	}

	public function update_member(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all", $this->session->userdata("account_id"))->row();
			if($this->Member_Model->get_privileg($v_account->group_id, "UPDATE")->num_rows() == 1){
				$id = $this->input->get_post("id");
				if($this->Account_Model->get_account("all", $id)->num_rows() == 1){
					$salutation = $this->input->get_post("salutation");
					$title = $this->input->get_post("title");
					$firstname = $this->input->get_post("firstname");
					$lastname = $this->input->get_post("lastname");
					$birthday_day = $this->input->get_post("birthday_day");
					$birthday_month = $this->input->get_post("birthday_month");
					$birthday_year = $this->input->get_post("birthday_year");
					$class = $this->input->get_post("class");
					$group = $this->input->get_post("group");
					if($salutation == 0){
			        	$data['error'] = TRUE;
						$data['message']= "Bitte wählen Sie die Anrede aus.";
			        }else if(empty($firstname)){
			        	$data['error'] = TRUE;
			        	$data['p_element_focus']="signup_firstname";
						$data['message']= "Bitte geben Sie den Vornamen ein.";
			        }else if(empty($lastname)){
			        	$data['error'] = TRUE;
			        	$data['p_element_focus']="signup_lastname";
			        	$data['message']= "Bitte geben Sie den Nachnamen ein.";
			        }else if(empty($birthday_day)){
			        	$data['error'] = TRUE;
			        	$data['p_element_focus']="signup_birthday_day";
			        	$data['message']= "Bitte geben Sie den Tag des Geburtstages ein.";
			        }else if(!is_int(intval($birthday_day)) || !is_numeric($birthday_day) || $birthday_day > 31 ||  $birthday_day < 1 || strlen(intval($birthday_day)) > 2){
			        	$data['error'] = TRUE;
			        	$data['p_element_reset']=array("signup_birthday_day");
			        	$data['p_element_focus']="signup_birthday_day";
			        	$data['message']= "Der Tag wurde nicht richtig eingegeben. Achten Sie darauf, das die Zahl zwischen 1 und 31 ist.";
			        }else if($birthday_month==0){
			        	$data['error'] = TRUE;
						$data['message']= "Bitte wählen Sie den Monat des Geburtstages aus.";
			        }else if(empty($birthday_year)){
			        	$data['error'] = TRUE;
			        	$data['p_element_focus']="signup_birthday_year";
			        	$data['message']= "Bitte geben Sie das Jahr des Geburtstages ein.";
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
			        	}else if($birthday_day >= 30 && $birthday_month == 4|| $birthday_month == 6 || $birthday_month == 9 || $birthday_month == 11){
			        		$data['message']= "Dieses Monat hat nur 30 Tage.";
			        	}else{
			        		$data['message']= "Das Geburtsdatum ist ungültig.";
			        	}	        	
			        }else if($class==0){
			        	$data['error'] = TRUE;
			        	$data['message'] = "Bitte wählen Sie eine Klasse aus.";
			        }else if($group==0){
			        	$data['error'] = TRUE;
			        	$data['message'] = "Bitte wählen Sie eine Gruppe aus.";
			        }else{
			        	$this->Member_Model->update_member($id, $salutation, $title, $firstname, $lastname, $birthday_year.'-'.$birthday_month.'-'.$birthday_day, $class, $group);
			        	$data['error'] = FALSE;
			        	$data['message'] = "Das Mitglied wurde erfolgreich bearbeitet.";
			        }
				}else{
					$data['error'] = TRUE;
					$data['message'] = "Das Mitglied kann nicht bearbeitet werden, da es nicht existiert.";
				}
			}else{
				$data['error'] = TRUE;
				$data['message'] = "Sie können keine Benutzer sperren, da Sie keine Berechtigung haben.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function lock_member($p_member_id = ""){
		if($this->session->userdata("login") && $p_member_id != ""){
			$v_account = $this->Account_Model->get_account("all", $this->session->userdata("account_id"))->row();
			if($this->Member_Model->get_privileg($v_account->group_id, "UPDATE")->num_rows() == 1){
				if($this->Account_Model->get_account("all", $p_member_id)->num_rows() == 1){
					$v_member = $this->Account_Model->get_account("all", $p_member_id)->row();
					$reason = $this->input->get_post("input_box");
					if(empty($reason)){
						$data['error'] = TRUE;
						$data['message'] = "Bitte geben Sie einen Grund an.";
					}else if($this->Account_Model->is_locked($p_member_id)->num_rows()==1){
						$data['error'] = TRUE;
						$data['message'] = "Das Mitglied ist bereits gesperrt.";
					}else if($v_account->member_id == $v_member->member_id){
						$data['error'] = TRUE;
						$data['message'] = "Sie können sich selbst nicht sperren!";
					}else if(strtolower($v_member->group_name) == strtolower("Management")){
						$data['error'] = TRUE;
						$data['message'] = "Sie können keine Mitglieder im Vorstand sperren.";
					}else{
						$this->Account_Model->lock_account($p_member_id, -1, $reason);
						$data['error'] = FALSE;
						$data['message'] = "Das Mitglied wurde erfolgreich gesperrt.";
					}
				}else{
					$data['error'] = TRUE;
					$data['message'] = "Das Mitglied kann nicht gesperrt werden, da es nicht existiert.";
				}
			}else{
				$data['error'] = TRUE;
				$data['message'] = "Sie können keine Benutzer sperren, da Sie keine Berechtigung haben.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function unlock_member($p_member_id = ""){
		if($this->session->userdata("login") && $p_member_id != ""){
			$v_account = $this->Account_Model->get_account("all", $this->session->userdata("account_id"))->row();
			if($this->Member_Model->get_privileg($v_account->group_id, "UPDATE")->num_rows() == 1){
				if($this->Account_Model->get_account("all", $p_member_id)->num_rows() == 1 && $this->Account_Model->is_locked($p_member_id)->num_rows() == 1){
					$this->Member_Model->unlock_member($p_member_id);
					$v_account = $this->Account_Model->get_account("all", $p_member_id)->row();
					if(strtolower($v_account->group_name) == strtolower("Interested Person")){
						$this->load->helper("string");
						$v_code = random_string("alnum", 16);
						$this->Account_Model->update_password($v_account->member_id, $v_code);
						$template["cdn_url"] = $this->config->item("cdn_url");
						$template["object_account"] = $this->Account_Model->get_account("all", $p_member_id)->row();
						$this->load->library("email");
						$this->email->from('office@primus-romulus.net', "Primus Romulus");
						$this->email->to($v_account->member_email); 
						$this->email->subject("Herzlich Willkommen!");
						$this->email->message($this->load->view("template/email/signup", $template, true));
						$this->email->set_alt_message("Hallo {$v_account->member_firstname}!\r\n\r\nMit freundlichen Grüßen\r\n\r\n\r\nPrimus Romulus");
						$this->email->send();

						$data['message'] = "Der Benutzer wurde erfolgreich freigeschalten und per E-Mail benachrichtigt.";
					}else{
						$data['message'] = "Der Benutzer wurde erfolgreich freigeschalten.";
					}					
					$data['error'] = FALSE;
				}else{
					$data['error'] = TRUE;
					$data['message'] = "Der Benutzer konnte nicht freigeschalten werden, da er nicht gesperrt ist.";
				}				
			}else{
				$data['error'] = TRUE;
				$data['message'] = "Sie können keine Benutzer freischalten, da Sie keine Berechtigung haben.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */