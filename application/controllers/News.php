<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if (($language = get_cookie('language')) != NULL && in_array($language, $this->config->item('supported_languages'))) {
			load_language($language);
		}
	}

	public function index()
	{
		redirect(base_url());
	}

	public function details($news_id)
	{
		// The sent news_id is not a positive integer
		if (!isset($news_id) || !ctype_digit($news_id) || $news_id <= 0) {
			redirect(base_url() .'news/index');
		}

		$query = $this->News->get_news('filter:id', $news_id);

		// The news was found
		if ($query->num_rows() == 1) {
			$header_data = array(
				'title' => 'Primus Romulus - News', 
			);

			$this->load->view('elements/header', $header_data);
			$this->load->view('news', $query->first_row('array'));
			$this->load->view('elements/footer');
		} else {
			redirect(base_url() .'news/index');
		}
	}

}
