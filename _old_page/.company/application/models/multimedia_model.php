<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multimedia_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function add_video($account_id, $video_title, $video_url, $type_id){
        $this->db->query("INSERT INTO Video(company_id, video_name, video_url, type_id) VALUES($account_id, '$video_title', '$video_url', $type_id)");
    }

    function get_video($account_id="", $video_id=""){
        if($video_id==""){
            $query=$this->db->query("SELECT * FROM Video INNER JOIN VideoType USING(type_id) WHERE company_id = '$account_id'");
        }else{
            $query=$this->db->query("SELECT * FROM Video INNER JOIN VideoType USING(type_id) WHERE company_id = '$account_id' AND video_id = '$video_id'");
        }       
        return $query;
    }

    function delete_video($company_id, $video_id){
        $this->db->query("DELETE FROM Video WHERE company_id=$company_id AND video_id=$video_id");
    }

    function get_provider(){
        $query=$this->db->query("SELECT * FROM VideoType");
        return $query;
    }

    function get_photo($account_id="", $photo_id=""){
        if($photo_id==""){
            $query=$this->db->query("SELECT * FROM Photo");
        }else{
            $query=$this->db->query("SELECT * FROM Photo WHERE photo_id=$photo_id");
        }        
        return $query;
    }

    function delete_photo($account_id="", $photo_id=""){
        $this->db->query("DELETE FROM Photo WHERE photo_id=$photo_id AND company_id='$account_id'");
    }
}

?>