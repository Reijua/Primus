<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Account_Model');
		$this->load->model('Event_Model');
		if(!$this->input->is_ajax_request()){
			show_404();
		}
	}

	public function index(){
		show_404();
	}

	public function create_event(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all", $this->session->userdata("account_id"))->row();
			if($this->Event_Model->get_privileg($v_account->group_id, "CREATE")->num_rows() == 1){
				$name = $this->input->get_post("name");
				$leader = $this->input->get_post("leader");
				$type = $this->input->get_post("type");
				$amount = $this->input->get_post("amount");
				$day = $day = $this->input->get_post("day");
				$month = $this->input->get_post("month");
				$year = $this->input->get_post("year");
				$hour =  $this->input->get_post("hour");
				$minute =  $this->input->get_post("minute");
				$address =  $this->input->get_post("address");
				$pc =  $this->input->get_post("pc");
				$city =  $this->input->get_post("city");
				$description = $this->input->get_post("description");

				if(empty($name)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "event_name";
					$data['message'] = "Bitte geben Sie den Namen des Events ein.";
				}else if($leader==0){
					$data['error'] = TRUE;
					$data['message'] = "Bitte wählen Sie eine Kontaktperson für das Event aus.";
				}else if($type==0){
					$data['error'] = TRUE;
					$data['message'] = "Bitte wählen Sie den Typen des Events aus.";
				}else if(empty($day)){
		        	$data['error'] = TRUE;
		        	$data['p_element_focus']="event_day";
		        	$data['message']= "Bitte geben Sie den Tag des Events ein.";
		        }else if(!is_int(intval($day)) || !is_numeric($day) || $day > 31 ||  $day < 1 || strlen(intval($day)) > 2){
		        	$data['error'] = TRUE;
		        	$data['p_element_reset']=array("event_day");
		        	$data['p_element_focus']="event_day";
		        	$data['message']= "Der Tag wurde nicht richtig eingegeben. Achten Sie darauf, das die Zahl zwischen 1 und 31 ist.";
		        }else if($month==0){
		        	$data['error'] = TRUE;
					$data['message']= "Bitte wählen Sie den Monat des Events aus.";
		        }else if(empty($year)){
		        	$data['error'] = TRUE;
		        	$data['p_element_focus']="event_year";
		        	$data['message']= "Bitte geben Sie das Jahr des Events ein.";
		        }else if(!is_int(intval($year)) || !is_numeric($year) || strlen(intval($year)) != 4){
		        	$data['error'] = TRUE;
		        	$data['p_element_focus']="event_year";
		        	$data['p_element_reset']=array("event_year");
		        	$data['message']= "Das Jahr wurde nicht richtig eingegeben. Achten Sie darauf, vier Ziffern zu verwenden.";
		        }else if(!checkdate($month, $day, $year)){
		        	$data['error'] = TRUE;
		        	$data['p_element_reset']=array("event_day", "event_year");
		        	if($day >= 29 && $month == 2){
		        		$data['message']= "Der Februar hatte nur 28 Tage im Jahr {$birthday_year}.";
		        	}else if($day >= 30 && $month == 4|| $month == 6 || $month == 9 || $month == 11){
		        		$data['message']= "Dieses Monat hat nur 30 Tage.";
		        	}else{
		        		$data['message']= "Das Geburtsdatum ist ungültig.";
		        	}	        	
		        }else if(empty($hour) || $hour < 0 || $hour > 23){
		        	$data['error'] = TRUE;
					$data['p_element_focus'] = "event_hour";
					$data['message'] = "Bitte geben Sie eine Zahl zwischen 0 und 23 ein.";
		        }else if(empty($minute) || $minute < 0 || $minute > 59){
		        	$data['error'] = TRUE;
					$data['p_element_focus'] = "event_minute";
					$data['message'] = "Bitte geben Sie eine Zahl zwischen 0 und 59 ein.";
		        }else if(empty($amount)){
		        	$data['error'] = TRUE;
					$data['p_element_focus'] = "event_amount";
					$data['message'] = "Bitte geben Sie die maximale Anzahl an Teilnehmer an.";
		        }else if(empty($address)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "event_address";
					$data['message'] = "Bitte geben Sie die Adresse ein.";
				}else if(empty($pc)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "event_pc";
					$data['message'] = "Bitte geben Sie die PLZ ein.";
				}else if(empty($city)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "event_city";
					$data['message'] = "Bitte geben Sie den Ort ein.";
				}else{
					$date = $year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':00';
					$this->Event_Model->create_event($name, $description, $date, $address, $pc, $city, $leader, $type, $amount);
					$data['error'] = FALSE;
					$data['message'] = "Das Event wurde erfolgreich erstellt.";
				}
			}else{
				$data['error'] = TRUE;
				$data['message'] = "Sie können kein Event löschen, da Sie keine Berechtigung haben.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function update_event(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all", $this->session->userdata("account_id"))->row();
			if($this->Event_Model->get_privileg($v_account->group_id, "UPDATE")->num_rows() == 1){
				$id = $this->input->get_post("id");
				if($this->Event_Model->get_event($id)->num_rows() == 1){
					$name = $this->input->get_post("name");
					$leader = $this->input->get_post("leader");
					$type = $this->input->get_post("type");
					$amount = $this->input->get_post("amount");
					$day = $day = $this->input->get_post("day");
					$month = $this->input->get_post("month");
					$year = $this->input->get_post("year");
					$hour =  $this->input->get_post("hour");
					$minute =  $this->input->get_post("minute");
					$address =  $this->input->get_post("address");
					$pc =  $this->input->get_post("pc");
					$city =  $this->input->get_post("city");
					$description = $this->input->get_post("description");
					if(empty($name)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "event_name";
						$data['message'] = "Bitte geben Sie den Namen des Events ein.";
					}else if($leader==0){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie eine Kontaktperson für das Event aus.";
					}else if($type==0){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie den Typen des Events aus.";
					}else if(empty($day)){
			        	$data['error'] = TRUE;
			        	$data['p_element_focus']="event_day";
			        	$data['message']= "Bitte geben Sie den Tag des Events ein.";
			        }else if(!is_int(intval($day)) || !is_numeric($day) || $day > 31 ||  $day < 1 || strlen(intval($day)) > 2){
			        	$data['error'] = TRUE;
			        	$data['p_element_reset']=array("event_day");
			        	$data['p_element_focus']="event_day";
			        	$data['message']= "Der Tag wurde nicht richtig eingegeben. Achten Sie darauf, das die Zahl zwischen 1 und 31 ist.";
			        }else if($month==0){
			        	$data['error'] = TRUE;
						$data['message']= "Bitte wählen Sie den Monat des Events aus.";
			        }else if(empty($year)){
			        	$data['error'] = TRUE;
			        	$data['p_element_focus']="event_year";
			        	$data['message']= "Bitte geben Sie das Jahr des Events ein.";
			        }else if(!is_int(intval($year)) || !is_numeric($year) || strlen(intval($year)) != 4){
			        	$data['error'] = TRUE;
			        	$data['p_element_focus']="event_year";
			        	$data['p_element_reset']=array("event_year");
			        	$data['message']= "Das Jahr wurde nicht richtig eingegeben. Achten Sie darauf, vier Ziffern zu verwenden.";
			        }else if(!checkdate($month, $day, $year)){
			        	$data['error'] = TRUE;
			        	$data['p_element_reset']=array("event_day", "event_year");
			        	if($day >= 29 && $month == 2){
			        		$data['message']= "Der Februar hatte nur 28 Tage im Jahr {$birthday_year}.";
			        	}else if($day >= 30 && $month == 4|| $month == 6 || $month == 9 || $month == 11){
			        		$data['message']= "Dieses Monat hat nur 30 Tage.";
			        	}else{
			        		$data['message']= "Das Geburtsdatum ist ungültig.";
			        	}	        	
			        }else if(empty($hour) || $hour < 0 || $hour > 23){
			        	$data['error'] = TRUE;
						$data['p_element_focus'] = "event_hour";
						$data['message'] = "Bitte geben Sie eine Zahl zwischen 0 und 23 ein.";
			        }else if(empty($minute) || $minute < 0 || $minute > 59){
			        	$data['error'] = TRUE;
						$data['p_element_focus'] = "event_minute";
						$data['message'] = "Bitte geben Sie eine Zahl zwischen 0 und 59 ein.";
			        }else if(empty($amount) || !is_int(intval($amount)) || !is_numeric($amount) ){
			        	$data['error'] = TRUE;
						$data['p_element_focus'] = "event_amount";
						$data['message'] = "Bitte geben Sie die maximale Anzahl an Teilnehmer an.";
			        }else if(empty($address)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "event_address";
						$data['message'] = "Bitte geben Sie die Adresse ein.";
					}else if(empty($pc)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "event_pc";
						$data['message'] = "Bitte geben Sie die PLZ ein.";
					}else if(empty($city)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "event_city";
						$data['message'] = "Bitte geben Sie den Ort ein.";
					}else{
						$date = $year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':00';
						$this->Event_Model->update_event($id, $name, $description, $date, $address, $pc, $city, $leader, $type, $amount);
						$data['error'] = FALSE;
						$data['message'] = "Das Event wurde erfolgreich bearbeitet.";
					}
				}else{
					$data['error'] = TRUE;
					$data['message'] = "Das Event kann nicht bearbeitet werden, da es nicht existiert.";
				}
			}else{
				$data['error'] = TRUE;
				$data['message'] = "Sie können kein Event bearbeiten, da Sie keine Berechtigung haben.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function delete_event($p_event_id = ""){
		if($this->session->userdata("login") && $p_event_id != ""){
			$v_account = $this->Account_Model->get_account("all", $this->session->userdata("account_id"))->row();
			if($this->Event_Model->get_privileg($v_account->group_id, "DELETE")->num_rows() == 1){
				if( $this->Event_Model->get_event($p_event_id)->num_rows() == 1 ){
					$this->Event_Model->delete_event($p_event_id);
					$data['error'] = FALSE;
					$data['message'] = "Das Event wurde erfolgreich gelöscht.";
				}else{
					$data['error'] = TRUE;
					$data['message'] = "Das Event kann nicht gelöscht werden, da es nicht existiert.";
				}
			}else{
				$data['error'] = TRUE;
				$data['message'] = "Sie können kein Event löschen, da Sie keine Berechtigung haben.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */