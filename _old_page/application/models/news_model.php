<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_banner($p_resource_url = "", $p_file_name = ""){
        $url = null;
        if(file_exists(FCPATH."resource/image/news/".$p_file_name.".png")){
            $url = $p_resource_url."image/news/".$p_file_name.".png";
        }else if(file_exists(FCPATH."resource/image/news/".$p_file_name.".jpg")){
            $url = $p_resource_url."image/news/".$p_file_name.".jpg";
        }else if(file_exists(FCPATH."resource/image/news/".$p_file_name.".jpeg")){
            $url = $p_resource_url."image/news/".$p_file_name.".jpeg";
        }else{
            $url = "";
        }
        return $url;
    }

    function get_news($p_command = "", $p_data = ""){
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case 'latest':
                $query = $this->db->query("SELECT * FROM News INNER JOIN NewsCategory USING(category_id) ORDER BY news_release_date DESC LIMIT 6");
            break;
            case 'all':
                if($p_data == ""){
                    $query = $this->db->query("SELECT * FROM News INNER JOIN NewsCategory USING(category_id) ORDER BY news_release_date DESC");
                }else{
                    $query = $this->db->query("SELECT * FROM News INNER JOIN NewsCategory USING(category_id) WHERE news_id = ? ", array($p_data));
                }
            break;
        }
        return $query;
    }

    function get_gallery($p_news_id = ""){
        $query = $this->db->query("SELECT * FROM NewsGallery INNER JOIN Gallery USING(gallery_id) WHERE news_id = ? ORDER BY gallery_release_date", array($p_news_id));
        return $query;
    }

}

?>