<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modal extends CI_Controller {
	public function __construct(){
		parent::__construct();
		/*if(!$this->input->is_ajax_request()){
			show_404();
		}*/
	}

	public function index(){
		show_404();
	}

	public function settings(){
		$data['resource_url'] = $this->config->item('resource_url');
		$this->load->view("modal/settings",$data);
	}

	public function create_news(){
		if($this->session->userdata("login")){
			$this->load->model("Gallery_Model");
			$this->load->model("News_Model");
			$data['resource_url'] = $this->config->item('resource_url');
			$this->load->view("modal/create_news",$data);
		}else{
			show_404();
		}
	}

	public function edit_news($p_news_id = ""){
		if($this->session->userdata("login")){
			$this->load->model("News_Model");
			if($this->News_Model->get_news("all", $p_news_id)->num_rows() == 1){
				$this->load->model("Gallery_Model");
				$data["cdn_url"] = $this->config->item("cdn_url");
				$data["object_news"] = $this->News_Model->get_news("all", $p_news_id)->row();
				$this->load->view("modal/edit_news", $data);
			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}

	public function manage_news_category(){
		if($this->session->userdata("login")){
			$this->load->model("News_Model");
			$this->load->view("modal/manage_news_category");
		}else{
			show_404();
		}
	}

	public function create_gallery(){
		$data['cdn_url'] = $this->config->item('cdn_url');
		$this->load->view("modal/create_gallery",$data);
	}

	public function edit_gallery($gallery_id = ""){
		if($this->session->userdata("login")){
			$data['cdn_url'] = $this->config->item('cdn_url');

			$this->load->model("Gallery_Model");
			if($this->Gallery_Model->get_gallery($gallery_id)->num_rows() == 1){
				$data['object_gallery'] = $this->Gallery_Model->get_gallery($gallery_id)->row();
				$this->load->view("modal/edit_gallery",$data);
			}else{
				show_404();
			}
		}else{
			show_404();
		}	
	}

	public function create_event(){
		if($this->session->userdata("login")){
			$this->load->model("Account_Model");
			$this->load->model("General_Model");
			$this->load->model("Gallery_Model");
			$this->load->model("Event_Model");

			$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$data['cdn_url'] = $this->config->item('cdn_url');
			$this->load->view("modal/create_event",$data);
		}else{
			show_404();
		}
	}

	public function edit_event($p_event_id = ""){
		if($this->session->userdata("login")){
			$this->load->model("Event_Model");
			if($this->Event_Model->get_event($p_event_id)->num_rows()==1){
				$this->load->model("Account_Model");
				$this->load->model("General_Model");
				$this->load->model("Gallery_Model");
				$this->load->helper("date");
				$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
				$data['cdn_url'] = $this->config->item('cdn_url');
				$data['object_event'] = $this->Event_Model->get_event($p_event_id)->row();
				$this->load->view("modal/edit_event",$data);
			}else{
				show_404();
			}			
		}else{
			show_404();
		}
	}

	public function edit_member($p_member_id = ""){
		if($this->session->userdata("login")){
			$this->load->model("Account_Model");
			if($this->Account_Model->get_account("all", $p_member_id)->num_rows() == 1){
				$this->load->model("Member_Model");
				$this->load->model("General_Model");

				$this->load->helper("date");

				$this->lang->load("general",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
				$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
				$this->lang->load("account",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));

				$data["array_salutation"] = $this->General_Model->get_gender()->result();
				$data["object_member"] = $this->Account_Model->get_account("all", $p_member_id)->row();
				$data["array_group"] = $this->Account_Model->get_group()->result();
				$data["array_class"] = $this->Member_Model->get_class()->result();
				$this->load->view("modal/edit_member", $data);
			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}

	public function lock_member($p_member_id){
		if($this->session->userdata("login")){
			$this->load->model("Account_Model");
			if($this->Account_Model->get_account("all", $p_member_id)->num_rows() == 1){
				$this->load->model("Member_Model");
				$this->load->helper("date");
				$data["array_lock_history"] = $this->Member_Model->get_blocking("all", $p_member_id)->result();
				$this->load->view("modal/lock_member", $data);
			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}

	public function create_partner(){
		if($this->session->userdata("login")){
			$this->load->model("Account_Model");
			$this->load->model("Partner_Model");
			$this->load->view("modal/create_partner");
		}else{
			show_404();
		}
	}

	public function edit_partner($p_id){
		if($this->session->userdata("login")){
			$this->load->model("Partner_Model");
			if($this->Partner_Model->get_partner("all", $p_id)->num_rows() == 1){
				$this->load->model("Account_Model");
				$data["object_partner"] = $this->Partner_Model->get_partner("all", $p_id)->row();
				$this->load->view("modal/edit_partner", $data);
			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}

	public function create_bill(){
		if($this->session->userdata("login")){
			$this->load->model("Bill_Model");
			$this->load->model("Partner_Model");
			$this->load->view("modal/create_bill");
		}else{
			show_404();
		}
	}

	public function edit_bill($p_id){
		if($this->session->userdata("login")){
			$this->load->model("Bill_Model");
			if(strlen(substr($p_id, 0, 4)) == 4 &&  strlen(substr($p_id, 4)) == 4 && $this->Bill_Model->get_bill(intval($this->session->userdata("account_id")),substr($p_id, 0, 4), substr($p_id, 4))->num_rows() == 1){
				$this->load->model("Partner_Model");
				$data["object_bill"] = $this->Bill_Model->get_bill(substr($p_id, 0, 4), substr($p_id, 4))->row();
				$this->load->view("modal/edit_bill", $data);
			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */