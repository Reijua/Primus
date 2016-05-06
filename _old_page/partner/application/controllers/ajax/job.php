<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job extends CI_Controller {
	public function __construct(){
		parent::__construct();
		/*if(!$this->input->is_ajax_request()){
			show_404();
		}*/
		if($this->session->userdata("login")){
			$this->load->model("General_Model");
			$this->load->model("Account_Model");
			$this->load->model("Job_Model");
			$this->load->model("Contact_Model");
			$this->load->model("Location_Model");
		}
	}

	public function index(){
		show_404();
	}

	public function create_job(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all", intval($this->session->userdata("account_id")))->row();
			if($this->Job_Model->get_privilege($v_account->group_id, "CREATE")->num_rows() == 1){
				if($v_account->group_job_count > $this->Job_Model->get_job(intval($this->session->userdata("account_id")), "filter:year")->num_rows()){
					$p_name = $this->input->get_post("name");
					$p_location = $this->input->get_post("location");
					$p_contact = $this->input->get_post("contact");
					$p_preamble = $this->input->get_post("preamble");
					$p_task = $this->input->get_post("task");
					$p_qualifikation = $this->input->get_post("qualification");
					$p_benefit = $this->input->get_post("benefit");
					$p_summary = $this->input->get_post("summary");

					if(empty($p_name)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "job_name";
						$data['message'] = "Bitte geben Sie die Jobbezeichnung ein.".$p_name;
					}else if($p_location == NULL || $this->Location_Model->get_location(intval($this->session->userdata("account_id")), "all", $p_location)->num_rows() != 1){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie den Standort aus.";
					}else if($p_contact == NULL || $this->Contact_Model->get_contact(intval($this->session->userdata("account_id")), "all", $p_contact)->num_rows() != 1){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie die Kontaktperson aus.";
					}else{
						$v_job_id = $this->Job_Model->create_job(intval($this->session->userdata("account_id")), $p_name, $p_location, $p_contact, $p_preamble, $p_summary);
						if($p_task != NULL){
							for ($i=0; $i < count($p_task); $i++) { 
								if($p_task[$i] != ""){
									$this->Job_Model->add_section_item($v_job_id, 1, $p_task[$i]);
								}
							}
						}
						if($p_qualifikation != NULL){
							for ($i=0; $i < count($p_qualifikation); $i++) { 
								if($p_qualifikation[$i] != ""){
									$this->Job_Model->add_section_item($v_job_id, 2, $p_qualifikation[$i]);
								}
							}
						}
						if($p_benefit != NULL){
							for ($i=0; $i < count($p_benefit); $i++) { 
								if($p_benefit[$i] != ""){
									$this->Job_Model->add_section_item($v_job_id, 3, $p_benefit[$i]);
								}
							}
						}
						$data['error'] = FALSE;
						$data['message'] = "Das Jobangebot wurde erfolgreich veröffentlicht.";
					}
				}else{
					$data['error'] = TRUE;
					$data['message'] = "Sie haben schon die maximale Anzahl an Jobangebote für dieses Jahr erreicht.";
				}				
			}else{
				$data['error'] = TRUE;
				$data['message'] = "Sie haben nicht die Berechtigung, dass Sie ein Jobangebot hinzufügen können.";
			}			
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function send_job(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all", intval($this->session->userdata("account_id")))->row();
			if($this->Job_Model->get_privilege($v_account->group_id, "CREATE")->num_rows() == 1){
				if($v_account->group_job_count > $this->Job_Model->get_job(intval($this->session->userdata("account_id")), "filter:year")->num_rows()){
					$p_location = $this->input->get_post("location");
					$p_contact = $this->input->get_post("contact");					
					$v_file_types = array("application/pdf", "x-application/pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document
", "application/vnd.ms-word.document.macroEnabled.12");

					if($p_location == NULL || $this->Location_Model->get_location(intval($this->session->userdata("account_id")), "all", $p_location)->num_rows() != 1){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie den Standort aus.";
					}else if($p_contact == NULL || $this->Contact_Model->get_contact(intval($this->session->userdata("account_id")), "all", $p_contact)->num_rows() != 1){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie die Kontaktperson aus.";
					}else if(!isset($_FILES['file'])){
						$data['error']=TRUE;
						$data['message']="Bitte wählen Sie eine Datei aus.";
					}else if(count($_FILES['file']['name'])>1){
						$data['error']=TRUE;
						$data['message']="Es darf nur eine Datei ausgewählt werden.";
					}else if(!in_array(strtolower($_FILES['file']['type'][0]), $v_file_types)){
						$data['error']=TRUE;
						$data['message']="Sie können nur folgende Dateiformate hochgeladen werden:\n - PDF\n - Microsoft Word";
					}else if(filesize($_FILES['file']['tmp_name'][0]) > 2000000){
						$data['error']=TRUE;
						$data['message']="Die Datei darf nicht größer sein als 2 MB.";
					}else{
						$this->load->model("Partner_Model");
						$v_supporter = $this->Partner_Model->get_supporter($v_account->supporter_id)->row();
						$v_contact = $this->Contact_Model->get_contact(intval($this->session->userdata("account_id")), "all", $p_contact)->row();
						$this->load->library("email");
						$this->email->from($v_contact->contact_email, ($v_contact->contact_title == "" ? "" : $v_contact->contact_title." ")."{$v_contact->contact_firstname} {$v_contact->contact_firstname}");
						$this->email->to($v_supporter->member_email);
						$this->email->subject("[Jobangebot] {$v_account->company_name}");
						$this->email->message("Kontaktperson: {$v_location->contact_firstname} {$v_location->contact_lastname}<br />{$v_location->location_name}<br /><br /><br />Im Anhang befindet sich das Jobangebot.");
						$this->email->set_alt_message("Kontaktperson: {$v_location->contact_firstname} {$v_location->contact_lastname}\r\nStandort: {$v_location->location_name}\r\n\r\n\r\nIm Anhang befindet sich das Jobangebot.");
						$this->email->attach($_FILES["file"]["tmp_name"][0]);
						//$this->email->send();

						$data['error'] = FALSE;
						$data['message'] = "Das Jobangebot wird überprüft und für Sie online gestellt. Wir melden uns bei Ihnen wenn wir mit dem Vorgang fertig sind.";
					}					
				}else{
					$data['error'] = TRUE;
					$data['message'] = "Sie haben schon die maximale Anzahl an Jobangebote für dieses Jahr erreicht.";
				}				
			}else{
				$data['error'] = TRUE;
				$data['message'] = "Sie haben nicht die Berechtigung, dass Sie ein Jobangebot hinzufügen können.";
			}			
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function update_Job(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->Job_Model->get_privilege($v_account->group_id, "UPDATE")->num_rows()==1){
				$p_id = $this->input->get_post("id");
				if($this->Job_Model->get_job(intval($this->session->userdata("account_id")), "all", $p_id)->num_rows()==1){
					$p_name = $this->input->get_post("name");
					$p_location = $this->input->get_post("location");
					$p_contact = $this->input->get_post("contact");
					$p_preamble = $this->input->get_post("preamble");
					$p_task = $this->input->get_post("task");
					$p_qualifikation = $this->input->get_post("qualification");
					$p_benefit = $this->input->get_post("benefit");
					$p_summary = $this->input->get_post("summary");

					if(empty($p_name)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "job_name";
						$data['message'] = "Bitte geben Sie die Jobbezeichnung ein.".$p_name;
					}else if($p_location == NULL || $this->Location_Model->get_location(intval($this->session->userdata("account_id")), "all", $p_location)->num_rows() != 1){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie den Standort aus.";
					}else if($p_contact == NULL || $this->Contact_Model->get_contact(intval($this->session->userdata("account_id")), "all", $p_contact)->num_rows() != 1){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie die Kontaktperson aus.";
					}else{
						 $this->Job_Model->update_job(intval($this->session->userdata("account_id")), $p_id, $p_name, $p_location, $p_contact, $p_preamble, $p_summary);
						if($p_task != NULL){
							$this->Job_Model->remove_section_items($p_id, 1);
							for ($i=0; $i < count($p_task); $i++) { 
								if($p_task[$i] != ""){
									$this->Job_Model->add_section_item($p_id, 1, $p_task[$i]);
								}
							}
						}
						if($p_qualifikation != NULL){
							$this->Job_Model->remove_section_items($p_id, 2);
							for ($i=0; $i < count($p_qualifikation); $i++) { 
								if($p_qualifikation[$i] != ""){
									$this->Job_Model->add_section_item($p_id, 2, $p_qualifikation[$i]);
								}
							}
						}
						if($p_benefit != NULL){
							$this->Job_Model->remove_section_items($p_id, 3);
							for ($i=0; $i < count($p_benefit); $i++) {
								if($p_benefit[$i] != ""){
									$this->Job_Model->add_section_item($p_id, 3, $p_benefit[$i]);
								}
							}
						}
						$data['error'] = FALSE;
						$data['message'] = "Das Jobangebot wurde erfolgreich bearbeitet.";
					}
				}else{
					$data['error']=TRUE;
					$data['message'] = "Das Jobangebot kann nicht bearbeitet werden, da dieses nicht existiert.";
				}
			}else{
				$data['error']=TRUE;
				$data['message'] = "Sie können keine Jobangebote bearbeiten, da Sie dazu keine Berechtigung besitzen.";
			}
			$this->load->view("plugin/system/form_response", $data);
		}else{
			show_404();
		}
	}

	public function close_job($p_job_id = ""){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->Job_Model->get_privilege($v_account->group_id, "UPDATE STATUS")->num_rows()==1){
				if($this->Job_Model->get_job(intval($this->session->userdata("account_id")), "all", $p_job_id)->num_rows()==1){
					$v_job = $this->Job_Model->get_job(intval($this->session->userdata("account_id")), "all", $p_job_id)->row();
					if($v_job->company_id == intval($this->session->userdata("account_id")) && $v_job->status_name == "OPEN"){
						$this->Job_Model->change_status(intval($this->session->userdata("account_id")), $p_job_id, "CLOSED");
						$data['error']=FALSE;
						$data['message'] = "Das Jobangebot wurde erfolgreich geschlossen.";
					}else{
						$data['error']=TRUE;
						$data['message'] = "Das Jobangebot konnte nicht geschlossen werden, da ein Fehler aufgetreten ist.";
					}					
				}else{
					$data['error']=TRUE;
					$data['message'] = "Das Jobangebot kann nicht geschlossen werden, da es nicht existiert.";
				}
			}else{
				$data['error']=TRUE;
				$data['message'] = "Sie können den Status des Jobangebotes nicht ändern, da Sie nicht genügend Berechtigungen haben.";
			}			
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}		
	}

	public function open_job($p_job_id = ""){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->Job_Model->get_privilege($v_account->group_id, "UPDATE STATUS")->num_rows()==1){
				if($this->Job_Model->get_job(intval($this->session->userdata("account_id")), "all", $p_job_id)->num_rows()==1){
					$v_job = $this->Job_Model->get_job(intval($this->session->userdata("account_id")), "all", $p_job_id)->row();
					if($v_job->company_id == intval($this->session->userdata("account_id")) && $v_job->status_name == "CLOSED"){
						$this->load->helper("date");
						if(mysql_to_unix($v_job->job_close_date) < time() && time() < (mysql_to_unix($v_job->job_close_date)+1800)){
							$this->Job_Model->change_status(intval($this->session->userdata("account_id")), $p_job_id, "OPEN");
							$data['error']=FALSE;
							$data['message'] = "Das Jobangebot wurde wieder geöffnet.";
						}else{
							$data['error']=TRUE;
							$data['message'] = "Das Jobangebot kann nur 30 Minuten nachdem es geschlossen wurde wieder geöffnet werden.";
						}
					}else{
						$data['error']=TRUE;
						$data['message'] = "Das Jobangebot konnte nicht geöffnet werden, da ein Fehler aufgetreten ist.";
					}
				}else{
					$data['error']=TRUE;
					$data['message'] = "Das Jobangebot kann nicht geschlossen werden, da es nicht existiert.";
				}
			}else{
				$data['error']=TRUE;
				$data['message'] = "Sie können den Status des Jobangebotes nicht ändern, da Sie nicht genügend Berechtigungen haben.";
			}			
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}		
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */