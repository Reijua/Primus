<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
	}

	public function index(){
		$this->register();
	}

	public function register(){
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Partner werden";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');

		$this->load->view('template/header',$data);
		$this->load->view('partner/register',$data);
		$this->load->view('template/footer',$data);
	}

    /* public function signin()
    {
        $data['site_name'] = $this->config->item('site_name');
        $data['site_module'] = "Anmelden";
        $data['base_url'] = $this->config->item('base_url');
        $data['resource_url'] = $this->config->item('resource_url');

        $this->load->view('template/header',$data);
		$this->load->model('partner/Account_Model');
        $this->load->view('partner/sign-in',$data);
        $this->load->view('template/footer',$data);
    } */

	
	
	/* public function package(){
		
	} */
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */