<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recovery extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Account_Model");
	}

	public function index()
	{
		if(!$this->session->userdata('login')){
			$data['site_name'] = $this->config->item('site_name');
			$data['site_module'] = "Anmeldedaten vergessen";
			$data['base_url'] = $this->config->item('base_url');
			$data['resource_url'] = $this->config->item('resource_url');
	
			$this->load->view('template/header',$data);
			if(strlen($this->input->get_post("code")) == 16){
				$this->load->view('recovery/code',$data);
			}else{
				$this->load->view('recovery/default',$data);
			}
			
			$this->load->view('template/footer',$data);
		}else{
			show_404();
		}
		
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */