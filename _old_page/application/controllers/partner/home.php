<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
				$this->load->library('user_agent');
				$this->load->library('session');
		if(!$this->session->userdata('login')){
			if($this->agent->is_browser("Internet Explorer") && $this->agent->version() < 10 || $this->agent->is_browser("IE") && $this->agent->version() < 10){
				redirect("http://nosupport.primus-romulus.net/");
			}else if($this->agent->is_browser("Safari") && $this->agent->version() < 6){
				redirect("http://nosupport.primus-romulus.net/");
			}else if($this->agent->is_browser("Chrome") && $this->agent->version() < 30){
				redirect("http://nosupport.primus-romulus.net/");
			}else if($this->agent->is_browser("Firefox") && $this->agent->version() < 23){
				redirect("http://nosupport.primus-romulus.net/");
			}else if($this->agent->is_browser("Opera") && $this->agent->version() < 20){
				redirect("http://nosupport.primus-romulus.net/");
			}
		}else{
			$this->load->model("partner/P_application_model");
		}
		
		$this->load->model("partner/P_account_model");
	}

	public function index(){
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Anmelden";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');
		$data['cdn_url'] = $this->config->item('cdn_url');
		if($this->session->userdata('login')){
			$this->lang->load("account",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$data['object_account'] = $this->P_account_model->get_account("all", intval($this->session->userdata('account_id')))->row();
		}		
		$this->load->view('template/header',$data);
		if($this->session->userdata('login')){
			$this->load->view('partner/home',$data);
		}else{
			if($this->input->cookie("partner_id") != NULL){
				$data['object_account'] = $this->P_account_model->get_account("all", intval($this->input->cookie("account_id")))->row();
			}			
			$this->load->view('partner/login',$data);
		}
		
		$this->load->view('template/footer',$data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */