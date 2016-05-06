<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location extends CI_Controller {
	public function __construct(){
		parent::__construct();
		/*if(!$this->input->is_ajax_request()){
			show_404();
		}*/
		if($this->session->userdata("login")){
			$this->load->model("General_Model");
			$this->load->model("Account_Model");
			$this->load->model("Location_Model");
		}
	}

	public function index(){
		show_404();
	}

	public function create_location(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all", intval($this->session->userdata("account_id")))->row();
			if($this->Location_Model->get_privilege($v_account->group_id, "CREATE")->num_rows() == 1){
				$p_name = $this->input->get_post("name");
				$p_address = $this->input->get_post("address");
				$p_pc = $this->input->get_post("pc");
				$p_city = $this->input->get_post("city");
				$p_country = $this->input->get_post("country");

				if(empty($p_name)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "location_name";
					$data['message'] = "Bitte geben Sie die Bezeichnung ein.";
				}else if(empty($p_address)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "location_address";
					$data['message'] = "Bitte geben Sie die Adresse ein.";
				}else if(empty($p_pc)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "location_pc";
					$data['message'] = "Bitte geben Sie die PLZ ein.";
				}else if(empty($p_city)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "location_city";
					$data['message'] = "Bitte geben Sie den Ort ein.";
				}else if($p_country == NULL || $this->General_Model->get_country($p_country)->num_rows() != 1){
					$data['error'] = TRUE;
					$data['message'] = "Bitte wählen Sie das Land aus.";
				}else{
					$this->Location_Model->add_location(intval($this->session->userdata("account_id")), $p_name, $p_address, $p_pc, $p_city, $p_country);
					$data['error'] = FALSE;
					$data['message'] = "Der Standort wurde erfolgreich hinzugefügt.";
				}
			}else{
				$data['error'] = TRUE;
				$data['message'] = "Sie haben nicht die Berechtigung, dass Sie einen Standort hinzufügen können.";
			}			
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function update_location(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->Location_Model->get_privilege($v_account->group_id, "UPDATE")->num_rows()==1){
				$p_id = $this->input->get_post("id");
				if($this->Location_Model->get_location(intval($this->session->userdata("account_id")), "all", $p_id)->num_rows()==1){
					$p_name = $this->input->get_post("name");
					$p_address = $this->input->get_post("address");
					$p_pc = $this->input->get_post("pc");
					$p_city = $this->input->get_post("city");
					$p_country = $this->input->get_post("country");

					if(empty($p_name)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "location_name";
						$data['message'] = "Bitte geben Sie die Bezeichnung ein.";
					}else if(empty($p_address)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "location_address";
						$data['message'] = "Bitte geben Sie die Adresse ein.";
					}else if(empty($p_pc)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "location_pc";
						$data['message'] = "Bitte geben Sie die PLZ ein.";
					}else if(empty($p_city)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "location_city";
						$data['message'] = "Bitte geben Sie den Ort ein.";
					}else if($p_country == NULL || $this->General_Model->get_country($p_country)->num_rows() != 1){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie das Land aus.";
					}else{
						$this->Location_Model->update_location(intval($this->session->userdata("account_id")), $p_id, $p_name, $p_address, $p_pc, $p_city, $p_country);
						$data['error'] = FALSE;
						$data['message'] = "Der Standort wurde erfolgreich bearbeitet.";
					}
				}else{
					$data['error']=TRUE;
					$data['message'] = "Der Standort kann nicht bearbeitet werden, da dieser nicht existiert.";
				}
			}else{
				$data['error']=TRUE;
				$data['message'] = "Sie können keine Standorte bearbeiten, da Sie dazu keine Berechtigung besitzen.";
			}
			$this->load->view("plugin/system/form_response", $data);
		}else{
			show_404();
		}
	}

	public function delete_location($p_location_id = ""){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all", $this->session->userdata("account_id"))->row();
			if($this->Location_Model->get_privilege($v_account->group_id, "DELETE")->num_rows()==1){
				if($this->Location_Model->get_location(intval($this->session->userdata("account_id")), "all", $p_location_id)->num_rows()==1){
					$this->Location_Model->delete_location(intval($this->session->userdata("account_id")), $p_location_id);
					$data['error']=FALSE;
					$data['message'] = "Der Standort wurde erfolgreich gelöscht.";
				}else{
					$data['error']=TRUE;
					$data['message'] = "Der Standort kann nicht gelöscht werden, da dieser nicht existiert.";
				}
			}else{
				$data['error']=TRUE;
				$data['message'] = "Sie können keinen Standort löschen, da Sie nicht genügend Berechtigungen haben.";
			}			
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}		
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */