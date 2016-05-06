<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_advertisement_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_banner($p_resource_url, $p_advertisement_id){
		$v_url = "";
		if(file_exists(FCPATH."resource/image/advertisement/".$p_advertisement_id.".png")){
			$v_url = $p_resource_url."image/advertisement/".$p_advertisement_id.".png";
		}else if(file_exists(FCPATH."resource/image/advertisement/".$p_advertisement_id.".jpg")){
			$v_url = $p_resource_url."image/advertisement/".$p_advertisement_id.".jpg";
		}else if(file_exists(FCPATH."resource/image/advertisement/".$p_advertisement_id.".jpeg")){
			$v_url = $p_resource_url."image/advertisement/".$p_advertisement_id.".jpeg";
		}else{
			$v_url = "";
		}
		return $v_url;
	}

	function get_advertisement($p_command = "", $p_data = ""){
		$db_partner = $this->load->database('partner', TRUE);
		$v_type = preg_split("[:]", $p_command);
		switch ($v_type[0]) {
			case "filter":
				switch ($v_type[1]) {
					case "date":
					if(!isset($v_type[2])){
						$query = $db_partner->query("SELECT * FROM Advertisement INNER JOIN Company USING(company_id) WHERE STR_TO_DATE(?,'%Y-%c-%d') BETWEEN advertisement_start_date AND advertisement_end_date", array($p_data));
					}else{
						$query = $db_partner->query("SELECT * FROM Advertisement INNER JOIN Company USING(company_id) WHERE advertisement_id != ? AND STR_TO_DATE(?,'%Y-%c-%d') BETWEEN advertisement_start_date AND advertisement_end_date", array($v_type[2], $p_data));
					}					
					break;
				}
			break;
			case "all":
				if($p_data == ""){
					$query = $db_partner->query("SELECT * FROM Advertisement INNER JOIN Company USING(company_id) WHERE NOW() BETWEEN advertisement_start_date AND advertisement_end_date");
				}else{
					$query = $db_partner->query("SELECT * FROM Advertisement INNER JOIN Company USING(company_id) WHERE advertisement_id = ? ", array($p_data));
				}
			break;
		}		
		return $query;
	}
	
}