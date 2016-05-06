<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partner extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
	}

	public function index(){
		show_404();
	}

	
	/* public function login()
	{
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Anmelden";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');
		$data['cdn_url'] = $this->config->item('cdn_url');
		
		// Laden des Models im Subdirectory
		$this->load->model('partner/P_account_model');
		
		if($this->session->userdata('login')){
			$this->lang->load("account",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$data['object_account'] = $this->P_account_model->get_account("all", intval($this->session->userdata('account_id')))->row();
		}		
		$this->load->view('template/header',$data);
		if($this->session->userdata('login'))
		{
			//Flucher:
			//Muss noch editiert werden, da die Seite nicht richtig dargestellt wird
			//Eventuell ein header(Location:) ?
			$this->load->view('home',$data);
		}
		else
		{
			if($this->input->cookie("partner_id") != NULL)
			{
				$data['object_account'] = $this->P_account_model->get_account("all", intval($this->input->cookie("account_id")))->row();
			}			
			$this->load->view('partner/login',$data);
		}
		
		$this->load->view('template/footer',$data);
	}

	public function register(){
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Partner werden";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');

		$this->load->view('template/header',$data);
		$this->load->view('partner/register',$data);
		$this->load->view('template/footer',$data);
	} */
	
	public function search() {
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Unternehmen-Verzeichnis";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');

		$this->load->model('Company_Model');
		
		$this->load->view('template/header', $data);
		$this->load->view('partner/search', $data);
		$this->load->view('template/footer', $data);
	}

    /* public function signin()
    {
        $data['site_name'] = $this->config->item('site_name');
        $data['site_module'] = "Anmelden";
        $data['base_url'] = $this->config->item('base_url');
        $data['resource_url'] = $this->config->item('resource_url');

        $this->load->view('template/header',$data);
		$this->load->model('partner/Account_Model');
        $this->load->view('partner/sign-in',$data);
        $this->load->view('template/footer',$data);
    } */

	
	
	/* public function package(){
		
	} */
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */