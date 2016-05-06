<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recovery extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Account_Model");
		$this->lang->load("general",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
		$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
		$this->lang->load("template",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
	}

	public function index()
	{
		$this->load->model("Package_Model");
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Anmeldedaten zurücksetzen";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');

		$data['array_package'] = $this->Package_Model->get_package()->result();

		$this->load->view('template/header',$data);
		$this->load->view('recovery',$data);		
		$this->load->view('template/footer',$data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/registration.php */