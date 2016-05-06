<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function create_account($p_salutation, $p_title, $p_firstname, $p_lastname, $p_birthday, $p_email, $p_password)
	{
		//Creating User
		$member_id = $this->User->create_user($p_email, $p_password);

		if ($member_id <= 0) {
			return 0;
		}
		
		$gender_id = $this->User->get_gender_id($p_salutation);
		
		//Creating Member
		$this->db->query("INSERT INTO Member(member_id, gender_id, member_title, member_firstname, member_lastname, member_birthday) 
		VALUES(?, ?, ?, ?, ?, ?)", array($member_id, $gender_id, $p_title, $p_firstname, $p_lastname, $p_birthday));
		
		//locking account until a admin activated him
		//Need to implement english and in the admin model
		$this->lock_account($member_id, -1, 'Die Account-Daten werden noch überprüft.');

		return $member_id;
	}
	
	//length in hours
	function lock_account($p_account_id, $p_length, $p_reason)
	{
		if($p_length > -1)
		{
			$this->db->query("INSERT INTO MemberBlocking(member_id, memberblocking_start_date, memberblocking_end_date, memberblocking_reason) 
			VALUES(?, SYSDATE(), DATE_ADD(SYSDATE(), INTERVAL ? HOUR), ?)", array($p_account_id, $p_length, $p_reason));
		}
		else
		{
			$this->db->query("INSERT INTO MemberBlocking(member_id, memberblocking_start_date, memberblocking_end_date, memberblocking_reason) 
			VALUES(?, SYSDATE(), NULL, ?)", array($p_account_id, $p_reason));
		}
	   
	}
	
	// Locked if $query->num_rows() is greater than 0
	function is_locked($p_account_id)
	{
		$query = $this->db->query("SELECT * FROM MemberBlocking 
		WHERE member_id = ? 
		AND SYSDATE() BETWEEN memberblocking_start_date 
		AND IFNULL(memberblocking_end_date, DATE_ADD(SYSDATE(), INTERVAL 1 DAY))", array($p_account_id)); //DATE_ADD(SYSDATE(), INTERVAL 1 DAY) -> always true, if end_date is null.
		return $query;
	}
	
	function create_register_token($p_account_id = "", $p_token = "")
	{		
		if($this->get_register_token($this->User->get_email($p_account_id))->num_rows() == 0)
		{
			$this->db->query("INSERT INTO MemberToken(member_id, membertoken_register_token, membertoken_date_created)
			VALUES(?,?,NOW())", array($p_account_id, $p_token));
		}
		else
			return "Registertoken wurde erst generiert.";
	}
	
	function get_register_token($p_email = "")
	{
		$query = $this->db->query("SELECT membertoken_register_token, membertoken_used 
		FROM MemberToken INNER JOIN User ON (member_id = user_id)
		WHERE user_email = ?", array($p_email));
		return $query;

		//  AND SYSDATE() BETWEEN membertoken_date_created AND (membertoken_date_created + INTERVAL 1 HOUR)
	}

	function use_register_token($p_email = "", $p_token = "")
	{
		$this->db->query("UPDATE MemberToken 
		SET membertoken_used = 1
		WHERE member_id = 
		(SELECT user_id FROM User WHERE user_email = ?) AND membertoken_register_token = ?", array($p_email, $p_token));
		
		$this->db->query("UPDATE Member 
		SET member_activated = 1
		WHERE member_id = (SELECT user_id FROM User WHERE user_email = ?)", array($p_email));
	}

	function verified_email($member_id)
	{
		$query = $this->db->query('
			SELECT membertoken_used
			FROM MemberToken
			WHERE member_id = ?
		', array($member_id));

		if ($query->num_rows() == 1) {
			return ($query->first_row()->membertoken_used == 1);
		}

		return false;
	}

	function get_departments()
	{
		return $this->db->query('
			SELECT *
			FROM Department
		');
	}

	function get_classes()
	{
		return $this->db->query('
			SELECT *
			FROM Class
			GROUP BY class_end_year
		');
	}

	function get_classes_departments()
	{
		return $this->db->query('
			SELECT *
			FROM Class
			INNER JOIN Department USING (department_id)
		');
	}

	function get_member($p_command = '', $p_data = '')
	{
		$type = preg_split("[:]", $p_command);

		if ($p_command != '') {
			switch ($type[0]) {
				case 'filter': 
					switch ($type[1]) {
						case 'id': 
							$query = $this->db->query('
								SELECT * 
								FROM Member 
								INNER JOIN User ON (member_id = user_id)
								INNER JOIN Gender USING (gender_id)
								LEFT OUTER JOIN Address USING (address_id)
								LEFT OUTER JOIN Country USING (country_id)
								LEFT OUTER JOIN Class USING (class_id)
								LEFT OUTER JOIN Department USING (department_id)
								WHERE user_id = ?
							', array($p_data));
						break;

						case 'email': 
							$query = $this->db->query('
								SELECT * 
								FROM Member 
								INNER JOIN User ON (member_id = user_id)
								INNER JOIN Gender USING (gender_id)
								LEFT OUTER JOIN Address USING (address_id)
								LEFT OUTER JOIN Country USING (country_id)
								LEFT OUTER JOIN Class USING (class_id)
								LEFT OUTER JOIN Department USING (department_id)
								WHERE user_email = ?
							', array($p_data));
						break;

						case 'class': 
							$query = $this->db->query('
								SELECT * 
								FROM Member 
								INNER JOIN User ON (member_id = user_id)
								INNER JOIN Gender USING (gender_id)
								LEFT OUTER JOIN Address USING (address_id)
								LEFT OUTER JOIN Country USING (country_id)
								LEFT OUTER JOIN Class USING (class_id)
								LEFT OUTER JOIN Department USING (department_id)
								WHERE class_id = ?
							', array($p_data));
						break;
					}
				break;

				case 'all':
					$query = $this->db->query('
						SELECT * 
						FROM Member 
						INNER JOIN User ON (member_id = user_id)
						INNER JOIN Gender USING (gender_id)
						LEFT OUTER JOIN Address USING (address_id)
						LEFT OUTER JOIN Country USING (country_id)
						LEFT OUTER JOIN Class USING (class_id)
						LEFT OUTER JOIN Department USING (department_id)
					');
				break;
			}

			return $query;
		}

		return null;
	}

	function set_allow_email_contact($member_id, $allow_email_contact) {
		$this->db->set('member_allows_email_contact', $allow_email_contact ? 1 : 0);

		$this->db->where('member_id', $member_id);
		return $this->db->update('Member');
	}

	function edit_member($member_id, $data)
	{
		if (array_key_exists('title', $data)) {
			$this->db->set('member_title', (is_null($data['title']) ? '' : $data['title']));
		}

		if (array_key_exists('firstname', $data) && !is_null($data['firstname'])) {
			$this->db->set('member_firstname', $data['firstname']);
		}

		if (array_key_exists('lastname', $data) && !is_null($data['lastname'])) {
			$this->db->set('member_lastname', $data['lastname']);
		}

		if (array_key_exists('profile_image_url', $data)) {
			$this->db->set('member_profile_image_url', $data['profile_image_url']);
		}

		if (array_key_exists('about_text', $data)) {
			$this->db->set('member_about_text', $data['about_text']);
		}

		if (array_key_exists('class_id', $data)) {
			$this->db->set('class_id', $data['class_id']);
		}

		if (array_key_exists('company_name', $data)) {
			$this->db->set('company_name', $data['company_name']);
		}

		$this->db->where('member_id', $member_id);
		return $this->db->update('Member');
	}

	//missing update account, create location, deleting account
}
?>