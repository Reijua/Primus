<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
	
	function get_all_users_not_banned()
	{
		$query = $this->db->query("SELECT * FROM User INNER JOIN Member ON(user_id = member_id) 
		LEFT OUTER JOIN MemberBlocking USING(member_id)
		WHERE SYSDATE() NOT BETWEEN memberblocking_start_date 
		AND IFNULL(memberblocking_end_date, DATE_ADD(SYSDATE(), INTERVAL 1 DAY))");
		return $query;
	}
	
	function get_all_banned_users()
	{
		$query = $this->db->query("SELECT * FROM User INNER JOIN Member ON(user_id = member_id) 
		INNER JOIN MemberBlocking USING(member_id)
		WHERE SYSDATE() BETWEEN memberblocking_start_date 
		AND IFNULL(memberblocking_end_date, DATE_ADD(SYSDATE(), INTERVAL 1 DAY))");
		return $query;
	}
	
	function get_users_to_activate()
	{
		$query = $this->db->query("SELECT * FROM User INNER JOIN Member ON(user_id = member_id) 
		INNER JOIN MemberBlocking USING(member_id)
		WHERE SYSDATE() BETWEEN memberblocking_start_date 
		AND IFNULL(memberblocking_end_date, DATE_ADD(SYSDATE(), INTERVAL 1 DAY))
		AND UPPER(memberblocking_reason) = 'DIE ACCOUNT-DATEN WERDEN NOCH ÜBERPRÜFT.' 
		AND member_activated = 1");
		return $query;
	}
	
	function activate_user($p_user_id)
	{
		return $this->db->query("DELETE FROM MemberBlocking 
		WHERE member_id = ? 
		AND UPPER(memberblocking_reason) = 'DIE ACCOUNT-DATEN WERDEN NOCH ÜBERPRÜFT.'", array($p_user_id));
	}
	
	//length in hours
	function lock_account($p_account_id, $p_length, $p_reason)
	{
		if($p_length > -1)
		{
			return $this->db->query("INSERT INTO MemberBlocking(member_id, memberblocking_start_date, memberblocking_end_date, memberblocking_reason) 
			VALUES(?, SYSDATE(), DATE_ADD(SYSDATE(), INTERVAL ? HOUR), ?)", array($p_account_id, $p_length, $p_reason));
		}
		else
		{
			return $this->db->query("INSERT INTO MemberBlocking(member_id, memberblocking_start_date, memberblocking_end_date, memberblocking_reason) 
			VALUES(?, SYSDATE(), NULL, ?)", array($p_account_id, $p_reason));
		}
	   
	}
	
	function create_partner($p_email, $p_password, $p_packet_id, $p_company_name, $p_location_id)
	{
		//Creating User
		$user_id = $this->User->create_user($p_email, $p_password);

		if ($user_id <= 0) {
			return -1;
		}
		
		//Creating Partner
		if($this->db->query("INSERT INTO Company(company_id, companypacket_id, company_name, company_main_location) 
		VALUES(?, ?, ?, ?)", array($user_id, $p_packet_id, $p_company_name, $p_location_id)))
			return $user_id;
		else return -2;
	}
	
	function get_admin($p_email)
	{
		$query = $this->db->query('SELECT * 
		FROM Admin 
		INNER JOIN User ON(admin_id = user_id) 
		WHERE user_email = ?', array($p_email));
		return $query;
	}
	
	function get_user_with_id($p_user_id)
	{
		$query = $this->db->query('SELECT * 
		FROM User INNER JOIN Member ON(user_id = member_id) 
		WHERE member_id = ?', array($p_user_id));
		return $query;
	}
	
	function get_user_with_ban_id($p_memberblocking_id)
	{
		$query = $this->db->query("SELECT * FROM User INNER JOIN Member ON(user_id = member_id) 
		INNER JOIN MemberBlocking USING(member_id)
		WHERE SYSDATE() BETWEEN memberblocking_start_date 
		AND IFNULL(memberblocking_end_date, DATE_ADD(SYSDATE(), INTERVAL 1 DAY)) 
		AND memberblocking_id = ?", array($p_memberblocking_id));
		return $query;
	}
	
	function delete_ban_with_ban_id($p_memberblocking_id)
	{
		return $this->db->query("DELETE FROM MemberBlocking WHERE memberblocking_id = ?", array($p_memberblocking_id));
	}
	
	function get_all_partner()
	{
		$query = $this->db->query('
			SELECT * 
			FROM Company 
			INNER JOIN User ON (company_id = user_id)
			INNER JOIN CompanyPacket USING (companypacket_id)
			LEFT OUTER JOIN Location ON (company_main_location = location_id)
			LEFT OUTER JOIN Address USING (address_id)
			LEFT OUTER JOIN Country USING (country_id)
		');
		return $query;
	}
	
	function get_all_partner_with_id($p_company_id)
	{
		$query = $this->db->query('
			SELECT * 
			FROM Company 
			INNER JOIN User ON (company_id = user_id)
			INNER JOIN CompanyPacket USING (companypacket_id)
			LEFT OUTER JOIN Location ON (company_main_location = location_id)
			LEFT OUTER JOIN Address USING (address_id)
			LEFT OUTER JOIN Country USING (country_id) 
			WHERE user_id = ?
		', array($p_company_id));
		return $query;
	}
	
	function delete_partner($p_company_id)
	{
		$this->db->where('user_id', $p_company_id);
		return $this->db->delete('User');
	}
	
	function edit_partner($p_company_id, $data)
	{
		$this->db->trans_begin();
		if (array_key_exists('email', $data) && !is_null($data['email']) && array_key_exists('password', $data) && !is_null($data['password'])) 
		{
			$this->db->set('user_email', $data['email']);
			$this->db->set('user_password_hash', $this->User->password_hash($data['email'], $data['password']));
			$this->db->where('user_id', $p_company_id);
			$this->db->update('User');
		}

		if (array_key_exists('packet', $data) && !is_null($data['packet'])) {
			$this->db->set('companypacket_id', $data['packet']);
		}
		
		if (array_key_exists('companyname', $data) && !is_null($data['companyname'])) {
			$this->db->set('company_name', $data['companyname']);
		}

		$this->db->where('company_id', $p_company_id);
		$this->db->update('Company');
		
		if ($this->db->trans_status() === FALSE)
		{
				$this->db->trans_rollback();
				return false;
		}
		else
		{
				$this->db->trans_commit();
				return true;
		}
	}
}
?>