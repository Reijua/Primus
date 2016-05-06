<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_feed_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_feedposts($p_company = "") {
		$db_default = $this->load->database('default', TRUE);

		if ($p_company != "") {
			$query = $db_default->query(
			   "SELECT * 
				FROM FeedPost INNER JOIN Company USING(company_id) 
				WHERE Company.company_id = ? 
				ORDER BY date_added DESC", array($p_company));
		} else {
			$query = $db_default->query(
			   "SELECT * 
				FROM FeedPost INNER JOIN Company USING(company_id) 
				ORDER BY date_added DESC");
		}

		return $query;
	}

	function get_feedads($p_company = "") {
		$db_default = $this->load->database('default', TRUE);

		if ($p_company != "") {
			$query = $db_default->query(
			   "SELECT * 
				FROM FeedAd INNER JOIN Company USING(company_id) 
				WHERE Company.company_id = ? 
				ORDER BY date_added DESC", array($p_company));
		} else {
			$query = $db_default->query(
			   "SELECT * 
				FROM FeedAd INNER JOIN Company USING(company_id) 
				ORDER BY date_added DESC");
		}

		return $query;
	}
	
	//TODO: Autoupdate für last_shown, sobald man diesen Datensatz abruft.
}

?>