<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Application extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->input->is_ajax_request()){
			show_404();
		}
		$this->load->helper('text');
		$this->load->model('Account_Model');
		$this->load->model('Application_Model');
	}

	public function index(){
		show_404();
	}

	public function get_content($category_name = "", $application_id = ""){
		if($this->session->userdata('login')){
			$object_account = $this->Account_Model->get_account("all", intval($this->session->userdata('account_id')))->row();
			if($category_name == "" OR $application_id == ""){
				$category_name = $this->input->cookie("application-category") != NULL ? $this->input->cookie("application-category") : $this->config->item("application-category");
				$application_id = $this->input->cookie("application-id") != NULL ? $this->input->cookie("application-id") : $this->config->item("application-id") ;
			}
			if($this->Application_Model->get_application($object_account->group_id, $category_name, $application_id)->num_rows()==1){
				$data["cdn_url"] = $this->config->item("cdn_url");
				$data["resource_url"] = $this->config->item("resource_url");

				$this->input->set_cookie("application-category", $category_name, 31104000);
				$this->input->set_cookie("application-id", $application_id, 31104000);

				$v_application = $this->Application_Model->get_application($object_account->group_id, $category_name, $application_id)->row();
				foreach ($this->Application_Model->get_library($v_application->category_id, $v_application->application_id)->result() as $row) {
					$this->load->library($row->library_name);
				}

				foreach ($this->Application_Model->get_model($v_application->category_id, $v_application->application_id)->result() as $row) {
					$this->load->model($row->model_name);
				}

				foreach ($this->Application_Model->get_helper($v_application->category_id, $v_application->application_id)->result() as $row) {
					$this->load->helper($row->helper_name);
				}

				foreach ($this->Application_Model->get_language_file($v_application->category_id, $v_application->application_id)->result() as $row) {
					$this->load->language($row->file_name, ($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
				}

				$this->load->view("application/".strtolower($v_application->category_name)."/".$v_application->application_file."",$data);
			}else{
				$this->load->view("application/system/sorry");
			}
		}else{
			show_404();
		}
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */

/* End of file home.php */
/* Location: ./application/controllers/home.php */