<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advertisement extends CI_Controller {
	public function __construct(){
		parent::__construct();
		/*if(!$this->input->is_ajax_request()){
			show_404();
		}*/
		if($this->session->userdata("login")){
			$this->load->model("General_Model");
			$this->load->model("Account_Model");
			$this->load->model("Advertisement_Model");
		}
	}

	public function index(){
		show_404();
	}

	public function create_advertisement(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all", intval($this->session->userdata("account_id")))->row();
			if($this->Advertisement_Model->get_privilege($v_account->group_id, "CREATE")->num_rows() == 1){
				$p_name = $this->input->get_post("name");
				$p_start_date_day = $this->input->get_post("start_date_day");
				$p_start_date_month = $this->input->get_post("start_date_month");
				$p_start_date_year = $this->input->get_post("start_date_year");
				$p_end_date_day = $this->input->get_post("end_date_day");
				$p_end_date_month = $this->input->get_post("end_date_month");
				$p_end_date_year = $this->input->get_post("end_date_year");
				$p_description = $this->input->get_post("description");
				$p_link = $this->input->get_post("link");

				if(empty($p_name)){
					$data['error'] = TRUE;
					$data['p_element_focus']="advertisement_name";
					$data['message'] = "Bitte geben Sie den Titel der Werbung an.";
				}else if(empty($p_start_date_day)){
					$data['error'] = TRUE;
					$data['p_element_focus']="advertisement_start_date_day";
					$data['message']= "Bitte geben Sie den Tag ein.";
				}else if(!is_int(intval($p_start_date_day)) || !is_numeric($p_start_date_day) || $p_start_date_day > 31 ||  $p_start_date_day < 1 || strlen(intval($p_start_date_day)) > 2){
					$data['error'] = TRUE;
					$data['p_element_reset']=array("advertisement_start_date_day");
					$data['p_element_focus']="advertisement_start_date_day";
					$data['message']= "Der Tag wurde nicht richtig eingegeben. Achten Sie darauf, das die Zahl zwischen 1 und 31 ist.";
				}else if($p_start_date_month == NULL || $this->General_Model->get_month($p_start_date_month)->num_rows() == 0){
					$data['error'] = TRUE;
					$data['message']= "Bitte wählen Sie das Monat aus.";
				}else if(empty($p_start_date_year)){
					$data['error'] = TRUE;
					$data['p_element_focus']="advertisement_start_date_year";
					$data['message']= "Bitte geben Sie das Jahr ein.";
				}else if(!is_int(intval($p_start_date_year)) || !is_numeric($p_start_date_year) || strlen(intval($p_start_date_year)) != 4){
					$data['error'] = TRUE;
					$data['p_element_focus']="advertisement_start_date_year";
					$data['p_element_reset']=array("advertisement_start_date_year");
					$data['message']= "Das Jahr wurde nicht richtig eingegeben. Achten Sie darauf, vier Ziffern zu verwenden.";
				}else if(!checkdate($p_start_date_month, $p_start_date_day, $p_start_date_year)){
					$data['error'] = TRUE;
					$data['p_element_reset']=array("advertisement_start_date_day", "advertisement_start_date_year");
					if($p_start_date_day >= 29 && $p_start_date_month == 2){
						$data['message']= "Der Februar hatte nur 28 Tage im Jahr {$p_start_date_year}.";
					}else if($p_start_date_day >= 30 && $p_start_date_month == 4|| $p_start_date_month == 6 || $p_start_date_month == 9 || $p_start_date_month == 11){
						$data['message']= "Dieses Monat hat nur 30 Tage.";
					}else{
						$data['message']= "Das Datum ist ungültig.";
					}
				}else if(empty($p_end_date_day)){
					$data['error'] = TRUE;
					$data['p_element_focus']="advertisement_end_date_day";
					$data['message']= "Bitte geben Sie den Tag ein.";
				}else if(!is_int(intval($p_end_date_day)) || !is_numeric($p_end_date_day) || $p_end_date_day > 31 ||  $p_end_date_day < 1 || strlen(intval($p_end_date_day)) > 2){
					$data['error'] = TRUE;
					$data['p_element_reset']=array("advertisement_end_date_day");
					$data['p_element_focus']="advertisement_end_date_day";
					$data['message']= "Der Tag wurde nicht richtig eingegeben. Achten Sie darauf, das die Zahl zwischen 1 und 31 ist.";
				}else if($p_end_date_month == NULL || $this->General_Model->get_month($p_start_date_month)->num_rows() == 0){
					$data['error'] = TRUE;
					$data['message']= "Bitte wählen Sie das Monat aus.";
				}else if(empty($p_end_date_year)){
					$data['error'] = TRUE;
					$data['p_element_focus']="advertisement_end_date_year";
					$data['message']= "Bitte geben Sie das Jahr ein.";
				}else if(!is_int(intval($p_end_date_year)) || !is_numeric($p_end_date_year) || strlen(intval($p_end_date_year)) != 4){
					$data['error'] = TRUE;
					$data['p_element_focus']="advertisement_end_date_year";
					$data['p_element_reset']=array("advertisement_end_date_year");
					$data['message']= "Das Jahr wurde nicht richtig eingegeben. Achten Sie darauf, vier Ziffern zu verwenden.";
				}else if(!checkdate($p_end_date_month, $p_end_date_day, $p_end_date_year)){
					$data['error'] = TRUE;
					$data['p_element_reset']=array("advertisement_end_date_day", "advertisement_end_date_year");
					if($p_end_date_day >= 29 && $p_end_date_month == 2){
						$data['message']= "Der Februar hatte nur 28 Tage im Jahr {$p_end_date_year}.";
					}else if($p_end_date_day >= 30 && $p_end_date_month == 4|| $p_end_date_month == 6 || $p_end_date_month == 9 || $p_end_date_month == 11){
						$data['message']= "Dieses Monat hat nur 30 Tage.";
					}else{
						$data['message']= "Das Datum ist ungültig.";
					}
				}else if(mktime(0,0,0,$p_end_date_month, $p_end_date_day, $p_end_date_year) < mktime(0,0,0,$p_start_date_month, $p_start_date_day, $p_start_date_year)){
					$data['error'] = TRUE;
					$data['message']="Die Werbeanzeige kann nicht früher enden als diese startet.";
				}else if(empty($p_description)){
					$data['error'] = TRUE;
					$data['p_element_focus']="advertisement_description";
					$data['message'] = "Bitte geben Sie den Werbetext ein.";
				}else if($this->Advertisement_Model->get_advertisement(intval($this->session->userdata("account_id")), "filter:date", $p_start_date_year."-".$p_start_date_month."-".$p_start_date_day)->num_rows() == 1 || $this->Advertisement_Model->get_advertisement(intval($this->session->userdata("account_id")), "filter:date", $p_end_date_year."-".$p_end_date_month."-".$p_end_date_day)->num_rows() == 1){
					$data['error'] = TRUE;
					$data['message'] = "In diesem Zeitraum läuft schon eine Werbeanzeige.";
				}else{
					$v_start_date = $p_start_date_year."-".$p_start_date_month."-".$p_start_date_day;
					$v_end_date = $p_end_date_year."-".$p_end_date_month."-".$p_end_date_day;
					$v_advertisement_id = $this->Advertisement_Model->create_advertisement($p_name, $p_description, $v_start_date, $v_end_date, $p_link, intval($this->session->userdata("account_id")));
					if(isset($_FILES['file']['name'][0])){
						move_uploaded_file($_FILES["file"]["tmp_name"][0], FCPATH."resource/image/advertisement/".$v_advertisement_id.".".strtolower(end(explode('.',$_FILES["file"]["name"][0]))));
					}
					$data['error'] = FALSE;
					$data['message'] = "Die Werbung wurde erfolgreich hinzugefügt.";
				}
			}else{
				$data['error'] = TRUE;
				$data['message'] = "Sie haben nicht die Berechtigung, dass Sie eine Werbeeinschaltung erstellen können.";
			}			
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function update_advertisement(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->Advertisement_Model->get_privilege($v_account->group_id, "UPDATE")->num_rows()==1){
				$p_id = $this->input->get_post("id");
				if($this->Advertisement_Model->get_advertisement(intval($this->session->userdata("account_id")), "all", $p_id)->num_rows()==1){
					$p_name = $this->input->get_post("name");
					$p_start_date_day = $this->input->get_post("start_date_day");
					$p_start_date_month = $this->input->get_post("start_date_month");
					$p_start_date_year = $this->input->get_post("start_date_year");
					$p_end_date_day = $this->input->get_post("end_date_day");
					$p_end_date_month = $this->input->get_post("end_date_month");
					$p_end_date_year = $this->input->get_post("end_date_year");
					$p_description = $this->input->get_post("description");
					$p_link = $this->input->get_post("link");

					if(empty($p_name)){
						$data['error'] = TRUE;
						$data['p_element_focus']="advertisement_name";
						$data['message'] = "Bitte geben Sie den Titel der Werbung an.";
					}else if(empty($p_start_date_day)){
						$data['error'] = TRUE;
						$data['p_element_focus']="advertisement_start_date_day";
						$data['message']= "Bitte geben Sie den Tag ein.";
					}else if(!is_int(intval($p_start_date_day)) || !is_numeric($p_start_date_day) || $p_start_date_day > 31 ||  $p_start_date_day < 1 || strlen(intval($p_start_date_day)) > 2){
						$data['error'] = TRUE;
						$data['p_element_reset']=array("advertisement_start_date_day");
						$data['p_element_focus']="advertisement_start_date_day";
						$data['message']= "Der Tag wurde nicht richtig eingegeben. Achten Sie darauf, das die Zahl zwischen 1 und 31 ist.";
					}else if($p_start_date_month == NULL || $this->General_Model->get_month($p_start_date_month)->num_rows() == 0){
						$data['error'] = TRUE;
						$data['message']= "Bitte wählen Sie das Monat aus.";
					}else if(empty($p_start_date_year)){
						$data['error'] = TRUE;
						$data['p_element_focus']="advertisement_start_date_year";
						$data['message']= "Bitte geben Sie das Jahr ein.";
					}else if(!is_int(intval($p_start_date_year)) || !is_numeric($p_start_date_year) || strlen(intval($p_start_date_year)) != 4){
						$data['error'] = TRUE;
						$data['p_element_focus']="advertisement_start_date_year";
						$data['p_element_reset']=array("advertisement_start_date_year");
						$data['message']= "Das Jahr wurde nicht richtig eingegeben. Achten Sie darauf, vier Ziffern zu verwenden.";
					}else if(!checkdate($p_start_date_month, $p_start_date_day, $p_start_date_year)){
						$data['error'] = TRUE;
						$data['p_element_reset']=array("advertisement_start_date_day", "advertisement_start_date_year");
						if($p_start_date_day >= 29 && $p_start_date_month == 2){
							$data['message']= "Der Februar hatte nur 28 Tage im Jahr {$p_start_date_year}.";
						}else if($p_start_date_day >= 30 && $p_start_date_month == 4|| $p_start_date_month == 6 || $p_start_date_month == 9 || $p_start_date_month == 11){
							$data['message']= "Dieses Monat hat nur 30 Tage.";
						}else{
							$data['message']= "Das Datum ist ungültig.";
						}
					}else if(empty($p_end_date_day)){
						$data['error'] = TRUE;
						$data['p_element_focus']="advertisement_end_date_day";
						$data['message']= "Bitte geben Sie den Tag ein.";
					}else if(!is_int(intval($p_end_date_day)) || !is_numeric($p_end_date_day) || $p_end_date_day > 31 ||  $p_end_date_day < 1 || strlen(intval($p_end_date_day)) > 2){
						$data['error'] = TRUE;
						$data['p_element_reset']=array("advertisement_end_date_day");
						$data['p_element_focus']="advertisement_end_date_day";
						$data['message']= "Der Tag wurde nicht richtig eingegeben. Achten Sie darauf, das die Zahl zwischen 1 und 31 ist.";
					}else if($p_end_date_month == NULL || $this->General_Model->get_month($p_start_date_month)->num_rows() == 0){
						$data['error'] = TRUE;
						$data['message']= "Bitte wählen Sie das Monat aus.";
					}else if(empty($p_end_date_year)){
						$data['error'] = TRUE;
						$data['p_element_focus']="advertisement_end_date_year";
						$data['message']= "Bitte geben Sie das Jahr ein.";
					}else if(!is_int(intval($p_end_date_year)) || !is_numeric($p_end_date_year) || strlen(intval($p_end_date_year)) != 4){
						$data['error'] = TRUE;
						$data['p_element_focus']="advertisement_end_date_year";
						$data['p_element_reset']=array("advertisement_end_date_year");
						$data['message']= "Das Jahr wurde nicht richtig eingegeben. Achten Sie darauf, vier Ziffern zu verwenden.";
					}else if(!checkdate($p_end_date_month, $p_end_date_day, $p_end_date_year)){
						$data['error'] = TRUE;
						$data['p_element_reset']=array("advertisement_end_date_day", "advertisement_end_date_year");
						if($p_end_date_day >= 29 && $p_end_date_month == 2){
							$data['message']= "Der Februar hatte nur 28 Tage im Jahr {$p_end_date_year}.";
						}else if($p_end_date_day >= 30 && $p_end_date_month == 4|| $p_end_date_month == 6 || $p_end_date_month == 9 || $p_end_date_month == 11){
							$data['message']= "Dieses Monat hat nur 30 Tage.";
						}else{
							$data['message']= "Das Datum ist ungültig.";
						}
					}else if(mktime(0,0,0,$p_end_date_month, $p_end_date_day, $p_end_date_year) < mktime(0,0,0,$p_start_date_month, $p_start_date_day, $p_start_date_year)){
						$data['error'] = TRUE;
						$data['message']="Die Werbeanzeige kann nicht enden bevor es begonnen hat.";
					}else if(empty($p_description)){
						$data['error'] = TRUE;
						$data['p_element_focus']="advertisement_description";
						$data['message'] = "Bitte geben Sie den Werbetext ein.";
					}else if($this->Advertisement_Model->get_advertisement(intval($this->session->userdata("account_id")), "filter:date:$p_id", $p_start_date_year."-".$p_start_date_month."-".$p_start_date_day)->num_rows() == 1 || $this->Advertisement_Model->get_advertisement(intval($this->session->userdata("account_id")), "filter:date:$p_id", $p_end_date_year."-".$p_end_date_month."-".$p_end_date_day)->num_rows() == 1){
						$data['error'] = TRUE;
						$data['message'] = "In diesem Zeitraum läuft schon eine Werbeanzeige.";
					}else{
						$v_start_date = $p_start_date_year."-".$p_start_date_month."-".$p_start_date_day;
						$v_end_date = $p_end_date_year."-".$p_end_date_month."-".$p_end_date_day;
						$this->Advertisement_Model->update_advertisement(intval($this->session->userdata("account_id")), $p_id, $p_name, $p_description, $v_start_date, $v_end_date, $p_link);
						if(isset($_FILES['file']['name'][0])){
							move_uploaded_file($_FILES["file"]["tmp_name"][0], FCPATH."resource/image/advertisement/".$p_id.".".strtolower(end(explode('.',$_FILES["file"]["name"][0]))));
						}
						$data['error'] = FALSE;
						$data['message'] = "Die Werbung wurde erfolgreich bearbeitet.";
					}
				}else{
					$data['error']=TRUE;
					$data['message'] = "Die Kontaktperson kann nicht bearbeitet werden, da diese nicht existiert.";
				}
			}else{
				$data['error']=TRUE;
				$data['message'] = "Sie können keine Kontaktperson bearbeiten, da Sie dazu keine Berechtigung besitzen.";
			}
			$this->load->view("plugin/system/form_response", $data);
		}else{
			show_404();
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */