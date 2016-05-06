<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistics_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get_profile_statistics($company_id)
	{
		return $this->db->query('
			SELECT company_profile_views, company_profile_last_view
			FROM Company 
			WHERE company_id = ?
		', array($company_id));
	}

	function add_profile_view($company_id)
	{
		$this->db->set('company_profile_views', 'company_profile_views + 1', false);
		$this->db->set('company_profile_last_view', 'NOW()', false);

		$this->db->where('company_id', $company_id);
		return $this->db->update('Company');
	}

	function get_post_statistics($company_id)
	{
		return $this->db->query('
			SELECT SUM(post_views) AS post_views, MAX(post_last_view) AS post_last_view
			FROM Post
			WHERE company_id = ?
		', array($company_id));
	}

	function add_post_view($post_id)
	{
		$this->db->set('post_views', 'post_views + 1', false);
		$this->db->set('post_last_view', 'NOW()', false);

		$this->db->where('post_id', $post_id);
		return $this->db->update('Post');
	}

	function get_post_statistics_top($company_id)
	{
		return $this->db->query('
			SELECT post_title, post_views
			FROM Post
			WHERE company_id = ?
			ORDER BY post_views DESC
			LIMIT 3
		', array($company_id));
	}

	function get_job_statistics($company_id)
	{
		return $this->db->query('
			SELECT SUM(job_views) AS job_views, MAX(job_last_view) AS job_last_view
			FROM Job
			WHERE company_id = ?
		', array($company_id));
	}

	function add_job_view($job_id)
	{
		$this->db->set('job_views', 'job_views + 1', false);
		$this->db->set('job_last_view', 'NOW()', false);

		$this->db->where('job_id', $job_id);
		return $this->db->update('Job');
	}

	function get_job_statistics_top($company_id)
	{
		return $this->db->query('
			SELECT job_title, job_views
			FROM Job
			WHERE company_id = ?
			ORDER BY job_views DESC
			LIMIT 3
		', array($company_id));
	}

	function get_advertisement_statistics($company_id)
	{
		return $this->db->query('
			SELECT SUM(advertisement_views) AS advertisement_views, MAX(advertisement_last_view) AS advertisement_last_view
			FROM Advertisement
			WHERE company_id = ?
		', array($company_id));
	}

	function add_advertisement_view($advertisement_id)
	{
		$this->db->set('advertisement_views', 'advertisement_views + 1', false);
		$this->db->set('advertisement_last_view', 'NOW()', false);

		$this->db->where('advertisement_id', $advertisement_id);
		return $this->db->update('Advertisement');
	}

	function get_advertisement_statistics_top($company_id)
	{
		return $this->db->query('
			SELECT advertisement_title, advertisement_views
			FROM Advertisement
			WHERE company_id = ?
			ORDER BY advertisement_views DESC
			LIMIT 3
		', array($company_id));
	}

}
?>