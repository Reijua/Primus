<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multimedia extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Multimedia_Model");
	}

	public function index()
	{
		show_404();
	}

	public function add_video(){
		if($this->session->userdata('login')){
			$title = $this->input->get_post("title");
			$provider = $this->input->get_post("provider");
			$url = $this->input->get_post("url");

			if(empty($title)){
				$data['error']=TRUE;
				$data['p_element_focus']="video_title";
				$data['message']='Bitte geben Sie einen Titel für das Video ein.';
			}else if($provider==0){
				$data['error']=TRUE;
				$data['message']='Bitte wählen Sie einen Anbieter aus.';
			}else if(empty($url)){
				$data['error']=TRUE;
				$data['p_element_focus']="video_url";
				$data['message']='Bitte geben Sie die URL ein.';
			}else if($provider == 1 && !strpos($url, 'youtube') || $provider == 2 && !strpos($url, 'vimeo')){
				$data['error']=TRUE;
				$data['message']='Die URL stimmt nicht mit dem Anbieter überein.';
			}else{
				$this->Multimedia_Model->add_video($this->session->userdata('account_id'), $title, $url, $provider);
				$data['error']=FALSE;
				$data['message']='Das Video wurde erfolgreich hinzugefügt.';
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
		
	}



	public function delete_video(){
		if($this->session->userdata('login')){
			$video_id = $this->input->get_post('id');
			if($this->Multimedia_Model->get_video($this->session->userdata('account_id'),$video_id)->num_rows()==1){
				$this->Multimedia_Model->delete_video($this->session->userdata('account_id'),$video_id);
				$data['error']=FALSE;
				$data['message']='Das Video wurde erfolgreich gelöscht.';
			}else{
				$data['error']=TRUE;
				$data['message']='Das Video kann nicht gelöscht werden, da ein Fehler aufgetreten ist.';
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}

	public function add_photo(){
		if(isset($_FILES['file']['type'][0])){
					$type = $_FILES['file']['type'][0];
					$content = file_get_contents($_FILES['file']['tmp_name'][0]);
					$portrait = 'data:'.$type.';base64,' . base64_encode($content);
				}else{
					$portrait = "";
				}
	}

	public function delete_photo(){
		if($this->session->userdata('login')){
			$photo_id = $this->input->get_post('id');
			if($this->Multimedia_Model->get_photo($this->session->userdata('account_id'),$photo_id)->num_rows()==1){
				$this->Multimedia_Model->delete_photo($this->session->userdata('account_id'),$photo_id);
				$data['error']=FALSE;
				$data['message']='Das Foto wurde erfolgreich gelöscht.';
			}else{
				$data['error']=TRUE;
				$data['message']='Das Foto kann nicht gelöscht werden, da ein Fehler aufgetreten ist.';
			}
			$this->load->view("plugin/system/form_response",$data);
		}else{
			show_404();
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */