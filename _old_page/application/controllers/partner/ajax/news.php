<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		if($this->session->userdata("login")){
			$this->load->model("Account_Model");
			$this->load->model("News_Model");
		}
	}

	public function index(){
		show_404();
	}

	public function create_news(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->News_Model->get_privilege($v_account->group_id, "CREATE")->num_rows()==1){
				$p_title = $this->input->get_post("title");
				$p_category = $this->input->get_post("category");
				$p_plot = $this->input->get_post("text");
				$p_gallery = $this->input->get_post("gallery");

				$v_valid_image_type = array('image/png','image/jpeg','image/jpg');

				if(empty($p_title)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "news_title";
					$data['message'] = "Bitte geben Sie einen Titel ein.";
				}else if($p_category==0){
					$data['error'] = TRUE;
					$data['message'] = "Bitte wählen Sie eine Kategorie aus.";
				}else if(empty($p_plot)){
					$data['error'] = TRUE;
					$data['p_element_focus'] = "news_text";
					$data['message'] = "Bite geben Sie den Inhalt der Neuigkeit ein.";
				}else if(isset($_FILES['file']['name']) && count($_FILES['file']['name']) != 1){
					$data['error'] = TRUE;
					$data['message'] = "Bitte wählen Sie nur eine Datei zum upload aus.";
				}else if(isset($_FILES['file']['name']) && !in_array(strtolower($_FILES['file']['type'][0]), $v_valid_image_type)){
					$data['error'] = TRUE;
					$data['message'] = "Es dürfen nur PNGs und JPEGs upgeloaded werden.";
				}else{
					$v_news_id = $this->News_Model->create_news($p_title, $p_category, $p_plot);
					if(isset($p_gallery) && $p_gallery != null){
						$p_gallery = array_unique($p_gallery);
						for ($i=0; $i < count($p_gallery); $i++){
							if($p_gallery[$i] != 0){
								$this->News_Model->add_gallery($v_news_id, $p_gallery[$i]);
							}							
						}
					}
					if(isset($_FILES['file']['name'][0])){
						move_uploaded_file($_FILES["file"]["tmp_name"][0], FCPATH."../resource/image/news/".$v_news_id.".".strtolower(end(explode('.',$_FILES["file"]["name"][0]))));
					}

					$data['error'] = FALSE;
					$data['message'] = "Die Neuigkeit wurde erfolgreich erstellt.";
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

	public function update_news(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->News_Model->get_privilege($v_account->group_id, "UPDATE")->num_rows()==1){
				$p_id = $this->input->get_post("id");
				if($this->News_Model->get_news("all", $p_id)->num_rows()==1){
					$p_title = $this->input->get_post("title");
					$p_category = $this->input->get_post("category");
					$p_plot = $this->input->get_post("text");
					$p_gallery = $this->input->get_post("gallery");

					$v_valid_image_type = array('image/png','image/jpeg','image/jpg');

					if(empty($p_title)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "news_title";
						$data['message'] = "Bitte geben Sie einen Titel ein.";
					}else if($p_category==0){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie eine Kategorie aus.";
					}else if(empty($p_plot)){
						$data['error'] = TRUE;
						$data['p_element_focus'] = "news_text";
						$data['message'] = "Bite geben Sie den Inhalt der Neuigkeit ein.";
					}else if(isset($_FILES['file']['name']) && count($_FILES['file']['name']) != 1){
						$data['error'] = TRUE;
						$data['message'] = "Bitte wählen Sie nur eine Datei zum upload aus.";
					}else if(isset($_FILES['file']['name']) && !in_array(strtolower($_FILES['file']['type'][0]), $v_valid_image_type)){
						$data['error'] = TRUE;
						$data['message'] = "Es dürfen nur PNGs und JPEGs upgeloaded werden.";
					}else{
						$this->News_Model->update_news($p_id, $p_title, $p_category, $p_plot);
						
						if(isset($p_gallery) && $p_gallery != null){
							$this->News_Model->delete_gallery($p_id);
							$p_gallery = array_unique($p_gallery);
							for ($i=0; $i < count($p_gallery); $i++){
								if($p_gallery[$i] != 0){
									$this->News_Model->add_gallery($p_id, $p_gallery[$i]);
								}
							}
						}

						if(isset($_FILES['file']['name'][0])){
							move_uploaded_file($_FILES["file"]["tmp_name"][0], FCPATH."../resource/image/news/".$p_id.".".strtolower(end(explode('.',$_FILES["file"]["name"][0]))));
						}

						$data['error'] = FALSE;
						$data['message'] = "Die Neuigkeit wurde erfolgreich bearbeitet.";
					}
				}else{
					$data['error']=TRUE;
					$data['message'] = "Die Neuigkeit kann nicht bearbeitet werden, da diese Neuigkeit nicht existiert.";
				}
			}else{
				$data['error']=TRUE;
				$data['message'] = "Sie können keine Neuigkeiten bearbeiten, da Sie dazu keine Berechtigung besitzen.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function delete_news($p_news_id=""){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all",$this->session->userdata("account_id"))->row();
			if($this->News_Model->get_news("all", $p_news_id)->num_rows()==1){
				if($this->News_Model->get_privilege($v_account->group_id, "DELETE")->num_rows()==1){
					$this->News_Model->delete_news($p_news_id);
					$this->News_Model->delete_banner($p_news_id);
					$data['error']=FALSE;
					$data['message'] = "Die Neuigkeit wurde erfolgreich gelöscht.";
				}else{
					$data['error']=TRUE;
					$data['message'] = "Sie können keine Neuigkeiten löschen, da Sie dazu keine Berechtigung besitzen.";
				}				
			}else{
				$data['error']=TRUE;
				$data['message'] = "Die Neuigkeit kann nicht gelöscht werden, da diese nicht existiert.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
		
	}

	public function create_category(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all", $this->session->userdata("account_id"))->row();
			if($this->News_Model->get_privilege($v_account->group_id, "CREATE CATEGORY")->num_rows() == 1){
				$p_name = $this->input->get_post("name");
				if(empty($p_name)){
					$data["error"] = TRUE;
					$data["p_element_focus"] = "create_category_name";
					$data["message"]  = "Bitte geben Sie den Kategorienamen ein.";
				}else{
					$this->News_Model->create_category($p_name);
					$data["error"] = FALSE;
					$data["message"]  = "Die Kategorie wurde erfolgreich hinzugefügt.";
				}
			}else{
				$data["error"] = TRUE;
				$data["message"]  = "Sie haben leider keine Berechtigung um eine Kategorie zu erstellen.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function update_category(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all", $this->session->userdata("account_id"))->row();
			if($this->News_Model->get_privilege($v_account->group_id, "UPDATE CATEGORY")->num_rows() == 1){
				$p_id = $this->input->get_post("id");
				if($this->News_Model->get_category($p_id)->num_rows()==1){
					$p_name = $this->input->get_post("name");
					if(empty($p_name)){
						$data["error"] = TRUE;
						$data["p_element_focus"] = "category_name_".$p_id;
						$data["message"]  = "Bitte geben Sie den Kategorienamen ein.";
					}else{
						$this->News_Model->update_category($p_id, $p_name);
						$data["error"] = FALSE;
						$data["message"]  = "Die Kategorie wurde erfolgreich bearbeitet.";
					}
				}else{
					$data["error"] = TRUE;
					$data["message"]  = "Die Kategorie kann nicht bearbeitet werden, da sie nicht existiert.";
				}
			}else{
				$data["error"] = TRUE;
				$data["message"]  = "Sie haben leider keine Berechtigung um eine Kategorie zu bearbeiten.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function delete_category(){
		if($this->session->userdata("login")){
			$v_account = $this->Account_Model->get_account("all", $this->session->userdata("account_id"))->row();
			if($this->News_Model->get_privilege($v_account->group_id, "DELETE CATEGORY")->num_rows() == 1){
				$p_id = $this->input->get_post("id");
				if($this->News_Model->get_category("all", $p_id)->num_rows()==1){
					if($this->News_Model->get_news("filter:category", $p_id)->num_rows()==0){
						$this->News_Model->delete_category($p_id);
						$data["error"] = FALSE;
						$data["message"]  = "Die Kategorie wurde erfolgreich gelöscht.";
					}else{
						$data["error"] = TRUE;
						$data["message"]  = "Leider sind noch Neuigkeiten in dieser Kategorie.";
					}
				}else{
					$data["error"] = TRUE;
					$data["message"]  = "Die Kategorie kann nicht gelöscht werden, da sie nicht existiert.";
				}
			}else{
				$data["error"] = TRUE;
				$data["message"]  = "Sie haben leider keine Berechtigung um eine Kategorie zu löschen.";
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */