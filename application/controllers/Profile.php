<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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

	public function member($user_id)
	{
		if (!($this->session->member['logged_in'] || $this->session->partner['logged_in'])) {
			redirect(base_url() .'profile/index');
		}

		if (!isset($user_id) || !ctype_digit($user_id) || $user_id <= 0) {
			redirect(base_url() .'profile/index');
		}

		$query = $this->Member->get_member('filter:id', $user_id);

		if ($query->num_rows() == 1) {
			$header_data = array(
				'title' => 'Primus Romulus - '. lang('general_member_singular'),
			);

			$this->load->view('elements/header', $header_data);
			$this->parser->parse('template/profile/member', $query->result_array()[0]);
			$this->load->view('elements/footer');
		} else {
			redirect(base_url() .'profile/index');
		}
	}

	public function partner($user_id, $action = false)
	{
		if (!($this->session->member['logged_in'] || $this->session->partner['logged_in'])) {
			redirect(base_url() .'profile/index');
		}

		if (!isset($user_id) || !ctype_digit($user_id) || $user_id <= 0) {
			redirect(base_url() .'profile/index');
		}
		
		$query = $this->Partner->get_partner('filter:id', $user_id);
		
		$data['query'] = $query;

		if ($query->num_rows() == 1) {
			// Statistics
			if ($this->session->member['logged_in']) {
				$this->Statistics->add_profile_view($user_id);
			}

			if($action == 'about')
			{
				$header_data = array(
					'title' => 'Primus Romulus - '. lang('general_partner_singular'),
					'subpage' => 'about'
				);
				
				$this->load->view('elements/header', $header_data);
				$this->load->view('profile/partner/header', $query->result_array()[0]);
				$this->load->view('profile/partner/about', $query->result_array()[0]);
				$this->load->view('elements/footer');
			}
			else if($action == 'jobs')
			{
				$header_data = array(
					'title' => 'Primus Romulus - '. lang('general_partner_singular'),
					'subpage' => 'jobs'
				);
				
				$this->load->view('elements/header', $header_data);
				$this->load->view('profile/partner/header', $query->result_array()[0]);
				$this->load->view('profile/partner/jobs', $query->result_array()[0]);
				$this->load->view('elements/footer');
			}
			else if($action == 'contact')
			{
				$header_data = array(
					'title' => 'Primus Romulus - '. lang('general_partner_singular'),
					'subpage' => 'contact'
				);
				
				$this->load->view('elements/header', $header_data);
				$this->load->view('profile/partner/header', $query->result_array()[0]);
				$this->load->view('profile/partner/contact', $query->result_array()[0]);
				$this->load->view('elements/footer');
			}
			else if($action == 'locations')
			{
				$header_data = array(
					'title' => 'Primus Romulus - '. lang('general_partner_singular'),
					'subpage' => 'locations'
				);
				
				$this->load->view('elements/header', $header_data);
				$this->load->view('profile/partner/header', $query->result_array()[0]);
				$this->load->view('profile/partner/locations', $query->result_array()[0]);
				$this->load->view('elements/footer');
			}
			else
			{
				$header_data = array(
					'title' => 'Primus Romulus - '. lang('general_partner_singular'),
					'subpage' => 'overview'
				);

				$this->load->view('elements/header', $header_data);
				$this->load->view('profile/partner/header', $query->result_array()[0]);
				$this->load->view('profile/partner/overview', $query->result_array()[0]);
				$this->load->view('elements/footer');
			}
		} else {
			redirect(base_url() .'profile/index');
		}
	}

}
