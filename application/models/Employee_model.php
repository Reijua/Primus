<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
    }

    function create_employee($company_id, $salutation, $title, $firstname, $lastname, $email, $phone, $image_url)
	{
		// Creating User
		$user_id = $this->User->create_user($email, rtrim(base64_encode(md5(microtime())), '='));

		if ($user_id > 0) {
			$gender_id = $this->User->get_gender_id($salutation);
		
			$this->db->set('employee_id', $user_id);
			$this->db->set('company_id', $company_id);
			$this->db->set('gender_id', $gender_id);
			$this->db->set('address_id', NULL);
			$this->db->set('employee_title', $title);
			$this->db->set('employee_firstname', $firstname);
			$this->db->set('employee_lastname', $lastname);
			$this->db->set('employee_phone', $phone);
			$this->db->set('employee_profile_image_url', $image_url);

			$this->db->insert('Employee');
		}

		return $user_id;
	}

	function edit_employee($employee_id, $data)
	{
		if (array_key_exists('email', $data) && !is_null($data['email'])) {
			$this->db->set('user_email', $data['email']);
			$this->db->where('user_id', $employee_id);
			$this->db->update('User');
		}

		if (array_key_exists('title', $data) && !is_null($data['title'])) {
			$this->db->set('employee_title', $data['title']);
		}

		if (array_key_exists('firstname', $data) && !is_null($data['firstname'])) {
			$this->db->set('employee_firstname', $data['firstname']);
		}

		if (array_key_exists('lastname', $data) && !is_null($data['lastname'])) {
			$this->db->set('employee_lastname', $data['lastname']);
		}

		if (array_key_exists('phone', $data)) {
			$this->db->set('employee_phone', $data['phone']);
		}

		if (array_key_exists('image_url', $data)) {
			$this->db->set('employee_profile_image_url', $data['image_url']);
		}

		$this->db->where('employee_id', $employee_id);
		return $this->db->update('Employee');
	}

	function delete_employee($employee_id) {
    	if ($this->get_employee('filter:id', $employee_id)->num_rows() != 1) {
    		return false;
		}

    	$company_id = $this->get_employee('filter:id', $employee_id)->first_row()->company_id;

    	$result = true;

    	// Update jobs
		$this->db->set('contact_id', NULL);
		$this->db->where('contact_id', $employee_id);
		$result = $result && $this->db->update('Job');

		// Update posts
		$this->db->set('author_id', $company_id);
		$this->db->where('author_id', $employee_id);
		$result = $result && $this->db->update('Post');

		if ($result) {
			$this->db->where('employee_id', $employee_id);

			if ($this->db->delete('Employee')) {
				$this->db->where('user_id', $employee_id);

				return $this->db->delete('User');
			}

			return false;			
		}

		return false;
    }

    function get_employee($p_command = '', $p_data = '')
	{
		$type = preg_split("[:]", $p_command);

		if ($p_command != '') {
			switch ($type[0]) {
				case 'filter': 
					switch ($type[1]) {
						case 'id': 
							$query = $this->db->query('
								SELECT * 
								FROM Employee 
								INNER JOIN User ON (employee_id = user_id)
								INNER JOIN Company USING (company_id)
								INNER JOIN Gender USING (gender_id)
								LEFT OUTER JOIN Address USING (address_id)
								LEFT OUTER JOIN Country USING (country_id)
								WHERE employee_id = ?
							', array($p_data));
						break;

						case 'company': 
							$query = $this->db->query('
								SELECT * 
								FROM Employee 
								INNER JOIN User ON (employee_id = user_id)
								INNER JOIN Company USING (company_id)
								INNER JOIN Gender USING (gender_id)
								LEFT OUTER JOIN Address USING (address_id)
								LEFT OUTER JOIN Country USING (country_id)
								WHERE company_id = ?
								ORDER BY employee_lastname, employee_firstname
							', array($p_data));
						break;
						
						case 'notmainemp':
							$query = $this->db->query('
								SELECT * 
								FROM Employee 
								INNER JOIN User ON (employee_id = user_id)
								INNER JOIN Company USING (company_id)
								INNER JOIN Gender USING (gender_id)
								LEFT OUTER JOIN Address USING (address_id)
								LEFT OUTER JOIN Country USING (country_id)
								WHERE company_id = ? 
								AND company_main_contact != employee_id
							', array($p_data));
						break;
					}
				break;

				case 'all':
					$query = $this->db->query('
						SELECT * 
						FROM Employee 
						INNER JOIN User ON (employee_id = user_id)
						INNER JOIN Company USING (company_id)
						INNER JOIN Gender USING (gender_id)
						LEFT OUTER JOIN Address USING (address_id)
						LEFT OUTER JOIN Country USING (country_id)
					');
				break;
			}

			return $query;
		}

		return null;
	}
}
?>