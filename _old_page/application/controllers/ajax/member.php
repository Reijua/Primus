<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('member/M_account_model');
	}

	public function index(){
		show_404();
	}

	public function get_member_with_name() {
		$name = $this->input->get_post("filter_name");
		$company = $this->input->get_post("filter_company");
		$class = $this->input->get_post("filter_class");
		
		if (!empty($name)) {
			$data['members'] = $this->M_account_model->get_account("filter:name", $name)->result();
			$data['ajax_request'] = TRUE;
			$this->load->view("member/search-result", $data);
		} else if (!empty($company)) {
			$data['members'] = $this->M_account_model->get_account("filter:company", $company)->result();
			$data['ajax_request'] = TRUE;
			$this->load->view("member/search-result", $data);
		} else if (!empty($class)) {
			$data['members'] = $this->M_account_model->get_account("filter:class", $class)->result();
			$data['ajax_request'] = TRUE;
			$this->load->view("member/search-result", $data);
		}
	}
}