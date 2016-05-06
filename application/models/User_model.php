<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
	
	function create_user($email, $password)
	{
		if ($this->is_email_registered($email)) {
			return 0;
		}

		$reset_token = rtrim(base64_encode(md5('reset'. $email . microtime() . rand(1000, 9999))), '=');

		$this->db->set('user_email', $email);
		$this->db->set('user_password_hash', $this->password_hash($email, $password));
		$this->db->set('user_registration_date', 'NOW()', false); // false => Don't escape the NOW() function
		$this->db->set('user_password_reset_token', $reset_token);

		$this->db->insert('User');
		
		return $this->db->insert_id();
	}
	
	function is_email_registered($email)
	{
		$query = $this->db->query("SELECT * FROM User WHERE user_email = ?", array($email));
		return $query->num_rows() != 0;
	}
	
	function get_email($p_account_id)
	{
		return $this->db->query("SELECT user_email FROM User WHERE user_id = ?", array($p_account_id))->first_row()->user_email;
	}
	
	function get_gender_id($p_salutation)
	{
		return $this->db->query("SELECT gender_id FROM Gender WHERE UPPER(gender_salutation) = UPPER(?)", array($p_salutation))->first_row()->gender_id;
	}
	
	function password_hash($email, $password)
	{
        return hash('sha512', $email .'<-ยก!->'. $password .'<-!ยก->'. $this->config->item('encryption_key'));
    }
	
	function update_password($p_account_id, $p_password)
	{
        $this->db->query("UPDATE User SET user_password_hash = ? WHERE user_id = ?", array($this->password_hash($this->get_email($p_account_id), $p_password), $p_account_id));
    }

    function renew_password_reset_token($email)
	{
		$reset_token = rtrim(base64_encode(md5('reset'. $email . microtime() . rand(1000, 9999))), '=');

		$this->db->query('
			UPDATE User
			SET user_password_reset_token = ?
			WHERE user_email = ?
		', array($reset_token, $email));
	}
	
	function create_resource_directory($p_command = "", $p_account_id)
	{
		switch($p_command)
		{
			case 'member':
				if(!file_exists('/resource/'.$p_command.'/'.$p_account_id)) 
				{
					mkdir('/resource/'.$p_command.'/'.$p_account_id, 0777, true);
				}
			break;
			
			case 'partner':
				if(!file_exists('/resource/'.$p_command.'/'.$p_account_id)) 
				{
					mkdir('/resource/'.$p_command.'/'.$p_account_id, 0777, true);
				}
			break;
			
			case 'admin':
				if(!file_exists('/resource/'.$p_command.'/'.$p_account_id)) 
				{
					mkdir('/resource/'.$p_command.'/'.$p_account_id, 0777, true);
				}
			break;
			
			case 'employee':
				if(!file_exists('/resource/'.$p_command.'/'.$p_account_id)) 
				{
					mkdir('/resource/'.$p_command.'/'.$p_account_id, 0777, true);
				}
			break;
		}
	}

	// Return depends on the users type
	// Member: member_firstname member_lastname
	// Partner: company_name
	// Employee: employee_firstname employee_lastname
	// TODO: Add Admin table
	function get_user_name($p_user_id) 
	{
		$query = $this->db->query('
			SELECT member_firstname, member_lastname
			FROM Member
			WHERE member_id = ?
		', array($p_user_id));

		if ($query->num_rows() != 1) {
			$query = $this->db->query('
				SELECT company_name
				FROM Company
				WHERE company_id = ?
			', array($p_user_id));

			if ($query->num_rows() != 1) {
				$query = $this->db->query('
					SELECT employee_firstname, employee_lastname
					FROM Employee
					WHERE employee_id = ?
				', array($p_user_id));

				if ($query->num_rows() != 1) {
					// TODO: Add Admin table
				} else {
					return $query->first_row()->employee_firstname .' '. $query->first_row()->employee_lastname;
				}
			} else {
				return $query->first_row()->company_name;
			}
		} else {
			return $query->first_row()->member_firstname .' '. $query->first_row()->member_lastname;
		}

		return '';
	}
	
	function set_allow_newsletter($user_id, $allow_newsletter) 
	{
		$this->db->set('user_receive_newsletter', $allow_newsletter ? 1 : 0);

		$this->db->where('user_id', $user_id);
		return $this->db->update('User');
	}
}
?>