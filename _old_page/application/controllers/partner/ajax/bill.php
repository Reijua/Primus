<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bill extends CI_Controller {

	public function __construct(){
		parent::__construct();
		/*if(!$this->input->is_ajax_request()){
			show_404();
		}*/
		$this->load->model('Account_Model');
		$this->load->model('Bill_Model');
		$this->load->model('Partner_Model');
	}

	public function index(){
		show_404();
	}

	public function create_bill(){
		if($this->session->userdata('login')){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->Bill_Model->get_privilege($v_account->group_id, "CREATE")->num_rows()==1){
				$p_company_id = html_escape($this->input->get_post("partner"));
				$p_status_id = html_escape($this->input->get_post("status"));
				$p_address = html_escape($this->input->get_post("address"));
				$p_pc = html_escape($this->input->get_post("pc"));
				$p_city = html_escape($this->input->get_post("city"));
				$p_item_text = html_escape($this->input->get_post("item_text"));
				$p_item_price = html_escape($this->input->get_post("item_price"));
				if($p_company_id == 0){
					$data['error'] = TRUE;
					$data['message'] = "Bitte wählen Sie die Firma aus.";
				}else if($p_status_id == 0){
					$data['error'] = TRUE;
					$data['message'] = "Bitte wählen Sie den Status der Rechnung aus.";
				}else if(empty($p_address)){
					$data['error'] = TRUE;
					$data['p_element_focus']="bill_address";
					$data['message'] = "Bitte geben Sie die Adresse ein.";
				}else if(empty($p_pc)){
					$data['error'] = TRUE;
					$data['p_element_focus']="bill_pc";
					$data['message'] = "Bitte geben Sie die PLZ ein.";
				}else if(empty($p_city)){
					$data['error'] = TRUE;
					$data['p_element_focus']="bill_city";
					$data['message'] = "Bitte geben Sie den Ort ein.";
				}else{
					$v_bill_id = $this->Bill_Model->create_bill($p_company_id, $p_status_id, $p_address, $p_pc, $p_city);
					for ($i=0; $i < count($p_item_text); $i++) {
						if(trim($p_item_text[$i]) != ""){
							$this->Bill_Model->add_item(intval(date("Y")), $v_bill_id, $p_item_text[$i], $p_item_price[$i]);
						}						
					}					
					$data['error'] = FALSE;
					$data['message'] = "Die Rechnung wurde erfolgreich angelegt.";
				}
				$this->load->view("plugin/system/form_response", $data);
			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}

	public function update_bill(){
		if($this->session->userdata('login')){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->Bill_Model->get_privilege($v_account->group_id, "UPDATE")->num_rows()==1){
				$p_bill_year = $this->input->get_post("year");
				$p_bill_id = $this->input->get_post("id");
				if($this->Bill_Model->get_bill($p_bill_year, $p_bill_id)->num_rows() == 1){
					$p_company_id = html_escape($this->input->get_post("partner"));
					$p_status_id = html_escape($this->input->get_post("status"));
					$p_address = html_escape($this->input->get_post("address"));
					$p_pc = html_escape($this->input->get_post("pc"));
					$p_city = html_escape($this->input->get_post("city"));
					$p_item_text = html_escape($this->input->get_post("item_text"));
					$p_item_price = html_escape($this->input->get_post("item_price"));
					if($p_company_id == 0){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie den Partner aus.";
					}else if($p_status_id == 0){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie den Status der Rechnung aus.";
					}else if(empty($p_address)){
						$data['error'] = TRUE;
						$data['p_element_focus']="bill_address";
						$data['message'] = "Bitte geben Sie die Adresse ein.";
					}else if(empty($p_pc)){
						$data['error'] = TRUE;
						$data['p_element_focus']="bill_pc";
						$data['message'] = "Bitte geben Sie die PLZ ein.";
					}else if(empty($p_city)){
						$data['error'] = TRUE;
						$data['p_element_focus']="bill_city";
						$data['message'] = "Bitte geben Sie den Ort ein.";
					}else{
						$this->Bill_Model->update_bill($p_bill_year, $p_bill_id, $p_company_id, $p_status_id, $p_address, $p_pc, $p_city);
						$this->Bill_Model->delete_item($p_bill_year, $p_bill_id);
						for ($i=0; $i < count($p_item_text); $i++) {
							if(trim($p_item_text[$i]) != ""){
								$this->Bill_Model->add_item($p_bill_year, $p_bill_id, $p_item_text[$i], $p_item_price[$i]);
							}						
						}					
						$data['error'] = FALSE;
						$data['message'] = "Die Rechnung wurde erfolgreich angelegt.";
					}
					$this->load->view("plugin/system/form_response", $data);
				}else{
					show_404();
				}
			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}
}