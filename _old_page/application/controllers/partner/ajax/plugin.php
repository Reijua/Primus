<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plugin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		/*if(!$this->input->is_ajax_request()){
			show_404();
		}*/
		$this->load->model('Account_Model');
		$this->load->model('Plugin_Model');
		$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
		$this->lang->load("plugin",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
	}

	public function index()
	{
		show_404();
	}

	public function menu($application=""){
		$data['resource_url'] = $this->config->item('resource_url');
		if($this->session->userdata('login')){
			$account = $this->Account_Model->get_account("all", intval($this->session->userdata('account_id')))->row();
		}
		$data['menu_array'] = $this->Plugin_Model->data(($this->session->userdata('login')==true ? $account->group_name : "Visitor" ), $application)->result();
		$this->load->view("plugin/system/menu",$data);
	}

	public function content($plugin = "", $menu = ""){
		if($this->session->userdata('login')){
			$account = $this->Account_Model->get_account("all", intval($this->session->userdata('account_id')))->row();
		}		
		if($this->Plugin_Model->data(($this->session->userdata('login') == true ? $account->group_name : "Visitor" ), $plugin, $menu)->num_rows == 1){
			$data['resource_url'] = $this->config->item('resource_url');
			$data['cdn_url'] = $this->config->item('cdn_url');
			$result = $this->Plugin_Model->data(($this->session->userdata('login') == true ? $account->group_name : "Visitor" ), $plugin, $menu)->row();
			
			foreach ($this->Plugin_Model->get_model($plugin, $menu)->result() as $row) {
				$this->load->model($row->model_name);
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