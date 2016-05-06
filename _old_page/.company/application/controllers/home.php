<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Account_Model");
		$this->lang->load("general",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
		$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
		$this->lang->load("template",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
	}

	public function index()
	{
		$this->load->model("Package_Model");
		$this->load->model("Company_Model");
		$data['site_name'] = $this->config->item('site_name');
		$data['site_module'] = "Startseite";
		$data['base_url'] = $this->config->item('base_url');
		$data['resource_url'] = $this->config->item('resource_url');
		if($this->session->userdata('login')){
			$this->lang->load("account",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
			$data['obj_account'] = $this->Account_Model->get_detail(intval($this->session->userdata('account_id')))->row();
		}else{
			$data['array_package'] = $this->Package_Model->get_package()->result();
			$data['array_company'] = $this->Company_Model->get_company('platinum')->result();
		}

		

		$this->load->view('template/header',$data);
		$this->load->view('home',$data);
		$this->load->view('template/footer',$data);
	}

	public function test(){
		header("Content-type:image/png");
		$newwidth=400;
		$newheight=200;
		list($width, $height) = getimagesize('http://pr.home/resource/image/logo.png');
	    if($width > $height && $newheight < $height){
	        $newheight = $height / ($width / $newwidth);
	    } else if ($width < $height && $newwidth < $width) {
	        $newwidth = $width / ($height / $newheight);    
	    } else {
	        $newwidth = $width;
	        $newheight = $height;
	    }
	    $thumb = imagecreatetruecolor(400, 200);
	    $source = imagecreatefrompng('http://pr.home/resource/image/logo.png');
	    imagesavealpha($source, true);
	    imagecolorallocate($source, 255,255,255);
	    imagecopyresized($thumb, $source, 100, 0, 0, 0, 200, 200, $width, $height);
	    imagepng($thumb);

	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */