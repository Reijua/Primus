<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->lang->load("calendar",($this->input->cookie("language")==NULL ? $this->config->item('language') : $this->input->cookie("language")));
	}

	public function index(){
		show_404();
	}

	public function details($news_id=""){
		$this->load->model("News_Model");

		$this->load->helper("directory");

		$this->load->helper("text");

		if($this->News_Model->get_news("all", $news_id)->num_rows() == 1){
			$data['site_name'] = $this->config->item('site_name');
			$data['site_module'] = "Startseite";
			$data['base_url'] = $this->config->item('base_url');
			$data['resource_url'] = $this->config->item('resource_url');

			$data['object_news'] = $this->News_Model->get_news("all", $news_id)->row();
			$data['v_og_type'] = "website";
			$data['v_og_site_name'] = $this->config->item('site_name');
			$data['v_og_title'] = $data['object_news']->news_title;
			$data['v_og_image'] = ( (file_exists(FCPATH.'/resource/image/news/'.$data['object_news']->news_id.'.png') == true) ? $data['resource_url'].'image/news/'.$data['object_news']->news_id.'.png' : ( (file_exists(FCPATH.'/resource/image/news/'.$data['object_news']->news_id.'.jpg') == true) ? $data['resource_url'].'image/news/'.$data['object_news']->news_id.'.jpg' : '' ) );
			$data['v_og_description'] = word_limiter($data['object_news']->news_text, 40);
			$data['v_og_url'] = $this->config->item('base_url')."news/details/".$data['object_news']->news_id."/";

			$data['array_gallery'] = $this->News_Model->get_gallery($news_id)->result();

			$this->load->view('template/header',$data);
			$this->load->view('news/details',$data);
			$this->load->view('template/footer',$data);

		}else{
			show_404();
		}
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */