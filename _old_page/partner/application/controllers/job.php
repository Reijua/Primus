<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata("login")){
			$this->load->model("Account_Model");
			$this->load->model("Job_Model");
			$this->load->model("Contact_Model");
			$this->load->model("Location_Model");
		}
	}

	public function index(){
		show_404();
	}

	function details($p_job_id = ""){
		if($this->session->userdata("login")){
			if($this->Job_Model->get_job(intval($this->session->userdata("account_id")), "all", $p_job_id)->num_rows()){
				$this->lang->load("general",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));


				$data['site_name'] = $this->config->item('site_name');
				$data['site_module'] = "Jobangebot: ";
				$data['base_url'] = $this->config->item('base_url');
				$data["resource_url"] = $this->config->item("resource_url");
				$data["cdn_url"] = $this->config->item("cdn_url");

				$data["object_account"] = $this->Account_Model->get_account("all", intval($this->session->userdata("account_id")))->row();
				$data["object_job"] = $this->Job_Model->get_job(intval($this->session->userdata("account_id")), "all", $p_job_id)->row();
				$data['site_module'] .= $data["object_job"]->job_title;
				$this->load->view("template/header", $data);
				$this->load->view("job/detail", $data);
				$this->load->view("template/footer", $data);
			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}
}