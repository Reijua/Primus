<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function data($filter=""){
        if($filter==""){
            $query=$this->db->query("SELECT * FROM Language ORDER BY language_description ASC");
        }else{
            $query=$this->db->query("SELECT * FROM Language WHERE language_tag='$filter'");
        }    	
        return $query;
    }

}

?>