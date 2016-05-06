<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dock extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Account_Model');
		$this->load->model('Dock_Model');
		$this->lang->load("dock",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
	}

	public function index()
	{
		show_404();
	}

	public function menu(){
		$data['resource_url'] = $this->config->item('resource_url');
		if($this->session->userdata('login')){
			$account = $this->Account_Model->get_detail(intval($this->session->userdata('account_id')))->row();
		}
		$data["array_dock"]=$this->Dock_Model->get_dock(($this->session->userdata('login') == true ? $account->group_name : "Visitor" ))->result();
		$this->load->view("dock/system/menu",$data);
	}

	public function content($dock_id=""){
		if($this->session->userdata('login')){
			$account = $this->Account_Model->get_detail(intval($this->session->userdata('account_id')))->row();
		}		
		if($this->Dock_Model->get_dock(($this->session->userdata('login') == true ? $account->group_name : "Visitor" ), $dock_id)->num_rows == 1){
			$data['resource_url'] = $this->config->item('resource_url');
			$result = $this->Dock_Model->get_dock(($this->session->userdata('login') == true ? $account->group_name : "Visitor" ), $dock_id)->row();
			
			//Load Models
			if(strlen($result->dock_model)!=0){
				$models = preg_split("[,]", $result->dock_model);
				for ($i=0; $i < count($models); $i++) { 
				 	$this->load->model($models[$i]);
				}
			}
			//Load Language
			if(strlen($result->dock_language_file)!=0){
				$lang = preg_split("[,]", $result->dock_language_file);
				for ($i=0; $i < count($lang); $i++) { 
			 		$this->lang->load($lang[$i],($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
				}
			}
			//Load Library
			if(strlen($result->dock_library)!=0){
				$libraries = preg_split("[,]", $result->dock_library);
				for ($i=0; $i < count($libraries); $i++) { 
				 	$this->load->library($libraries[$i]);
				}
			}
			//Load Helper
			if(strlen($result->dock_helper)!=0){
				$helpers = preg_split("[,]", $result->dock_helper);
				for ($i=0; $i < count($helpers); $i++) { 
				 	$this->load->helper($helpers[$i]);
				}
			}	

			$this->input->set_cookie('dock',$result->dock_id,31449600);
			if($this->session->userdata('login')){
				$data['object_account']=$account;
			}
			$this->load->view("dock/".($result->dock_file==null ? "system/sorry" : $result->dock_file)."",$data);
		}else{
			$data['message']="";
			$this->load->view("plugin/system/sorry",$data);
		}		
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */