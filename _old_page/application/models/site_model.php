<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_Model extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    /**************/
    /* Banner (s) */
    /**************/

    function get_banner($p_type = "", $p_resource_url = "", $p_file_name = ""){
        $url = null;
        switch ($p_type) {
            case "category":
                if(file_exists(FCPATH."resource/image/intl/category/".$p_file_name.".png")){
                    $url = $p_resource_url."image/intl/category/".$p_file_name.".png";
                }else if(file_exists(FCPATH."resource/image/intl/category/".$p_file_name.".jpg")){
                    $url = $p_resource_url."image/intl/category/".$p_file_name.".jpg";
                }else if(file_exists(FCPATH."resource/image/intl/category/".$p_file_name.".jpeg")){
                    $url = $p_resource_url."image/intl/category/".$p_file_name.".jpeg";
                }else{
                    $url = "";
                }
            break;            
            case "site":
                if(file_exists(FCPATH."resource/image/intl/site/".$p_file_name.".png")){
                    $url = $p_resource_url."image/intl/site/".$p_file_name.".png";
                }else if(file_exists(FCPATH."resource/image/intl/site/".$p_file_name.".jpg")){
                    $url = $p_resource_url."image/intl/site/".$p_file_name.".jpg";
                }else if(file_exists(FCPATH."resource/image/intl/site/".$p_file_name.".jpeg")){
                    $url = $p_resource_url."image/intl/site/".$p_file_name.".jpeg";
                }else{
                    $url = "";
                }
            break;
        }        
        return $url;
    }

    /**************/
    /* Banner (e) */
    /**************/

    /****************/
    /* Category (s) */
    /****************/

    function get_category($p_category_tag=""){
        if($p_category_tag == ""){
            $query=$this->db->query("SELECT * FROM SiteCategory");
        }else{
            $query=$this->db->query("SELECT * FROM SiteCategory WHERE LOWER(category_tag) = LOWER(?)", array($p_category_tag)); 
        }        
        return $query;
    }

    /****************/
    /* Category (e) */
    /****************/

    /************/
    /* Site (s) */
    /************/

    function get_site($p_command = "", $p_data = ""){
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case 'filter':
                switch ($v_type[1]) {
                    case 'category':
                        $query=$this->db->query("SELECT * FROM Site INNER JOIN SiteCategory USING(category_id) WHERE LOWER(category_tag)=LOWER(?) ORDER BY site_name", array($p_data));
                    break;
                }
            break;
            case 'all':
                if($p_data == ""){
                    $query=$this->db->query("SELECT * FROM Site INNER JOIN SiteCategory USING(category_id)");
                }else{
                    $v_parameter = preg_split("[:]", $p_data);
                    $query=$this->db->query("SELECT * FROM Site INNER JOIN SiteCategory USING(category_id) WHERE LOWER(category_tag)=LOWER(?) AND LOWER(site_tag) = LOWER(?) ORDER BY site_name", array($v_parameter[0], $v_parameter[1]));
                }
            break;
        }
        return $query;
    }

    /************/
    /* Site (e) */
    /************/
}

?>