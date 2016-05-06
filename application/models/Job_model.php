<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function create_job($company_id, $title, $lead_text, $text, $salary_text, $start_date, $status, $contact, $type, $location, $sector, $tasks, $requirements)
	{
		$this->db->set('company_id', $company_id);
		$this->db->set('contact_id', $contact);
		$this->db->set('location_id', $location);
		$this->db->set('sector_id', $sector);
		$this->db->set('type_id', $type);
		$this->db->set('job_open', $status);
		$this->db->set('job_title', $title);
		$this->db->set('job_lead_text', $lead_text);
		$this->db->set('job_text', $text);
		$this->db->set('job_salary_text', $salary_text);
		$this->db->set('job_start_date', $start_date);
		$this->db->set('job_end_date', $start_date);

		if (!$this->db->insert('Job')) {
			return 0;
		}

		$job_id = $this->db->insert_id();

		if (!$this->job_set_tasks($job_id, $tasks)) {
			return 0;
		}

		if (!$this->job_set_requirements($job_id, $requirements)) {
			return 0;
		}

		return $job_id;
	}

	function job_set_tasks($job_id, $tasks)
	{
		$query = $this->db->query('
			SELECT section_id 
			FROM JobSection
			WHERE UPPER(section_name) = "AUFGABEN"
		');

		if ($query->num_rows() != 1) {
			return false;
		}

		$section_id = $query->first_row()->section_id;

		$this->db->where('job_id', $job_id);
		$this->db->where('section_id', $section_id);

		if (!$this->db->delete('JobSectionItem')) {
			return false;
		}

		foreach ($tasks as $i => $task) {
			if (!empty($task)) {
				$this->db->set('job_id', $job_id);
				$this->db->set('section_id', $section_id);
				$this->db->set('item_text', $task);

				if (!$this->db->insert('JobSectionItem')) {
					return false;
				}
			}
		}

		return true;
	}

	function job_set_requirements($job_id, $requirements)
	{
		$query = $this->db->query('
			SELECT section_id 
			FROM JobSection
			WHERE UPPER(section_name) = "ANFORDERUNGEN"
		');

		if ($query->num_rows() != 1) {
			return false;
		}

		$section_id = $query->first_row()->section_id;

		$this->db->where('job_id', $job_id);
		$this->db->where('section_id', $section_id);

		if (!$this->db->delete('JobSectionItem')) {
			return false;
		}

		foreach ($requirements as $i => $requirement) {
			if (!empty($requirement)) {
				$this->db->set('job_id', $job_id);
				$this->db->set('section_id', $section_id);
				$this->db->set('item_text', $requirement);

				if (!$this->db->insert('JobSectionItem')) {
					return false;
				}
			}
		}

		return true;
	}

	function edit_job($job_id, $data)
	{
		if (array_key_exists('tasks', $data) && !is_null($data['tasks'])) {
			// Set tasks of job
			if (!$this->job_set_tasks($job_id, $data['tasks'])) {
				return false;
			}
		}

		if (array_key_exists('requirements', $data) && !is_null($data['requirements'])) {
			// Set requirements of job
			if (!$this->job_set_requirements($job_id, $data['requirements'])) {
				return false;
			}
		}

		if (array_key_exists('contact', $data)) {
			if (!ctype_digit($data['contact']) || $data['contact'] <= 0) {
				$data['contact'] = NULL;
			}

			$this->db->set('contact_id', $data['contact']);
		}

		if (array_key_exists('location', $data) && !is_null($data['location'])) {
			$this->db->set('location_id', $data['location']);
		}

		if (array_key_exists('sector', $data) && !is_null($data['sector'])) {
			$this->db->set('sector_id', $data['sector']);
		}

		if (array_key_exists('type', $data) && !is_null($data['type'])) {
			$this->db->set('type_id', $data['type']);
		}

		if (array_key_exists('status', $data) && !is_null($data['status'])) {
			$this->db->set('job_open', $data['status']);
		}

		if (array_key_exists('title', $data) && !is_null($data['title'])) {
			$this->db->set('job_title', $data['title']);
		}

		if (array_key_exists('lead_text', $data) && !is_null($data['lead_text'])) {
			$this->db->set('job_lead_text', $data['lead_text']);
		}

		if (array_key_exists('text', $data) && !is_null($data['text'])) {
			$this->db->set('job_text', $data['text']);
		}

		if (array_key_exists('salary_text', $data) && !is_null($data['salary_text'])) {
			$this->db->set('job_salary_text', $data['salary_text']);
		}

		if (array_key_exists('start_date', $data) && !is_null($data['start_date'])) {
			$this->db->set('job_start_date', $data['start_date']);
		}

		$this->db->where('job_id', $job_id);
		return $this->db->update('Job');
	}

	function delete_jobs_at_location($location_id)
	{
		$this->db->query('
			DELETE
			FROM JobSectionItem
			WHERE job_id IN (SELECT job_id FROM Job WHERE location_id = ?)
		', array($location_id));

		$this->db->where('location_id', $location_id);
		$this->db->delete('Job');
	}

	function delete_job($job_id)
	{
		$tables = array('Job', 'JobSectionItem');

		$this->db->where('job_id', $job_id);
		$this->db->delete($tables);
	}
	
	function get_sectors()
	{
		return $this->db->query('
			SELECT * 
			FROM Sector
		');
	}

	function get_types()
	{
		return $this->db->query('
			SELECT * 
			FROM JobType
		');
	}

	function get_job_tasks($job_id)
	{
		return $this->db->query('
			SELECT item_text AS task
			FROM Job
			INNER JOIN JobSectionItem USING (job_id)
			INNER JOIN JobSection USING (section_id)
			WHERE job_id = ? AND UPPER(section_name) = "AUFGABEN"
		', array($job_id));
	}

	function get_job_requirements($job_id)
	{
		return $this->db->query('
			SELECT item_text AS requirement
			FROM Job
			INNER JOIN JobSectionItem USING (job_id)
			INNER JOIN JobSection USING (section_id)
			WHERE job_id = ? AND UPPER(section_name) = "ANFORDERUNGEN"
		', array($job_id));
	}

	function toggle_job($job_id)
	{
		// Toggle job_open from 1 to 0 and vice-versa
		$this->db->set('job_open', '1 - job_open', false);

		$this->db->where('job_id', $job_id);
		return $this->db->update('Job');
	}

	function get_job($p_command = '', $p_data = '')
	{
		$type = preg_split("[:]", $p_command);

		if ($p_command != '') {
			switch ($type[0]) {
				case 'filter': 
					switch ($type[1]) {
						case 'id': 
							$query = $this->db->query('
								SELECT * 
								FROM Job 
								INNER JOIN Company USING (company_id)
								LEFT OUTER JOIN Employee ON (contact_id = employee_id)
								INNER JOIN Location USING (location_id)
								INNER JOIN Address ON (Location.address_id = Address.address_id)
								INNER JOIN Country ON (Address.country_id = Country.country_id)
								INNER JOIN JobType USING (type_id)
								WHERE job_id = ?
							', array($p_data));
						break;

						case 'company': 
							$query = $this->db->query('
								SELECT * 
								FROM Job 
								INNER JOIN Company USING (company_id)
								LEFT OUTER JOIN Employee ON (contact_id = employee_id)
								INNER JOIN Location USING (location_id)
								INNER JOIN Address ON (Location.address_id = Address.address_id)
								INNER JOIN Country ON (Address.country_id = Country.country_id)
								INNER JOIN JobType USING (type_id)
								WHERE Job.company_id = ?
							', array($p_data));
						break;
					}
				break;

				case 'all':
					$query = $this->db->query('
						SELECT * 
						FROM Job 
						INNER JOIN Company USING (company_id)
						LEFT OUTER JOIN Employee ON (contact_id = employee_id)
						INNER JOIN Location USING (location_id)
						INNER JOIN Address ON (Location.address_id = Address.address_id)
						INNER JOIN Country ON (Address.country_id = Country.country_id)
						INNER JOIN JobType USING (type_id)
					');
				break;
			}

			return $query;
		}

		return null;
	}
}
?>