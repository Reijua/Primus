<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_gender(){
    	$query=$this->db->query("SELECT * FROM Gender");
        return $query;
    }

    function get_country(){
    	$query=$this->db->query("SELECT * FROM Country");
        return $query;
    }

}

?>