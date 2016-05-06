<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partner extends CI_Controller {
	public function __construct(){
		parent::__construct();
		/*if(!$this->input->is_ajax_request()){
			show_404();
		}*/
		if($this->session->userdata("login")){
			$this->load->model("Account_Model");
			$this->load->model("Partner_Model");
		}
	}

	public function index(){
		show_404();
	}

	public function create_partner(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->Partner_Model->get_privilege($v_account->group_id, "CREATE")->num_rows()==1){

				$this->load->helper("email");

				$p_name = $this->input->get_post("name");
				$p_package = $this->input->get_post("package");
				$p_email = $this->input->get_post("email");
				$p_supporter = $this->input->get_post("supporter");
				$p_comment = $this->input->get_post("comment");

				if(empty($p_name)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "partner_name";
					$data['message'] = "Bitte geben Sie den Namen ein.";
				}else if($this->Partner_Model->get_partner("filter:name", $p_name)->num_rows() == 1){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "partner_name";
					$data['p_element_reset'] = array("partner_name");
					$data['message'] = "Der eingegebene Name ist bereits Partner.";
				}else if($p_package==0){
					$data['error'] = TRUE;
					$data['message'] = "Bitte wählen Sie ein Paket aus.";
				}else if(empty($p_email)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "partner_email";
					$data['message'] = "Bitte geben Sie eine E-Mail-Adresse ein.";
				}else if(!valid_email($p_email)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "partner_email";
					$data['p_element_reset'] = array("partner_email");
					$data['message'] = "Bitte geben Sie eine gültige E-Mail-Adresse ein.";
				}else if($this->Partner_Model->get_partner("filter:email", $p_email)->num_rows() == 1){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "partner_email";
					$data['p_element_reset'] = array("partner_email");
					$data['message'] = "Diese E-Mail-Adresse ist breits in unserem System vorhanden.";
				}else if($p_supporter == 0){
					$data['error'] = TRUE;
					$data['message'] = "Bitte wählen Sie eine Kontaktperson aus.";
				}else{
					$v_partner_id = $this->Partner_Model->create_partner($p_name, $p_package, $p_email, $p_supporter, $p_comment);
					$this->Partner_Model->create_gallery_folder($v_partner_id);
					$this->Partner_Model->create_download_folder($v_partner_id);
					$data['error'] = FALSE;
					$data['message'] = "Das Partnerkonto wurde erfolgreich angelegt.";
				}
			}else{
				$data['error']=TRUE;
				$data['message'] = "Sie können keine Partnerkonten anlegen, da Sie dazu keine Berechtigung besitzen.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function update_partner(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->Partner_Model->get_privilege($v_account->group_id, "UPDATE")->num_rows()==1){
				$p_id = $this->input->get_post("id");
				if($this->Partner_Model->get_partner("all", $p_id)->num_rows() == 1){
					$this->load->helper("email");

					$p_name = $this->input->get_post("name");
					$p_package = $this->input->get_post("package");
					$p_email = $this->input->get_post("email");
					$p_supporter = $this->input->get_post("supporter");
					$p_comment = $this->input->get_post("comment");

					if(empty($p_name)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "partner_name";
						$data['message'] = "Bitte geben Sie den Namen ein.";
					}else if($p_package==0){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie ein Paket aus.";
					}else if(empty($p_email)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "partner_email";
						$data['message'] = "Bitte geben Sie eine E-Mail-Adresse ein.";
					}else if(!valid_email($p_email)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "partner_email";
						$data['p_element_reset'] = array("partner_email");
						$data['message'] = "Bitte geben Sie eine gültige E-Mail-Adresse ein.";
					}else if($p_supporter == 0){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie eine Kontaktperson aus.";
					}else{
						$this->Partner_Model->update_partner($p_id, $p_name, $p_package, $p_email, $p_supporter, $p_comment);
						$data['error'] = FALSE;
						$data['message'] = "Das Partnerkonto wurde erfolgreich bearbeitet.";
					}
				}else{
					$data['error']=TRUE;
					$data['message'] = "Das Partnerkonto kann nicht bearbeitet werden, da es nicht existiert.";
				}
			}else{
				$data['error']=TRUE;
				$data['message'] = "Sie können kein Partnerkonto bearbeiten, da Sie dazu keine Berechtigung besitzen.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */