<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_package($value=""){
        if($value==""){
            $query=$this->db->query("SELECT * FROM Package ORDER BY package_id ASC");
        }else{
            if(is_int($value)){
                $query=$this->db->query("SELECT * FROM Package WHERE package_id=$value");
            }else{
                $query=$this->db->query("SELECT * FROM Package WHERE LOWER(package_name)=LOWER('$value')");
            }
            
        }    	
        return $query;
    }

}

?>