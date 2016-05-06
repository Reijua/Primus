<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bill extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata("login")){
			$this->load->model("Account_Model");
		}
	}

	public function index(){
		show_404();
	}

	function print_bill($p_bill_id = ""){
		if($this->session->userdata("login")){
			$this->load->model("Bill_Model");
			if(strlen(substr($p_bill_id, 0, 4)) == 4 &&  strlen(substr($p_bill_id, 4)) == 4 && $this->Bill_Model->get_bill(intval($this->session->userdata("account_id")), substr($p_bill_id, 0, 4), substr($p_bill_id, 4))->num_rows() == 1){
				$this->load->helper("dompdf");
				$this->load->helper("date");
				$v_account = $this->Account_Model->get_account("all", intval($this->session->userdata('account_id')))->row();
				$template_bill['resource_url'] = $this->config->item('resource_url');
				$template_bill['cdn_url'] = $this->config->item('cdn_url');
				$template_bill['company_name']=$v_account->company_name;
				$template_bill['bill_year']=substr($p_bill_id, 0, 4);
				$template_bill['bill_id']=substr($p_bill_id, 4);

				$template_bill['object_bill'] = $this->Bill_Model->get_bill($v_account->company_id, substr($p_bill_id, 0, 4), substr($p_bill_id, 4))->row();
				$v_content = $this->load->view('template/bill/default',$template_bill, true);
				create_pdf("Bill_{$p_bill_id}",$v_content,TRUE);
			}else{
				show_404();
			}
		}else{
			show_404();
		}
	}
}