<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_general_model extends CI_Model {

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

    function get_gender($gender_id = ""){
        if($gender_id==""){
             $query = $this->db->query("SELECT * FROM Gender ORDER BY gender_id");
        }else{
            $query = $this->db->query("SELECT * FROM Gender WHERE gender_id = '$gender_id'");
        }       
        return $query;
    }
}

?>