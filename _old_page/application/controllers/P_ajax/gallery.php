<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->load->model("Gallery_Model");
		if($this->session->userdata("login")){
			$this->load->model("Account_Model");
		}
	}

	public function index(){
		show_404();
	}

	public function create_gallery(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->Gallery_Model->get_privilege($v_account->group_id, "CREATE")->num_rows()==1){
				$name = $this->input->get_post("name");
				$description = $this->input->get_post("description");
				if(empty($name)){
					$data['error']=FALSE;
					$data['p_element_focus']="gallery_name";
					$data['message'] = "Bitte geben Sie die Bezeichnung ein.";
				}else if(empty($description)){
					$data['error']=FALSE;
					$data['p_element_focus']="gallery_description";
					$data['message'] = "Bitte geben Sie die Beschreibung ein.";
				}else if(!isset($_FILES['file']['name'])){
					$data['error']=TRUE;
					$data['message'] = "Bitte wählen Sie mindestens eine Datei aus.";
				}else{
					$p_name = $this->input->get_post("name");
					$p_description = $this->input->get_post("description");
					$v_gallery_id = $this->Gallery_Model->create_gallery($p_name, $p_description);
					mkdir(FCPATH.'../resource/image/gallery/'.$v_gallery_id.'/', 0700);

					$v_valid_image_type = array('image/png','image/jpeg','image/jpg');

					for ($i = 0 ;$i < count($_FILES['file']['name']); $i++) {
						if(in_array(strtolower($_FILES['file']['type'][$i]), $v_valid_image_type)){
							move_uploaded_file($_FILES["file"]["tmp_name"][$i], FCPATH."../resource/image/gallery/".$v_gallery_id."/".$_FILES["file"]["name"][$i]);
						}						
					}
					$data['error']=FALSE;
					$data['message'] = "Die Gallerie wurde erfolgreich erstellt.";
				}				
			}else{
				$data['error']=TRUE;
				$data['message'] = "Sie können keine Neuigkeiten hinzufügen, da Sie dazu keine Berechtigung besitzen.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function update_gallery(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->Gallery_Model->get_privilege($v_account->group_id, "UPDATE")->num_rows()==1){
				$p_id = $this->input->get_post("id");
				$p_name = $this->input->get_post("name");
				$p_description = $this->input->get_post("description");

				if(empty($p_name)){
					$data['error']=FALSE;
					$data['p_element_focus']="gallery_name";
					$data['message'] = "Bitte geben Sie die Bezeichnung ein.";
				}else if(empty($p_description)){
					$data['error']=FALSE;
					$data['p_element_focus']="gallery_description";
					$data['message'] = "Bitte geben Sie die Beschreibung ein.";
				}else if($this->Gallery_Model->get_gallery($p_id)->num_rows() == 0){
					$data['error']=FALSE;
					$data['message'] = "Diese Gallerie existiert nicht.";
				}else{
					$v_gallery = $this->Gallery_Model->get_gallery($p_id)->row();
					$this->Gallery_Model->update_gallery($p_id, $p_name, $p_description);
					if(isset($_FILES['file']['name'])){
						$this->load->helper("file");
						$v_valid_image_type = array('image/png','image/jpeg','image/jpg');
						delete_files(FCPATH.'../resource/image/gallery/'.$p_id.'/', true);
						for ($i = 0 ;$i < count($_FILES['file']['name']); $i++) {
							if(in_array(strtolower($_FILES['file']['type'][$i]), $v_valid_image_type)){
								move_uploaded_file($_FILES["file"]["tmp_name"][$i], FCPATH."../resource/image/gallery/".$v_gallery->gallery_id."/".$_FILES["file"]["name"][$i]);
							}						
						}
					}
					$data['error']=FALSE;
					$data['message'] = "Die Gallery wurde erfolgreich bearbeitet.";
				}
			}else{
				$data['error']=TRUE;
				$data['message'] = "Sie können keine Gallerie bearbeiten, da Sie dazu keine Berechtigung besitzen.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function delete_gallery($p_gallery_id=""){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->Gallery_Model->get_privilege($v_account->group_id, "DELETE")->num_rows()==1){
				if($this->Gallery_Model->get_gallery($p_gallery_id)->num_rows()==1){
					$this->load->helper("file");
					$this->Gallery_Model->delete_gallery($p_gallery_id);
					delete_files(FCPATH.'../resource/image/gallery/'.$p_gallery_id.'/', true);
					rmdir(FCPATH.'../resource/image/gallery/'.$p_gallery_id.'/');
					$data['error']=FALSE;
					$data['message'] = "Die Gallerie wurde erfolgreich gelöscht.";
				}else{
					$data['error']=TRUE;
					$data['message'] = "Die Gallerie kann nicht gelöscht werden, da diese nicht existiert.";
				}
			}else{
				$data['error']=TRUE;
				$data['message'] = "Sie können keine Gallerie löschen, da Sie keine Berechtigung dazu besitzen.";
			}			
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */