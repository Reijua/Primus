<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modal extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
	}

	public function index()
	{
		show_404();
	}

	public function settings(){
		$data['resource_url'] = $this->config->item('resource_url');		
		$this->load->view("modal/settings",$data);
	}

	public function add_video(){
		$this->load->model("Multimedia_Model");

		$data['resource_url'] = $this->config->item('resource_url');
		$data['array_provider'] = $this->Multimedia_Model->get_provider()->result();	
		$this->load->view("modal/add_video",$data);
	}

	public function add_photo(){
		if($this->session->userdata('login')){
			$data['resource_url'] = $this->config->item('resource_url');
			$this->load->view("modal/add_photo",$data);
		}else{
			show_404();
		}
	}

	public function add_contact(){
		if($this->session->userdata('login')){
			$this->lang->load("general",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$this->load->model("General_Model");
			$this->load->model("Account_Model");
			$data['resource_url'] = $this->config->item('resource_url');
			$data['array_gender'] = $this->General_Model->get_gender()->result();
			$this->load->view("modal/add_contact",$data);
		}else{
			show_404();
		}
	}

	public function edit_contact($id=""){
		if($this->session->userdata('login')){
			$this->lang->load("general",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$this->load->model("General_Model");
			$this->load->model("Account_Model");
			if($this->Account_Model->get_contact($this->session->userdata('account_id'),$id)->num_rows()==1){
				$data['resource_url'] = $this->config->item('resource_url');
				$data['array_gender'] = $this->General_Model->get_gender()->result();
				$data['object_contact'] = $this->Account_Model->get_contact($this->session->userdata('account_id'),$id)->row();
				$this->load->view("modal/edit_contact",$data);
			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}

	public function add_location(){
		if($this->session->userdata('login')){
			$this->lang->load("general",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$this->load->model("General_Model");
			$data['array_country'] = $this->General_Model->get_country()->result();
			$this->load->view("modal/add_location",$data);
		}else{
			show_404();
		}
	}

	public function edit_location($id=""){
		if($this->session->userdata('login')){
			$this->lang->load("general",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$this->load->model("General_Model");
			$this->load->model("Account_Model");
			if($this->Account_Model->get_location($this->session->userdata('account_id'),$id)->num_rows()==1){
				$data['array_country'] = $this->General_Model->get_country()->result();
				$data['object_location'] = $this->Account_Model->get_location($this->session->userdata('account_id'),$id)->row();
				$this->load->view("modal/edit_location",$data);
			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}

	public function add_job(){
		if($this->session->userdata('login')){
			$this->lang->load("job",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$this->load->model("Job_Model");
			$this->load->model("Account_Model");
			$data['resource_url'] = $this->config->item('resource_url');
			$this->load->view("modal/add_job",$data);
		}else{
			show_404();
		}
	}

	public function edit_job($id){
		if($this->session->userdata('login')){
			$this->load->model("Job_Model");
			if($this->Job_Model->get_job("all", $this->session->userdata('account_id'), $id)->num_rows()==1){
				$this->lang->load("job", ($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
				$this->load->model("Account_Model");
				$data['resource_url'] = $this->config->item('resource_url');
				$data['object_job'] = $this->Job_Model->get_job("all", $this->session->userdata('account_id'), $id)->row();
				$this->load->view("modal/edit_job",$data);
			}else{
				show_404();
			}			
		}else{
			show_404();
		}
	}

	public function add_product(){
		$this->load->model("Product_Model");
		$this->lang->load("product", ($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
				
		$data['resource_url'] = $this->config->item('resource_url');
		$data['array_currency'] = $this->Product_Model->get_currency()->result();
		$data['array_interval'] = $this->Product_Model->get_interval()->result();
		$this->load->view("modal/add_product",$data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */