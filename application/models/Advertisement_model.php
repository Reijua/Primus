<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advertisement_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function create_advertisement($p_company_id, $p_title, $p_text, $p_start_date, $p_end_date, $p_url, $p_url_text, $p_image_url)
	{
		$this->db->set('company_id', $p_company_id);
		$this->db->set('advertisement_date_added', 'NOW()', false); // false => Don't escape the NOW() function
		$this->db->set('advertisement_title', $p_title);
		$this->db->set('advertisement_text', $p_text);
		$this->db->set('advertisement_start_date', $p_start_date);
		$this->db->set('advertisement_end_date', $p_end_date);
		$this->db->set('advertisement_url', $p_url);
		$this->db->set('advertisement_url_text', $p_url_text);
		$this->db->set('advertisement_image_url', $p_image_url);

		$this->db->insert('Advertisement');

		return $this->db->insert_id();
	}

	function edit_advertisement($advertisement_id, $data)
	{
		if (array_key_exists('title', $data) && !is_null($data['title'])) {
			$this->db->set('advertisement_title', $data['title']);
		}

		if (array_key_exists('text', $data) && !is_null($data['text'])) {
			$this->db->set('advertisement_text', $data['text']);
		}

		if (array_key_exists('start_date', $data) && !is_null($data['start_date'])) {
			$start_date = DateTime::createFromFormat('d.m.Y', $data['start_date'])->format('Y-m-d');
			$this->db->set('advertisement_start_date', $start_date);
		}

		if (array_key_exists('end_date', $data) && !is_null($data['end_date'])) {
			$end_date = DateTime::createFromFormat('d.m.Y', $data['end_date'])->format('Y-m-d');
			$this->db->set('advertisement_end_date', $end_date);
		}

		if (array_key_exists('url', $data) && !is_null($data['url'])) {
			$this->db->set('advertisement_url', $data['url']);
		}

		if (array_key_exists('url_text', $data) && !is_null($data['url_text'])) {
			$this->db->set('advertisement_url_text', $data['url_text']);
		}

		if (array_key_exists('image_url', $data)) {
			$this->db->set('advertisement_image_url', $data['image_url']);
		}

		$this->db->where('advertisement_id', $advertisement_id);
		return $this->db->update('Advertisement');
	}

	function toggle_advertisement($p_advertisement_id)
	{
		// Toggle advertisement_enabled from 1 to 0 and vice-versa
		$this->db->set('advertisement_enabled', '1 - advertisement_enabled', false);

		$this->db->where('advertisement_id', $p_advertisement_id);
		return $this->db->update('Advertisement');
	}

	function delete_advertisement($p_advertisement_id)
	{
		$this->db->where('advertisement_id', $p_advertisement_id);
		return $this->db->delete('Advertisement');
	}

	function get_advertisement($p_command = '', $p_data = '')
	{
		$type = preg_split("[:]", $p_command);

		if ($p_command != '') {
			switch ($type[0]) {
				case 'filter': 
					switch ($type[1]) {
						case 'id': 
							$query = $this->db->query('
								SELECT * 
								FROM Advertisement 
								WHERE advertisement_id = ?
							', array($p_data));
						break;

						case 'company': 
							$query = $this->db->query('
								SELECT * 
								FROM Advertisement 
								WHERE company_id = ?
								ORDER BY advertisement_date_added ASC
							', array($p_data));
						break;

						case 'date': 
							$query = $this->db->query('
								SELECT * 
								FROM Advertisement 
								WHERE STR_TO_DATE(?, "%d.%m.%Y") BETWEEN advertisement_start_date 
									AND advertisement_end_date
								ORDER BY advertisement_date_added ASC
							', array($p_data));
						break;

						case 'active': 
							$query = $this->db->query('
								SELECT * 
								FROM Advertisement 
								WHERE NOW() BETWEEN advertisement_start_date 
									AND advertisement_end_date AND advertisement_enabled = 1
								ORDER BY advertisement_date_added ASC
							');
						break;
					}
				break;

				case 'all':
					$query = $this->db->query('
						SELECT * 
						FROM Advertisement 
						ORDER BY advertisement_date_added ASC
					');
				break;
			}

			return $query;
		}

		return null;
	}
}
?>