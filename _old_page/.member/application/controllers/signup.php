<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("General_Model");
		$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
		$this->lang->load("general",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));

	}

	public function index(){
		if(!$this->session->userdata('login')){
			$this->load->helper("email");

			$data['site_name'] = $this->config->item('site_name');
			$data['site_module'] = "Mitglied werden";
			$data['base_url'] = $this->config->item('base_url');
			$data['resource_url'] = $this->config->item('resource_url');
	
			$this->load->view('template/header',$data);
			if( strlen($this->input->get_post("code")) != 16 OR !valid_email($this->input->get_post("email"))){
				$this->load->view('signup/step-1',$data);
			}else{
				$this->load->view('signup/step-2',$data);
			}			
			$this->load->view('template/footer',$data);
		}else{
			show_404();
		}
		
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */