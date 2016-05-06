<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Über uns";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');

		$this->load->view("template/header", $data);
		$this->load->view("about", $data);
		$this->load->view("template/footer", $data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */