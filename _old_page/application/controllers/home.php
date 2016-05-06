<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
	}

	public function index(){
		$this->load->helper("date");
		$this->load->helper("text");
		
		$this->load->model("News_Model");
		$this->load->model("Company_Model");
	

		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Startseite";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');
		/*
		$data['v_og_type'] = "";
		$data['v_og_site_name'] = $this->config->item('site_name');
		$data['v_og_title'] = "";
		$data['v_og_image'] = "";
		$data['v_og_description'] = "";
		$data['v_og_url'] = "";
		*/

		$data['array_news'] = $this->News_Model->get_news("latest")->result();
		$data['array_partner'] = $this->Company_Model->get_company("filter:partner")->result();

		$this->load->view('template/header',$data);

		if ($this->session->userdata('login')) {
			$this->lang->load("account",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$data['object_account'] = $this->M_account_model->get_account("all", intval($this->session->userdata('account_id')))->row();

			$this->load->model("member/M_account_model");
			$this->load->model("member/M_advertisement_model");
			$this->load->model("member/M_application_model");
			$this->load->model("member/M_feed_model");
			$this->load->model("member/M_job_model");
			$this->load->model("member/M_partner_model");

			$this->load->view('member/home', $data);
		} else {
			$this->load->view('home', $data);
		}
		
		$this->load->view('template/footer',$data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */