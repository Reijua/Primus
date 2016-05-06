<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imprint extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if (($language = get_cookie('language')) != NULL && in_array($language, $this->config->item('supported_languages'))) {
			load_language($language);
		}
	}

	public function index()
	{
		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_header_imprint'), 
			'page' => 'imprint',
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('imprint');
		$this->load->view('elements/footer');
	}

}
