<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

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

	public function details($event_id)
	{
		// The sent event_id is not a positive integer
		if (!isset($event_id) || !ctype_digit($event_id) || $event_id <= 0) {
			redirect(base_url() .'event/index');
		}

		$query = $this->Event->get_event_with_id($event_id);

		// The event was found
		if ($query->num_rows() == 1) {
			$header_data = array(
				'title' => 'Primus Romulus - Event', 
			);

			$this->load->view('elements/header', $header_data);
			$this->load->view('event', $query->first_row('array'));
			$this->load->view('elements/footer');
		} else {
			redirect(base_url() .'event/index');
		}
	}

	public function participate() {
		if (!$this->session->member['logged_in']) {
			redirect(base_url() .'event/index');
		}

		$event_id = html_escape($this->input->post('event'));
		$member_id = html_escape($this->input->post('member'));

		// Ensure that a event_id is set, which is a positive integer
		if ((!isset($event_id) || !ctype_digit($event_id) || $event_id <= 0)) {
			redirect(base_url() .'event/index');
		}

		// Ensure that a member_id is set, which is a positive integer
		if ((!isset($member_id) || !ctype_digit($member_id) || $member_id <= 0)) {
			redirect(base_url() .'event/index');
		}

		// Member tries non-valid member_id
		if ($this->session->member['member_id'] != $member_id) {
			redirect(base_url() .'event/index');
		}

		// Member is already participating
		if ($this->Event->is_participant($event_id, $member_id)) {
			$this->Event->remove_participant($event_id, $member_id);
		} else {
			$this->Event->add_participant($event_id, $member_id);
		}
	}

}
