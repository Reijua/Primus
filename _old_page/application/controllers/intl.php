<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Intl extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Site_Model");
	}

	public function index(){
		show_404();
	}

	public function site($p_category_tag = "", $p_site_tag = ""){
			if($this->Site_Model->get_category($p_category_tag)->num_rows() == 1 && $p_category_tag != "" && $p_site_tag == ""){
				$data['site_name'] = $this->config->item('site_name');
				$data['base_url'] = $this->config->item('base_url');
				$data['resource_url'] = $this->config->item('resource_url');

				$data['object_category'] = $this->Site_Model->get_category($p_category_tag)->row();
				$data['array_site'] = $this->Site_Model->get_site("filter:category", $p_category_tag)->result();

				$data['v_og_type'] = "website";
				$data['v_og_site_name'] = $this->config->item('site_name');
				$data['v_og_title'] = $data['object_category']->category_name;
				$data['v_og_image'] = $this->Site_Model->get_banner("category", $data['resource_url'], $data['object_category']->category_id);
				$data['v_og_description'] = $data['object_category']->category_description;
				$data['v_og_url'] = $this->config->item('base_url')."site/".$data['object_category']->category_tag."/";
				

				$data['site_module'] = $data['object_category']->category_name;
				$data['site_description'] = $data['object_category']->category_description;

				$this->load->view('template/header', $data);
				$this->load->view('intl/category', $data);
				$this->load->view('template/footer', $data);

			}else if($this->Site_Model->get_site("all", $p_category_tag.":".$p_site_tag)->num_rows() == 1 && $p_category_tag != "" && $p_site_tag != ""){
				$data['site_name'] = $this->config->item('site_name');
				$data['base_url'] = $this->config->item('base_url');
				$data['resource_url'] = $this->config->item('resource_url');

				$data['object_site'] = $this->Site_Model->get_site("all", $p_category_tag.":".$p_site_tag)->row();

				$data['v_og_type'] = "website";
				$data['v_og_site_name'] = $this->config->item('site_name');
				$data['v_og_title'] = $data['object_site']->site_name;
				$data['v_og_image'] = $this->Site_Model->get_banner("site", $data['resource_url'], $data['object_site']->site_id);
				$data['v_og_description'] = $data['object_site']->site_description;
				$data['v_og_url'] = $this->config->item('base_url')."site/".$data['object_site']->category_tag."/".$data['object_site']->site_tag."/";


				$data['site_module'] = $data['object_site']->site_name;
				$data['site_description'] = $data['object_site']->site_description;

				$this->load->view('template/header',$data);
				$this->load->view('intl/site',$data);
				$this->load->view('template/footer',$data);
			}else{
				show_404();
			}	
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */