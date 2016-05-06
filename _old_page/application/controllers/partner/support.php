<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends CI_Controller {

	public function __construct(){
		parent::__construct();
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
		$this->load->model("Account_Model");

	}

	public function index(){
		if(!$this->session->userdata('login')){
			$data['site_name'] = $this->config->item('site_name');
			$data['site_module'] = "Anmeldedaten vergessen";
			$data['base_url'] = $this->config->item('base_url');
			$data['resource_url'] = $this->config->item('resource_url');
			$data['cdn_url'] = $this->config->item('cdn_url');

			$this->load->view('template/header',$data);
			$this->load->view('support/default',$data);
			$this->load->view('template/footer',$data);
		}else{
			show_404();
		}
	}

	public function recovery(){
		$this->load->helper("email");
		$p_email = html_escape($this->input->get_post("email"));
		$p_code = html_escape($this->input->get_post("code"));
		if(!$this->session->userdata('login') && !empty($p_code) && valid_email($p_email)){
			$this->load->model("Account_Model");
			if($this->Account_Model->get_code("filter:current:email", $p_email)->num_rows() == 1){
				$data['site_name'] = $this->config->item('site_name');
				$data['site_module'] = "Anmeldedaten vergessen";
				$data['base_url'] = $this->config->item('base_url');
				$data['resource_url'] = $this->config->item('resource_url');
				$data['cdn_url'] = $this->config->item('cdn_url');
		
				$this->load->view('template/header',$data);
				$this->load->view('support/recovery',$data);
				$this->load->view('template/footer',$data);
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