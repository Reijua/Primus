<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {
	public function __construct(){
		parent::__construct();
		/*if(!$this->input->is_ajax_request()){
			show_404();
		}*/
		if($this->session->userdata("login")){
			$this->load->model("General_Model");
			$this->load->model("Account_Model");
			$this->load->model("Contact_Model");
		}
	}

	public function index(){
		show_404();
	}

	public function create_contact(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all", intval($this->session->userdata("account_id")))->row();
			if($this->Contact_Model->get_privilege($v_account->group_id, "CREATE")->num_rows() == 1){
				$this->load->helper("email");
				$p_gender = $this->input->get_post("gender");
				$p_title = $this->input->get_post("title");
				$p_firstname = $this->input->get_post("firstname");
				$p_lastname = $this->input->get_post("lastname");
				$p_position = $this->input->get_post("position");
				$p_email = $this->input->get_post("email");
				$p_phone = $this->input->get_post("phone");
				$p_fax = $this->input->get_post("fax");
				$p_tip = $this->input->get_post("tip");

				$v_img_width = 0;
				$v_img_height = 0;

				$v_valid_image_type = array('image/png','image/jpeg','image/jpg');
				if(isset($_FILES['file']['name'])){
					list($v_img_width, $v_img_height, $v_type, $v_attr) = getimagesize($_FILES['file']['tmp_name'][0]);
				}

				if($p_gender == NULL || $this->General_Model->get_gender($p_gender)->num_rows() != 1){
					$data['error'] = TRUE;
					$data['message'] = "Bitte wählen Sie die Anrede aus.";
				}else if(empty($p_firstname)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "contact_firstname";
					$data['message'] = "Bitte geben Sie den Vornamen ein.";
				}else if(empty($p_lastname)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "contact_lastname";
					$data['message'] = "Bitte geben Sie den Nachnamen ein.";
				}else if(empty($p_email)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "contact_email";
					$data['message'] = "Bitte geben Sie die E-Mail-Adresse ein.";
				}else if(!valid_email($p_email)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "contact_email";
					$data['message'] = "Bitte geben Sie eine gültige E-Mail-Adresse an.";
				}else if(isset($_FILES['file']['name']) && count($_FILES['file']['name']) != 1){
					$data['error'] = TRUE;
					$data['message'] = "Bitte wählen Sie nur eine Datei zum Hochladen aus.";
				}else if(isset($_FILES['file']['name']) && !in_array(strtolower($_FILES['file']['type'][0]), $v_valid_image_type)){
					$data['error'] = TRUE;
					$data['message'] = "Es dürfen nur Bilder im Format .png, .jpg und .jpeg hochgeladen werden.";
				}else if(isset($_FILES['file']['name'][0]) && $v_img_width > 500){
					$data['error'] = TRUE;
					$data['message'] = "Das Bild darf nicht breiter sein als 500px.";
				}else if(isset($_FILES['file']['name'][0]) && $v_img_height > 500){
					$data['error'] = TRUE;
					$data['message'] = "Das Bild darf nicht höher sein als 500px sein.";
				}else if($v_img_height != $v_img_width){
					$data['error'] = TRUE;
					$data['message'] = "Das Bild muss quadratisch sein.";
				}else{
					$v_contact_id = $this->Contact_Model->add_contact(intval($this->session->userdata("account_id")), $p_gender, $p_title, $p_firstname, $p_lastname, $p_position, $p_email, $p_phone, $p_fax, $p_tip);
					if(isset($_FILES['file']['name'][0])){
						if (!file_exists(FCPATH."resource/image/partner/contact/".intval($this->session->userdata("account_id")))) {
							mkdir(FCPATH."resource/image/partner/contact/".intval($this->session->userdata("account_id")));
						}

						@move_uploaded_file($_FILES["file"]["tmp_name"][0], FCPATH."resource/image/partner/contact/".intval($this->session->userdata("account_id"))."/".$v_contact_id.".".strtolower(end(explode('.',$_FILES["file"]["name"][0]))));
					}
					$data['error'] = FALSE;
					$data['message'] = "Der Kontakt wurde erfolgreich hinzugefügt.";
				}
			}else{
				$data['error'] = TRUE;
				$data['message'] = "Sie haben nicht die Berechtigung, dass Sie eine Kontaktperson hinzufügen können.";
			}			
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function update_contact(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->Contact_Model->get_privilege($v_account->group_id, "UPDATE")->num_rows()==1){
				$p_id = $this->input->get_post("id");
				if($this->Contact_Model->get_contact(intval($this->session->userdata("account_id")), "all", $p_id)->num_rows()==1){
					$this->load->helper("email");
					$p_gender = $this->input->get_post("gender");
					$p_title = $this->input->get_post("title");
					$p_firstname = $this->input->get_post("firstname");
					$p_lastname = $this->input->get_post("lastname");
					$p_position = $this->input->get_post("position");
					$p_email = $this->input->get_post("email");
					$p_phone = $this->input->get_post("phone");
					$p_fax = $this->input->get_post("fax");
					$p_tip = $this->input->get_post("tip");

					$v_img_width = 0;
					$v_img_height = 0;

					$v_valid_image_type = array('image/png','image/jpeg','image/jpg');
					if(isset($_FILES['file']['name'])){
						list($v_img_width, $v_img_height, $v_type, $v_attr) = getimagesize($_FILES['file']['tmp_name'][0]);
					}

					if($p_gender == NULL || $this->General_Model->get_gender($p_gender)->num_rows() != 1){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie die Anrede aus.";
					}else if(empty($p_firstname)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "contact_firstname";
						$data['message'] = "Bitte geben Sie den Vornamen ein.";
					}else if(empty($p_lastname)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "contact_lastname";
						$data['message'] = "Bitte geben Sie den Nachnamen ein.";
					}else if(empty($p_email)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "contact_email";
						$data['message'] = "Bitte geben Sie die E-Mail-Adresse ein.";
					}else if(!valid_email($p_email)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "contact_email";
						$data['message'] = "Bitte geben Sie eine gültige E-Mail-Adresse an.";
					}else if(isset($_FILES['file']['name']) && count($_FILES['file']['name']) != 1){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie nur eine Datei zum Hochladen aus.";
					}else if(isset($_FILES['file']['name']) && !in_array(strtolower($_FILES['file']['type'][0]), $v_valid_image_type)){
						$data['error'] = TRUE;
						$data['message'] = "Es dürfen nur Bilder im Format .png, .jpg und .jpeg hochgeladen werden.";
					}else if(isset($_FILES['file']['name'][0]) && $v_img_width > 500){
						$data['error'] = TRUE;
						$data['message'] = "Das Bild darf nicht breiter sein als 500px.";
					}else if(isset($_FILES['file']['name'][0]) && $v_img_height > 500){
						$data['error'] = TRUE;
						$data['message'] = "Das Bild darf nicht höher sein als 500px sein.";
					}else if($v_img_height != $v_img_width){
						$data['error'] = TRUE;
						$data['message'] = "Das Bild muss quadratisch sein.";
					}else{
						$this->Contact_Model->update_contact(intval($this->session->userdata("account_id")), $p_id, $p_gender, $p_title, $p_firstname, $p_lastname, $p_position, $p_email, $p_phone, $p_fax, $p_tip);
						if(isset($_FILES['file']['name'][0])){
							if (!file_exists(FCPATH."resource/image/partner/contact/".intval($this->session->userdata("account_id")))) {
								mkdir(FCPATH."resource/image/partner/contact/".intval($this->session->userdata("account_id")));
							}
							
							$this->Contact_Model->delete_portrait(intval($this->session->userdata("account_id")), $p_id);
							@move_uploaded_file($_FILES["file"]["tmp_name"][0], FCPATH."resource/image/partner/contact/".intval($this->session->userdata("account_id"))."/".$p_id.".".strtolower(end(explode('.',$_FILES["file"]["name"][0]))));
						}
						$data['error'] = FALSE;
						$data['message'] = "Der Kontaktperson wurde erfolgreich bearbeitet.";
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

	public function delete_contact($p_contact_id = ""){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->Contact_Model->get_privilege($v_account->group_id, "DELETE")->num_rows()==1){
				if($this->Contact_Model->get_contact(intval($this->session->userdata("account_id")), "all", $p_contact_id)->num_rows()==1){
					$this->Contact_Model->delete_contact(intval($this->session->userdata("account_id")), $p_contact_id);
					$this->Contact_Model->delete_portrait(intval($this->session->userdata("account_id")), $p_contact_id);
					$data['error']=FALSE;
					$data['message'] = "Die Kontaktperson wurde erfolgreich gelöscht.";
				}else{
					$data['error']=TRUE;
					$data['message'] = "Die Kontaktperson kann nicht gelöscht werden, da diese nicht existiert.";
				}
			}else{
				$data['error']=TRUE;
				$data['message'] = "Sie können keine Kontakte löschen, da Sie nicht genügend Berechtigungen haben.";
			}			
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}		
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */