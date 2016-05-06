<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Account_Model");
		$this->load->model("Job_Model");
	}

	public function index(){
		show_404();
	}

	public function details($p_id = ""){
		if($this->session->userdata('login')){
			if($this->Job_Model->get_job("all", $p_id)->num_rows() == 1){


				$this->load->model("Partner_Model");
				$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));

				$data['site_name'] = $this->config->item('site_name');
				$data['base_url'] = $this->config->item('base_url');
				$data['resource_url'] = $this->config->item('resource_url');
				$data['cdn_url'] = $this->config->item('cdn_url');
				$data['site_module'] = "Jobangebot: ";

				$data["object_account"] = $this->Account_Model->get_account("all", $this->session->userdata('account_id'))->row();
				$data["object_job"] = $this->Job_Model->get_job("all", $p_id)->row();

				$data['site_module'] .= $data["object_job"]->job_title;
				
				$this->load->view('template/header',$data);
				$this->load->view('job/detail',$data);
				$this->load->view('template/footer',$data);

				$this->Job_Model->increase_job_view($p_id);

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