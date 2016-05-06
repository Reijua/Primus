<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get_news($p_command = '', $p_data = '')
	{
		$type = preg_split("[:]", $p_command);

		if ($p_command != '') {
			switch ($type[0]) {
				case 'filter': 
					switch ($type[1]) {
						case 'id': 
							$query = $this->db->query('
								SELECT * 
								FROM News 
								WHERE news_id = ?
							', array($p_data));
						break;
					}
				break;

				case 'all':
					$query = $this->db->query('
						SELECT * 
						FROM News
						ORDER BY news_id DESC
					');
				break;
			}

			return $query;
		}

		return null;
	}
	
	function create_news($p_title, $p_text)
	{
		$this->db->set('news_title', $p_title);
		$this->db->set('news_text', $p_text);
		$this->db->insert('News');
		return $this->db->insert_id();
	}
	
	function delete_news($p_news_id)
	{
		$this->db->where('news_id', $p_news_id);
		return $this->db->delete('News');
	}
	
	function edit_news($p_news_id, $data)
	{
		if (array_key_exists('title', $data) && !is_null($data['title'])) 
		{
			$this->db->set('news_title', $data['title']);
		}

		if (array_key_exists('text', $data) && !is_null($data['text'])) 
		{
			$this->db->set('news_text', $data['text']);
		}

		if (array_key_exists('image_url', $data)) {
			$this->db->set('news_banner_image_url', $data['image_url']);
		}
		
		if (array_key_exists('images_folder_url', $data)) {
			$this->db->set('news_image_folder_url', $data['images_folder_url']);
		}

		$this->db->where('news_id', $p_news_id);
		return $this->db->update('News');
	}
}
?>