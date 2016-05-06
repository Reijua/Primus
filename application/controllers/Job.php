<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends CI_Controller {

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

	public function search()
	{
		if (!($this->session->member['logged_in'] || $this->session->partner['logged_in'])) {
			redirect(base_url() .'job/index');
		}

		if (!$this->session->member['logged_in'] || $this->input->post('form') == NULL) {
			redirect(base_url() .'job/index');
		}

		// Term entered
		$term = trim($this->input->post('term'));

		// Array of selected sectors
		$sectors = $this->input->post('sectors');

		// Array of selected job types
		$types = $this->input->post('types');

		// Determine the filters
		$filter_term = !empty($term);
		$filter_sector = !empty($sectors);
		$filter_type = !empty($types);

		$query = $this->Job->get_job('all');

		// No jobs were found
		if ($query->num_rows() == 0) {
			$data = array(
				'error' => 'Derzeit gibt es keine Jobangebote.',
			);

			header('Content-Type: application/json');
			echo json_encode($data);

			return;
		}

		$response = '';

		// No search-criteria was sent -> show all jobs
		if (!$filter_term && !$filter_sector && !$filter_type) {
			foreach ($query->result() as $i => $job) {
				// Skip jobs which are closed
				if ($job->job_open == 0) {
					continue;
				}

				// Format the start date
				$job->job_start_date = DateTime::createFromFormat('Y-m-d', $job->job_start_date)->format('d.m.Y');

				$data = array(
					'company_id' => $job->company_id,
					'company_image_url' => base_url() . $job->company_logo_image_url,
					'company_name' => $job->company_name,
					'job_id' => $job->job_id,
					'job_title' => $job->job_title,
					'job_date' => $job->job_start_date,
					'job_location' => $job->address_city .', '. $job->country_name,
					'job_text' => word_limiter($job->job_text, 35),
				);

				$response .= $this->parser->parse('template/job/result', $data, true);
			}
		} else {
			foreach ($query->result() as $i => $job) {
				// Format the start date
				$job->job_start_date = DateTime::createFromFormat('Y-m-d', $job->job_start_date)->format('d.m.Y');

				$has_term = false;
				$has_sector = false;
				$has_type = false;

				if ($filter_term) {
					// The job_title, job_lead_text or job_text contain the entered term
					$has_term = (stripos($job->job_title, $term) !== false || stripos($job->job_lead_text, $term) !== false || stripos($job->job_text, $term) !== false);
				}

				if ($filter_sector) {
					// The sector_id is one of the selected sectors
					if (in_array($job->sector_id, $sectors)) {
						$has_sector = true;
					}
				}

				if ($filter_type) {
					// The type_id is one of the selected types
					if (in_array($job->type_id, $types)) {
						$has_type = true;
					}
				}

				$filter = $has_term || $has_sector || $has_type;

				if ($filter_term) {
					$filter = $has_term;
				}

				if ($filter_sector) {
					$filter = $has_sector;
				}

				if ($filter_type) {
					$filter = $has_type;
				}

				if ($filter_term && $filter_sector) {
					$filter = $has_term && $has_sector;
				}

				if ($filter_term && $filter_type) {
					$filter = $has_term && $has_type;
				}

				if ($filter_sector && $filter_type) {
					$filter = $has_sector && $has_type;
				}

				if ($filter_term && $filter_sector && $filter_type) {
					$filter = $has_term && $has_sector && $has_type;
				}

				if ($filter) {
					$data = array(
						'company_id' => $job->company_id,
						'company_image_url' => base_url() . $job->company_logo_image_url,
						'company_name' => $job->company_name,
						'job_id' => $job->job_id,
						'job_title' => $job->job_title,
						'job_date' => $job->job_start_date,
						'job_location' => $job->address_city .', '. $job->country_name,
						'job_text' => word_limiter($job->job_text, 35),
					);

					$response .= $this->parser->parse('template/job/result', $data, true);
				}
			}
		}

		if (empty($response)) {
			// There was no job which matched the filter

			$data = array(
				'error' => 'Es wurde kein passendes Jobangebot gefunden.',
			);

			header('Content-Type: application/json');
			echo json_encode($data);
		} else {
			echo $response;
		}
	}

	public function details($job_id)
	{
		if (!($this->session->member['logged_in'] || $this->session->partner['logged_in'])) {
			redirect(base_url() .'job/index');
		}

		// The sent job_id is not a positive integer
		if (!isset($job_id) || !ctype_digit($job_id) || $job_id <= 0) {
			redirect(base_url() .'job/index');
		}

		$query = $this->Job->get_job('filter:id', $job_id);

		// The job was found
		if ($query->num_rows() == 1) {
			// Statistics
			if ($this->session->member['logged_in']) {
				$this->Statistics->add_job_view($job_id);
			}

			$header_data = array(
				'title' => 'Primus Romulus - Job',
			);

			$this->load->view('elements/header', $header_data);

			$job = $query->first_row();

			// Format the start date
			$job->job_start_date = DateTime::createFromFormat('Y-m-d', $job->job_start_date)->format('d.m.Y');

			// Determine location_email
			if ($job->location_email != NULL) {
				$location_email = '<i class="fa fa-envelope fa-fw"></i> <a href="mailto:'. $job->location_email .'">'. $job->location_email .'</a><br />';
			} else if ($this->Partner->get_partner_job_email($job->company_id) != NULL) {
				$location_email = '<i class="fa fa-envelope fa-fw"></i> <a href="mailto:'. $this->Partner->get_partner_job_email($job->company_id) .'">'. $this->Partner->get_partner_job_email($job->company_id) .'</a><br />';
			} else {
				$location_email = '';
			}

			// Determine location_website
			if ($job->location_website != NULL) {
				$location_website = '<i class="fa fa-globe fa-fw"></i> <a href="'. prep_url($job->location_website) .'">'. $job->location_website .'</a><br />';
			} else if ($this->Partner->get_partner_website($job->company_id) != NULL) {
				$location_website = '<i class="fa fa-globe fa-fw"></i> <a href="'. prep_url($this->Partner->get_partner_website($job->company_id)) .'">'. $this->Partner->get_partner_website($job->company_id) .'</a><br />';
			} else {
				$location_website = '';
			}

			$data = array(
				'company_id' => $job->company_id,
				'company_name' => $job->company_name,
				'job_id' => $job->job_id,
				'job_title' => $job->job_title,
				'job_lead_text' => $job->job_lead_text,
				'job_open' => ($job->job_open == 0 ? '<div class="alert alert-danger" role="alert"><i class="fa fa-lock"></i> Dieses Jobangebot ist geschlossen!</div>' : ''),
				'job_text' => $job->job_text,
				'job_salary_text' => $job->job_salary_text,
				'job_date' => $job->job_start_date,
				'job_tasks' => $this->Job->get_job_tasks($job->job_id)->result_array(),
				'job_requirements' => $this->Job->get_job_requirements($job->job_id)->result_array(),
				'location_name' => $job->location_name,
				'location_street' => $job->address_street,
				'location_zipcode' => $job->address_zipcode,
				'location_city' => $job->address_city,
				'location_country' => $job->country_name,
				'location_phone' => ($job->location_phone != NULL ? '<i class="fa fa-phone fa-fw"></i> '. $job->location_phone .'<br />' : ''),
				'location_fax' => ($job->location_fax != NULL ? '<i class="fa fa-fax fa-fw"></i> '. $job->location_fax .'<br />' : ''),
				'location_email' => $location_email,
				'location_website' => $location_website,
			);

			if ($job->contact_id != NULL) {
				// Get employee data
				$query = $this->Employee->get_employee('filter:id', $job->contact_id);

				// The employee was found
				if ($query->num_rows() == 1) {
					$employee = $query->first_row();

					// Determine image tag
					if ($employee->employee_profile_image_url != NULL) {
						$image = '<img class="media-object dp img-circle" src="'. base_url() . $employee->employee_profile_image_url .'">';
					} else {
						$image = '';
					}

					$employee_data = array(
						'gender' => $employee->gender_description,
						'title' => ($employee->employee_title != NULL ? $employee->employee_title : ''),
						'firstname' => $employee->employee_firstname,
						'lastname' => $employee->employee_lastname,
						'image' => $image,
						'email' => '<i class="fa fa-envelope fa-fw"></i> <a href="mailto:'. $employee->user_email .'" target="_blank">'. $employee->user_email .'</a>',
						'phone' => ($employee->employee_phone != NULL ? '<br /><i class="fa fa-phone fa-fw"></i> '. $employee->employee_phone : ''),
						'panel_footer' => '',
					);

					$data['contact'] = '<h3>Kontaktperson</h3>'. $this->parser->parse('template/profile/employee-card', $employee_data, true);
				} else {
					$data['contact'] = '';
				}
			} else {
				$data['contact'] = '';
			}

			$this->parser->parse('template/job/detail', $data);

			$this->load->view('elements/footer');
		} else {
			redirect(base_url() .'job/index');
		}
	}

}
