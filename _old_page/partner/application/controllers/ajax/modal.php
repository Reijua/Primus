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

	public function create_feedpost() {
		if ($this->session->userdata("login")) {
			$this->load->model("Feed_Model");
			$this->load->view("modal/create_feedpost");
		} else {
			show_404();
		}
	}

	public function settings(){
		$data['resource_url'] = $this->config->item('resource_url');
		$this->load->view("modal/settings",$data);
	}

	public function create_contact(){
		if($this->session->userdata("login")){
			$this->load->model("General_Model");
			$this->lang->load("general",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$data["resource_url"] = $this->config->item("resource_url");
			$this->load->view("modal/create_contact", $data);
		}else{
			show_404();
		}
	}

	public function edit_contact($p_contact_id = ""){
		if($this->session->userdata("login")){
			$this->load->model("Contact_Model");
			if($this->Contact_Model->get_contact(intval($this->session->userdata("account_id")), "all", $p_contact_id)->num_rows() == 1){
				$this->load->model("General_Model");
				$this->lang->load("general",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
				$data["resource_url"] = $this->config->item("resource_url");
				$data["object_contact"] = $this->Contact_Model->get_contact(intval($this->session->userdata("account_id")), "all", $p_contact_id)->row();
				$this->load->view("modal/edit_contact", $data);
			}else{
				show_404();
			}			
		}else{
			show_404();
		}
	}

	public function create_location(){
		if($this->session->userdata("login")){
			$this->load->model("General_Model");
			$this->load->view("modal/create_location");
		}else{
			show_404();
		}
	}

	public function edit_location($p_location_id = ""){
		if($this->session->userdata("login")){
			$this->load->model("Location_Model");
			if($this->Location_Model->get_location(intval($this->session->userdata("account_id")), "all", $p_location_id)->num_rows() == 1){
				$this->load->model("General_Model");
				$data["object_location"] = $this->Location_Model->get_location(intval($this->session->userdata("account_id")), "all", $p_location_id)->row();
				$this->load->view("modal/edit_location", $data);
			}else{
				show_404();
			}			
		}else{
			show_404();
		}
	}

	public function create_job(){
		if($this->session->userdata("login")){
			$this->load->model("Job_Model");
			$this->load->model("Location_Model");
			$this->load->model("Contact_Model");
			$this->load->view("modal/create_job");
		}else{
			show_404();
		}
	}

	public function edit_job($p_job_id = ""){
		if($this->session->userdata("login")){
			$this->load->model("Job_Model");
			if($this->Job_Model->get_job(intval($this->session->userdata("account_id")), "all", $p_job_id)->num_rows() == 1){
				$this->load->model("Location_Model");
				$this->load->model("Contact_Model");
				$data["object_job"] = $this->Job_Model->get_job(intval($this->session->userdata("account_id")), "all", $p_job_id)->row();
				$this->load->view("modal/edit_job", $data);
			}else{
				show_404();
			}			
		}else{
			show_404();
		}
	}

	public function create_advertisement(){
		if($this->session->userdata("login")){
			$this->load->model("General_Model");
			$this->load->model("Advertisement_Model");
			$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$this->load->view("modal/create_advertisement");
		}else{
			show_404();
		}
	}

	public function edit_advertisement($p_advertisement_id){
		if($this->session->userdata("login")){
			$this->load->model("Advertisement_Model");
			if($this->Advertisement_Model->get_advertisement(intval($this->session->userdata("account_id")), "all", $p_advertisement_id)->num_rows() == 1){
				$this->load->model("General_Model");
				$this->load->helper("date");
				$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
				$data["resource_url"] = $this->config->item("resource_url");
				$data["object_advertisement"] = $this->Advertisement_Model->get_advertisement(intval($this->session->userdata("account_id")), "all", $p_advertisement_id)->row();
				$this->load->view("modal/edit_advertisement", $data);
			}else{
				show();
			}			
		}else{
			show_404();
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */