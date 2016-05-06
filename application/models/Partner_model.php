<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partner_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
    }

    function get_partner_sectors($company_id)
	{
		return $this->db->query('
			SELECT sector_id, sector_name AS sector
			FROM Company
			INNER JOIN CompanySector USING (company_id)
			INNER JOIN Sector USING (sector_id)
			WHERE company_id = ?
		', array($company_id));
	}

	function get_partner_job_email($company_id)
	{
		return $this->db->query('
			SELECT company_job_email
			FROM Company
			WHERE company_id = ?
		', array($company_id))->first_row()->company_job_email;
	}

	function get_partner_website($company_id)
	{
		return $this->db->query('
			SELECT company_website
			FROM Company
			WHERE company_id = ?
		', array($company_id))->first_row()->company_website;
	}

	function get_partner_main_contact($company_id)
	{
		return $this->db->query('
			SELECT *
			FROM Company
			LEFT OUTER JOIN Employee ON (company_main_contact = employee_id)
			LEFT OUTER JOIN User ON (employee_id = user_id)
			WHERE Company.company_id = ?
		', array($company_id))->first_row();
	}

    function get_partner($p_command = '', $p_data = '')
	{
		$type = preg_split("[:]", $p_command);

		if ($p_command != '') {
			switch ($type[0]) {
				case 'filter': 
					switch ($type[1]) {
						case 'id': 
							$query = $this->db->query('
								SELECT * 
								FROM Company 
								INNER JOIN User ON (company_id = user_id)
								INNER JOIN CompanyPacket USING (companypacket_id)
								INNER JOIN Location ON (company_main_location = location_id)
								LEFT OUTER JOIN Address USING (address_id)
								LEFT OUTER JOIN Country USING (country_id)
								WHERE user_id = ?
							', array($p_data));
						break;

						case 'email': 
							$query = $this->db->query('
								SELECT * 
								FROM Company 
								INNER JOIN User ON (company_id = user_id)
								INNER JOIN CompanyPacket USING (companypacket_id)
								INNER JOIN Location ON (company_main_location = location_id)
								LEFT OUTER JOIN Address USING (address_id)
								LEFT OUTER JOIN Country USING (country_id)
								WHERE user_email = ?
							', array($p_data));
						break;
					}
				break;

				case 'all':
					$query = $this->db->query('
						SELECT * 
						FROM Company 
						INNER JOIN User ON (company_id = user_id)
						INNER JOIN CompanyPacket USING (companypacket_id)
						INNER JOIN Location ON (company_main_location = location_id)
						LEFT OUTER JOIN Address USING (address_id)
						LEFT OUTER JOIN Country USING (country_id)
					');
				break;
			}

			return $query;
		}

		return null;
	}

	function partner_set_sectors($company_id, $sectors)
	{
		$this->db->where('company_id', $company_id);

		if (!$this->db->delete('CompanySector')) {
			return false;
		}

		foreach ($sectors as $i => $sector) {
			if (!empty($sector)) {
				$this->db->set('company_id', $company_id);
				$this->db->set('sector_id', $sector);

				if (!$this->db->insert('CompanySector')) {
					return false;
				}
			}
		}

		return true;
	}

	function edit_partner($company_id, $data)
	{
		if (array_key_exists('sectors', $data) && !is_null($data['sectors'])) {
			// Set sectors of partner
			if (!$this->partner_set_sectors($company_id, $data['sectors'])) {
				return false;
			}

			if (count($data) == 1) {
				return true;
			}
		}

		if (array_key_exists('name', $data) && !is_null($data['name'])) {
			$this->db->set('company_name', $data['name']);
		}

		if (array_key_exists('description', $data) && !is_null($data['description'])) {
			$this->db->set('company_description', $data['description']);
		}

		if (array_key_exists('location', $data) && !is_null($data['location'])) {
			$this->db->set('company_main_location', $data['location']);
		}

		if (array_key_exists('contact', $data)) {
			if (!ctype_digit($data['contact']) || $data['contact'] <= 0) {
				$data['contact'] = NULL;
			}

			$this->db->set('company_main_contact', $data['contact']);
		}

		if (array_key_exists('job_email', $data)) {
			$this->db->set('company_job_email', $data['job_email']);
		}

		if (array_key_exists('contact_email', $data)) {
			$this->db->set('company_contact_email', $data['contact_email']);
		}

		if (array_key_exists('logo_image_url', $data)) {
			$this->db->set('company_logo_image_url', $data['logo_image_url']);
		}

		if (array_key_exists('profile_image_url', $data)) {
			$this->db->set('company_profile_image_url', $data['profile_image_url']);
		}

		if (array_key_exists('banner_image_url', $data)) {
			$this->db->set('company_banner_image_url', $data['banner_image_url']);
		}

		if (array_key_exists('website', $data)) {
			$this->db->set('company_website', $data['website']);
		}

		if (array_key_exists('facebook', $data)) {
			$this->db->set('company_facebook', $data['facebook']);
		}

		if (array_key_exists('google', $data)) {
			$this->db->set('company_google_plus', $data['google']);
		}

		if (array_key_exists('linkedin', $data)) {
			$this->db->set('company_linkedin', $data['linkedin']);
		}

		if (array_key_exists('twitter', $data)) {
			$this->db->set('company_twitter', $data['twitter']);
		}

		if (array_key_exists('xing', $data)) {
			$this->db->set('company_xing', $data['xing']);
		}

		if (array_key_exists('youtube', $data)) {
			$this->db->set('company_youtube', $data['youtube']);
		}

		$this->db->where('company_id', $company_id);
		return $this->db->update('Company');
	}
	
    function update_account($p_company_id, $p_command = "", $p_data = "")
	{
        switch($p_command) 
		{
            case 'name': 
				$query = $this->db->query("UPDATE Company SET company_name = ? WHERE company_id = ?", array($p_data, $p_company_id));
            break;
			
			case 'description': 
				$query = $this->db->query("UPDATE Company SET company_description = ? WHERE company_id = ?", array($p_data, $p_company_id));
            break;
			
			case 'website': 
				$query = $this->db->query("UPDATE Company SET company_website = ? WHERE company_id = ?", array($p_data, $p_company_id));
            break;
			
			case 'facebook': 
				$query = $this->db->query("UPDATE Company SET company_facebook = ? WHERE company_id = ?", array($p_data, $p_company_id));
            break;
			
			case 'google_plus': 
				$query = $this->db->query("UPDATE Company SET company_google_plus = ? WHERE company_id = ?", array($p_data, $p_company_id));
            break;
			
			case 'linkedin': 
				$query = $this->db->query("UPDATE Company SET company_linkedin = ? WHERE company_id = ?", array($p_data, $p_company_id));
            break;
			
			case 'twitter': 
				$query = $this->db->query("UPDATE Company SET company_twitter = ? WHERE company_id = ?", array($p_data, $p_company_id));
            break;
			
			case 'xing': 
				$query = $this->db->query("UPDATE Company SET company_xing = ? WHERE company_id = ?", array($p_data, $p_company_id));
            break;
			
			case 'youtube': 
				$query = $this->db->query("UPDATE Company SET company_youtube = ? WHERE company_id = ?", array($p_data, $p_company_id));
            break;
        }
	}
	
	function create_employee($p_email, $p_password, $p_company_id, $p_salutation, $p_firstname, $p_lastname, $p_profile, $p_contact, $p_location, $p_job, $p_ad, $p_post, $p_manage_employees)
	{
		$emp_id = $this->User->create_user($p_email, $p_password);

		if ($emp_id <= 0) {
			return '<li>E-Mail ist bereits registriert.</li>';
		}

		$gender_id = $this->User->get_gender_id($p_salutation);
			
		$this->db->query("INSERT INTO Employee(employee_id, company_id, gender_id, employee_firstname, employee_lastname) 
		VALUES(?, ?, ?, ?, ?, ?)", array($emp_id, $p_company_id, $gender_id, $p_firstname, $p_lastname));
		
		$this->db->query("INSERT INTO EmployeeACL(employee_id, profile, contact, location, job, ad, post, manage_employees) 
		VALUES(?, ?, ?, ?, ?, ?)", array($emp_id, $p_profile, $p_contact, $p_location, $p_job, $p_ad, $p_post, $p_manage_employees));
	}
	
	function change_right_of_employee($p_employee_id, $p_company_id, $p_command = "", $p_data = "")
	{
		if($this->is_employee_in_company($p_employee_id, $p_comany_id))
		{
			switch($p_command)
			{
				case 'profile':
					$this->db->query("UPDATE EmployeeACL SET profile = ? WHERE employee_id = ?", array($p_data, $p_employee_id));
				break;
				
				case 'contact':
					$this->db->query("UPDATE EmployeeACL SET contact = ? WHERE employee_id = ?", array($p_data, $p_employee_id));
				break;
				
				case 'location':
					$this->db->query("UPDATE EmployeeACL SET location = ? WHERE employee_id = ?", array($p_data, $p_employee_id));
				break;
				
				case 'job':
					$this->db->query("UPDATE EmployeeACL SET job = ? WHERE employee_id = ?", array($p_data, $p_employee_id));
				break;
				
				case 'ad':
					$this->db->query("UPDATE EmployeeACL SET ad = ? WHERE employee_id = ?", array($p_data, $p_employee_id));
				break;
				
				case 'post':
					$this->db->query("UPDATE EmployeeACL SET post = ? WHERE employee_id = ?", array($p_data, $p_employee_id));
				break;
				
				case 'manage_employees':
					$this->db->query("UPDATE EmployeeACL SET manage_employees = ? WHERE employee_id = ?", array($p_data, $p_employee_id));
				break;
			}
		}
	}
	
	function is_employee_in_company($p_employee_id, $p_company_id)
	{
		$result_id = $this->db->query("SELECT company_id 
		FROM Employee 
		WHERE employee_id = ?", array($p_employee_id))->row->company_id;
		
		return $result_id == $p_comany_id;
	}
	
	//branch, banners, job, feed, ad, links
}
?>