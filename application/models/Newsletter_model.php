<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function create_newsletter($p_subject, $p_text, $p_image_url, $p_attachment_url, $p_member, $p_partner, $p_employee)
	{
		$this->db->set('newsletter_subject', $p_subject);
		$this->db->set('newsletter_text', $p_text);
		//$this->db->set('newsletter_send', 'NOW()', false); // false => Don't escape the NOW() function
		$this->db->set('newsletter_image_url', $p_image_url);
		$this->db->set('newsletter_attachment_url', $p_attachment_url);
		if($p_member > 0)
			$this->db->set('newsletter_to_member', $p_member);
		if($p_partner > 0)
			$this->db->set('newsletter_to_partner', $p_partner);
		if($p_employee > 0)
			$this->db->set('newsletter_to_employee', $p_employee);
		
		$this->db->insert('Newsletter');

		return $this->db->insert_id();
	}
	
	function get_newsletter()
	{
		$query = $this->db->query('SELECT * 
		FROM Newsletter');
		return $query;
	}
	
	function get_newsletter_id($p_newsletter_id)
	{
		$query = $this->db->query('SELECT * 
		FROM Newsletter 
		WHERE newsletter_id = ?', array($p_newsletter_id));
		return $query;
	}
	
	function delete_newsletter($p_newsletter_id)
	{
		$this->db->where('newsletter_id', $p_newsletter_id);
		return $this->db->delete('Newsletter');
	}

	function edit_newsletter($p_newsletter_id, $data)
	{
		if (array_key_exists('subject', $data) && !is_null($data['subject'])) 
		{
			$this->db->set('newsletter_subject', $data['subject']);
		}

		if (array_key_exists('text', $data) && !is_null($data['text'])) 
		{
			$this->db->set('newsletter_text', $data['text']);
		}

		if (array_key_exists('image_url', $data)) {
			$this->db->set('newsletter_image_url', $data['image_url']);
		}
		
		if (array_key_exists('attachment_url', $data)) {
			$this->db->set('newsletter_attachment_url', $data['attachment_url']);
		}
		
		if (array_key_exists('count_recipients', $data)) {
			$this->db->set('newsletter_count_recipients', $data['count_recipients']);
		}
		
		if (array_key_exists('member', $data)) {
			$this->db->set('newsletter_to_member', $data['member']);
		}

		if (array_key_exists('employee', $data)) {
			$this->db->set('newsletter_to_employee', $data['employee']);
		}

		if (array_key_exists('partner', $data)) {
			$this->db->set('newsletter_to_partner', $data['partner']);
		}
		
		if (array_key_exists('send', $data)) {
			$this->db->set('newsletter_send', 'NOW()', false); // false => Don't escape the NOW() function
		}

		$this->db->where('newsletter_id', $p_newsletter_id);
		return $this->db->update('Newsletter');
	}
	
	function get_users($p_command = '')
	{
		switch($p_command)
		{
			case 'member':
				$query = $this->db->query('SELECT *
				FROM Member INNER JOIN User ON(member_id = user_id) 
				WHERE user_receive_newsletter = 1');
			break;
				
			case 'employee':
				$query = $this->db->query('SELECT *
				FROM Employee INNER JOIN User ON(employee_id = user_id) 
				WHERE user_receive_newsletter = 1');
			break;
				
			case 'partner':
				$query = $this->db->query('SELECT *
				FROM Company INNER JOIN User ON(company_id = user_id) 
				WHERE user_receive_newsletter = 1');
			break;
		}
		return $query;
	}
	
	function get_count($p_command = '')
	{
		switch($p_command)
		{
			case 'member':
				$query = $this->db->query('SELECT COUNT(*) 
				FROM Member INNER JOIN User ON(member_id = user_id) 
				WHERE user_receive_newsletter = 1');
			break;
				
			case 'employee':
				$query = $this->db->query('SELECT COUNT(*) 
				FROM Employee INNER JOIN User ON(employee_id = user_id) 
				WHERE user_receive_newsletter = 1');
			break;
				
			case 'partner':
				$query = $this->db->query('SELECT COUNT(*) 
				FROM Company INNER JOIN User ON(company_id = user_id) 
				WHERE user_receive_newsletter = 1');
			break;
		}
		return $query;
	}
}
?>