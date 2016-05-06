<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wallpaper_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function data($id=""){
    	if($id==""){
           $query=$this->db->query("SELECT * FROM Wallpaper");
        }else{
            $query=$this->db->query("SELECT * FROM Wallpaper WHERE wallpaper_id='$id'");
        }
        return $query;
    }

}

?>