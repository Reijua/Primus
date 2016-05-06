<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Policies extends CI_Controller {

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

	public function terms()
	{
		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_footer_terms'),
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('policies/terms');
		$this->load->view('elements/footer');
	}

	public function privacy()
	{
		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_footer_privacy'),
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('policies/privacy');
		$this->load->view('elements/footer');
	}

	public function cookies()
	{
		$header_data = array(
			'title' => 'Primus Romulus - '. lang('elements_footer_cookies'),
		);

		$this->load->view('elements/header', $header_data);
		$this->load->view('policies/cookies');
		$this->load->view('elements/footer');
	}

}
