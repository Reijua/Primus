<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Poll_model extends CI_Model 

{

	function __construct()

	{
		parent::__construct();
		$this->load->database();
	}


	function get_Polls()
	{
		$query = $this->db->query('SELECT * FROM polls');
		return $query->result();
	}

	function get_Poll($poll_id)
	{
		$query = $this->db->query('
								SELECT * 
								FROM polls 
								WHERE poll_id = '.$poll_id.'');
		return $query;
	}

	function delete_Poll($poll_id)
	{
		$this->db->where('poll_id', $poll_id);
		return $this->db->delete('polls'); 
	}

	function get_Votes_For_Option($option_id)
	{
		$query = $this->db->query('SELECT * FROM votes WHERE option_id='.$option_id.'');
		return $query->num_rows();
	}

	function get_Votes_For_Poll($poll_id)
	{
		$query = $this->db->query('SELECT * FROM votes INNER JOIN options INNER JOIN polls WHERE options.option_id = votes.option_id AND options.poll_id = polls.poll_id AND polls.poll_id='.$poll_id.'');
		return $query->num_rows();
	}

	function get_Votes_Poll()
	{
		$query = $this->db->query('SELECT * FROM votes INNER JOIN options INNER JOIN polls WHERE options.option_id = votes.option_id AND options.poll_id = polls.poll_id');
		return $query->result();
	}

	function user_Voted($member_id, $poll_id)
	{
		$query = $this->db->query('SELECT * FROM votes INNER JOIN options INNER JOIN polls WHERE votes.option_id = options.option_id AND options.poll_id = polls.poll_id AND polls.poll_id = '.$poll_id.'  AND votes.member_id = '.$member_id.'');
		return $query->num_rows();
	}
	
	function vote_For_Option($option_id, $member_id)
	{
		$this->db->set('option_id', $option_id);
		$this->db->set('member_id', $member_id);
		$this->db->set('timestamp', date('Y-m-d H:i:s'));
		$this->db->insert('votes');
		return $this->db->insert_id();
	}
	
	function get_Options_For_Poll($poll_id = "")
	{
		  
	 if($poll_id == "")
		{
		  $query = $this->db->query('SELECT * FROM options');
		}

	 else
		{
		 $query = $this->db->query('SELECT * FROM options WHERE poll_id ='.$poll_id.'');
		}
		
	 return $query->result();
	}

	function create_Poll($title)
	{
		$this->db->set('title', $title);
		$this->db->set('created', date('Y-m-d H:i:s'));
		$this->db->insert('Polls');
		return $this->db->insert_id();
	}

}
