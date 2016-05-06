<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->agent->is_browser("Internet Explorer") || $this->agent->is_browser("IE") && $this->agent->version() > 9){
			redirect("http://primus-romulus.net/");
		}else if($this->agent->is_browser("Safari") && $this->agent->version() > 6){
			redirect("http://primus-romulus.net/");
		}else if($this->agent->is_browser("Chrome") && $this->agent->version() > 30){
			redirect("http://primus-romulus.net/");
		}else if($this->agent->is_browser("Firefox") && $this->agent->version() > 30){
			redirect("http://primus-romulus.net/");
		}else if($this->agent->is_browser("Opera") && $this->agent->version() > 20){
			redirect("http://primus-romulus.net/");
		}
	}

	public function index(){
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Browser veraltet";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');

		echo $this->agent->version();
		$this->load->view('template/header',$data);
		$this->load->view('home',$data);
		$this->load->view('template/footer',$data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */