<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function create_post($p_company_id, $p_author_id, $p_title, $p_text, $p_image_url, $p_video_url)
	{
		$this->db->set('company_id', $p_company_id);
		$this->db->set('author_id', $p_author_id);
		$this->db->set('post_date_added', 'NOW()', false); // false => Don't escape the NOW() function
		$this->db->set('post_title', $p_title);
		$this->db->set('post_text', $p_text);
		$this->db->set('post_image_url', $p_image_url);
		$this->db->set('post_video_url', $p_video_url);

		$this->db->insert('Post');

		return $this->db->insert_id();
	}

	function edit_post($post_id, $data)
	{
		if (array_key_exists('title', $data) && !is_null($data['title'])) {
			$this->db->set('post_title', $data['title']);
		}

		if (array_key_exists('text', $data) && !is_null($data['text'])) {
			$this->db->set('post_text', $data['text']);
		}

		if (array_key_exists('image_url', $data)) {
			$this->db->set('post_image_url', $data['image_url']);
		}

		if (array_key_exists('video_url', $data)) {
			$this->db->set('post_video_url', $data['video_url']);
		}

		if (array_key_exists('attachment_url', $data)) {
			$this->db->set('post_attachment_url', $data['attachment_url']);
		}
		
		$this->db->where('post_id', $post_id);
		return $this->db->update('Post');
	}

	function delete_post($p_post_id)
	{
		$this->db->where('post_id', $p_post_id);
		return $this->db->delete('Post');
	}

	function get_post($p_command = '', $p_data = '')
	{
		$type = preg_split("[:]", $p_command);

		if ($p_command != '') {
			switch ($type[0]) {
				case 'filter': 
					switch ($type[1]) {
						case 'id': 
							$query = $this->db->query('
								SELECT Post.*, company_name
								FROM Post 
								INNER JOIN Company USING (company_id) 
								WHERE post_id = ?
							', array($p_data));
						break;

						case 'company': 
							$query = $this->db->query('
								SELECT Post.*, company_name
								FROM Post 
								INNER JOIN Company USING (company_id) 
								WHERE company_id = ?
								ORDER BY post_date_added ASC
							', array($p_data));
						break;
					}
				break;

				case 'all':
					$query = $this->db->query('
						SELECT Post.*, company_name
						FROM Post 
						INNER JOIN Company USING (company_id) 
						ORDER BY post_date_added ASC
					');
				break;
			}

			return $query;
		}

		return null;
	}
}
?>