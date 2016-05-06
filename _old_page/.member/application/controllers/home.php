<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Account_Model");
		$this->load->model("Application_Model");

		$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
	}

	public function index(){
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Plattform";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');
		if($this->session->userdata('login')){
			$this->lang->load("account",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$data['object_account'] = $this->Account_Model->get_account("all", intval($this->session->userdata('account_id')))->row();
		}		
		$this->load->view('template/header',$data);
		if($this->session->userdata('login')){
			$this->load->view('home',$data);
		}else{
			if($this->input->cookie("account_id") != NULL){
				$data['object_account'] = $this->Account_Model->get_account("all", intval($this->input->cookie("account_id")))->row();
			}			
			$this->load->view('sign-in',$data);
		}
		
		$this->load->view('template/footer',$data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */