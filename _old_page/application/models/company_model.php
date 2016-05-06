<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_company($p_command = "", $p_data = ""){
        $database_partner = $this->load->database('partner', TRUE);
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case "filter":
                switch ($v_type[1]) {
                    case "partner":
                        $query =  $database_partner->query("SELECT * FROM Company WHERE company_partner = '1'");
                    break;
                }
            break;
            case "all":
                if($p_data == ""){
                    $query = $database_partner->query("SELECT * FROM Company c INNER JOIN Location l ON(l.location_id = c.location_id)");
                }else{
                    $query = $database_partner->query("SELECT * FROM Company WHERE company_id = ? ", array($p_data));
                }
            break;
        }
        return $query;
    }

    function get_website($p_partner_id, $p_type_name = ""){
        $database_partner = $this->load->database('partner', TRUE);
        switch ($p_type_name) {
            case "WEBSITE": $query = $database_partner->query("SELECT * FROM CompanyWebsite INNER JOIN CompanyWebsiteType WHERE company_id = ? AND UPPER(type_name) = UPPER('Website')", array($p_partner_id));
            break;
        }
        return $query;
    }
	
	function get_logo($p_resource_url, $p_picture_name){
        $v_url = "";
        if(file_exists(FCPATH."resource/image/partner/logo/".$p_picture_name.".png")){
            $v_url = $p_resource_url."image/partner/logo/".$p_picture_name.".png";
        }else if(file_exists(FCPATH."resource/image/partner/logo/".$p_picture_name.".jpg")){
            $v_url = $p_resource_url."image/partner/logo/".$p_picture_name.".jpg";
        }else if(file_exists(FCPATH."resource/image/partner/logo/".$p_picture_name.".jpeg")){
            $v_url = $p_resource_url."image/partner/logo/".$p_picture_name.".jpeg";
        }else{
            $v_url = $p_resource_url."image/partner/logo/default.png";
        }
        return $v_url;
    }

}

?>