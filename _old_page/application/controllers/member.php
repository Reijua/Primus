<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('email');
		$this->load->helper('url');
		$this->load->model("member/M_general_model");
		$this->load->model("member/M_account_model");
		$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
		$this->lang->load("general",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
	}

	public function index(){
		show_404();
	}

    public function login(){
        $data['site_name'] = $this->config->item('site_name');
        $data['site_module'] = "Anmelden";
        $data['base_url'] = $this->config->item('base_url');
        $data['resource_url'] = $this->config->item('resource_url');

        if ($this->session->userdata('login')) {
        	redirect('/');
        }

        $this->load->view('template/header',$data);
        $this->load->view('/member/login', $data);
        $this->load->view('template/footer',$data);
    }

	public function register(){
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Mitglied werden";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');

		$this->load->view('template/header',$data);
		if( strlen($this->input->get_post("code")) != 32 OR !valid_email($this->input->get_post("email")))
		{
			$this->load->view('/member/register/step-1',$data);
		}
		else
		{
			$this->load->view('/member/register/step-2',$data);
		}	
		$this->load->view('template/footer',$data);
	}

	public function profile($p_account_id) {
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Profil";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');

		$data['account_id'] = $p_account_id;

		$this->load->view('template/header', $data);
		$this->load->view('member/profile', $data);
		$this->load->view('template/footer', $data);
	}

	public function search() {
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Absolventen-Verzeichnis";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');

		$this->load->view('template/header', $data);
		$this->load->view('member/search', $data);
		$this->load->view('template/footer', $data);
	}
	
	/* public function verify(){
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Verify E-Mail";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');
		
		$this->load->view('template/header',$data);
		if(strlen($this->input->get('code')) == 32)
		{
			$this->load->view('/member/verify',$data);
		}
		else
		{
			$this->load->view('/member/verifyFailed',$data);
		}
		$this->load->view('template/footer',$data);
	}
	
	public function step2(){
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Step2-Test";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');
		
		$this->load->view('template/header',$data);
		$this->load->view('/member/signup/step-2',$data);
		$this->load->view('template/footer',$data);
	} */

	/* public function package(){
		
	} */
}
