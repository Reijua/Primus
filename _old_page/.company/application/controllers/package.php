<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Account_Model");
		$this->lang->load("general",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
		$this->lang->load("template",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
	}

	public function index()
	{
		show_404();
		
	}

	public function details($name){
		$this->load->model("Package_Model");
		$data['object_package'] = $this->Package_Model->get_package($name)->row();
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = 'Paket: '.$this->lang->line('package_'.strtolower($data['object_package']->package_name));
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');
		if($this->session->userdata('login')){
			$this->lang->load("account",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$data['obj_account'] = $this->Account_Model->get_detail(intval($this->session->userdata('account_id')))->row();
		}

		$data['array_package'] = $this->Package_Model->get_package()->result();

		$this->load->view('template/header',$data);
		$this->load->view('package/package-details',$data);
		$this->load->view('template/footer',$data);

	}
}

/* End of file home.php */
/* Location: ./application/controllers/registration.php */