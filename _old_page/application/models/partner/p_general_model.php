<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_month($month_id = ""){
        if($month_id == ""){
            $query = $this->db->query("SELECT * FROM Month ORDER BY month_id");
        }else{
            $query = $this->db->query("SELECT * FROM Month WHERE month_id = '$month_id'");
        }       
        return $query;
    }

    function get_gender($p_gender_id = ""){
        if($p_gender_id==""){
            $query = $this->db->query("SELECT * FROM Gender ORDER BY gender_id");
        }else{
            $query = $this->db->query("SELECT * FROM Gender WHERE gender_id = ? ", array($p_gender_id));
        }       
        return $query;
    }

    function get_country($p_country_id = ""){
        if($p_country_id==""){
            $query = $this->db->query("SELECT * FROM Country");
        }else{
            $query = $this->db->query("SELECT * FROM Country WHERE country_id = ? ", array($p_country_id));
        }       
        return $query;
    }

    function get_branche($p_branche_id = ""){
        if($p_branche_id==""){
            $query = $this->db->query("SELECT * FROM Branche");
        }else{
            $query = $this->db->query("SELECT * FROM Branche WHERE branche_id = ? ", array($p_branche_id));
        }       
        return $query;
    }

    function get_website_type($p_type_id = ""){
        $db_default = $this->load->database('default', TRUE);
        if($p_type_id == ""){
            $query = $db_default->query("SELECT * FROM CompanyWebsiteType");
        }else{
            $query = $db_default->query("SELECT * FROM CompanyWebsiteType WHERE type_id = ? ", array($p_type_id));
        }        
        return $query;
    }
}

?>