<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plugin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Account_Model');
		$this->load->model('Plugin_Model');
		$this->lang->load("plugin",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
	}

	public function index()
	{
		show_404();
	}

	public function menu($application=""){
		$data['resource_url'] = $this->config->item('resource_url');
		if($this->session->userdata('login')){
			$account = $this->Account_Model->get_detail(intval($this->session->userdata('account_id')))->row();
		}
		$data['menu_array'] = $this->Plugin_Model->data(($this->session->userdata('login')==true ? "$account->group_name" : "Visitor" ), $application)->result();
		$this->load->view("plugin/system/menu",$data);
	}

	public function content($application="",$plugin=""){
		if($this->session->userdata('login')){
			$account = $this->Account_Model->get_detail(intval($this->session->userdata('account_id')))->row();
		}		
		if($this->Plugin_Model->data(($this->session->userdata('login') == true ? $account->group_name : "Visitor" ), $application, $plugin)->num_rows == 1){
			$data['resource_url'] = $this->config->item('resource_url');
			$result = $this->Plugin_Model->data(($this->session->userdata('login') == true ? $account->group_name : "Visitor" ), $application, $plugin)->row();
			//Load Models
			if(strlen($result->plugin_model)!=0){
				$models = preg_split("[,]", $result->plugin_model);
				for ($i=0; $i < count($models); $i++) { 
				 	$this->load->model($models[$i]);
				}
			}

			//Load Library
			if(strlen($result->plugin_library)!=0){
				$libraries = preg_split("[,]", $result->plugin_library);
				for ($i=0; $i < count($libraries); $i++) { 
				 	$this->load->library($libraries[$i]);
				}
			}
			//Load Helper
			if(strlen($result->plugin_helper)!=0){
				$helpers = preg_split("[,]", $result->plugin_helper);
				for ($i=0; $i < count($helpers); $i++) { 
				 	$this->load->helper($helpers[$i]);
				}
			}	
			if($this->session->userdata('login')){
				$data['object_account']=$account;
			}
			$this->load->view("plugin/".($result->menu_data==null ? "system/sorry" : $result->menu_data)."",$data);
		}else{
			$data['message']="";
			$this->load->view("plugin/system/sorry",$data);
		}		
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */