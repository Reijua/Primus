<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed_Model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_privilege($p_group_id = "", $p_type_name = "") {
		$query = $this->db->query(
		   "SELECT * 
			FROM Model INNER JOIN ModelPrivilege USING(model_id) INNER JOIN ModelPrivilegeType USING(type_id) 
			WHERE group_id = ? AND UPPER(type_name) = UPPER(?) AND LOWER(model_name) = LOWER('Feed_Model')", array($p_group_id, $p_type_name));
		
		return $query;
	}

	function create_feedpost($p_company, $p_text, $p_image_path) {
		$db_member = $this->load->database('member', TRUE);

		if (empty($p_image_path)) {
			$db_member->query(
			   "INSERT INTO FeedPost (company_id, date_added, text) 
				VALUES (?, NOW(), ?)", array($p_company, nl2br($p_text)));
		} else {
			$db_member->query(
			   "INSERT INTO FeedPost (company_id, date_added, text, image_url) 
				VALUES (?, NOW(), ?, ?)", array($p_company, nl2br($p_text), $p_image_path));
		}

        return $db_member->insert_id();
	}

	function get_feedposts($p_company = "") {
		$db_member = $this->load->database('member', TRUE);

		if ($p_company != "") {
			$query = $db_member->query(
			   "SELECT * 
				FROM FeedPost INNER JOIN Company USING(company_id) 
				WHERE Company.company_id = ? 
				ORDER BY date_added DESC", array($p_company));
		} else {
			$query = $db_member->query(
			   "SELECT * 
				FROM FeedPost INNER JOIN Company USING(company_id) 
				ORDER BY date_added DESC");
		}

		return $query;
	}

	function get_feedads($p_company = "") {
		$db_member = $this->load->database('member', TRUE);

		if ($p_company != "") {
			$query = $db_member->query(
			   "SELECT * 
				FROM FeedAd INNER JOIN Company USING(company_id) 
				WHERE Company.company_id = ? 
				ORDER BY date_added DESC", array($p_company));
		} else {
			$query = $db_member->query(
			   "SELECT * 
				FROM FeedAd INNER JOIN Company USING(company_id) 
				ORDER BY date_added DESC");
		}

		return $query;
	}

}

?>