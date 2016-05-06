<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Advertisement_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    /****************/
    /* Privileg (s) */
    /****************/

    function get_privilege($p_group_id, $p_type_name){
        $db_default = $this->load->database('default', TRUE);
        $query = $db_default->query("SELECT * FROM Model INNER JOIN ModelPrivilege USING(model_id) INNER JOIN ModelPrivilegeType USING(type_id) WHERE group_id = ? AND UPPER(type_name) = UPPER(?) AND LOWER(model_name) = LOWER('Advertisement_Model')", array($p_group_id, $p_type_name));
        return $query;
    }

    /****************/
    /* Privileg (e) */
    /****************/

    /**************/
    /* Banner (s) */
    /**************/

    function get_banner($p_resource_url, $p_advertisement_id){
        $v_url = "";
        if(file_exists(FCPATH."resource/image/advertisement/".$p_advertisement_id.".png")){
            $v_url = $p_resource_url."image/advertisement/".$p_advertisement_id.".png";
        }else if(file_exists(FCPATH."resource/image/advertisement/".$p_advertisement_id.".jpg")){
            $v_url = $p_resource_url."image/advertisement/".$p_advertisement_id.".jpg";
        }else if(file_exists(FCPATH."resource/image/advertisement/".$p_advertisement_id.".jpeg")){
            $v_url = $p_resource_url."image/advertisement/".$p_advertisement_id.".jpeg";
        }else{
            $v_url = "";
        }
        return $v_url;
    }

    /**************/
    /* Banner (e) */
    /**************/

    /*********************/
    /* Advertisement (s) */
    /*********************/

    function create_advertisement($p_name, $p_description, $p_start_start, $p_start_end, $p_url, $p_company_id){
        $db_default = $this->load->database('default', TRUE);
        $db_default->query("INSERT INTO Advertisement(advertisement_name, advertisement_description, advertisement_start_date, advertisement_end_date, advertisement_url, company_id) VALUES(?, ?, ?, ?, ?, ?)", array($p_name, $p_description, $p_start_start, $p_start_end, $p_url, $p_company_id));
        return $db_default->insert_id();
    }

    function get_advertisement($p_account_id, $p_command = "", $p_data = ""){
        $db_default = $this->load->database('default', TRUE);
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case "filter":
                switch ($v_type[1]) {
                    case "date":
                    if(!isset($v_type[2])){
                        $query = $db_default->query("SELECT * FROM Advertisement WHERE company_id = ? AND STR_TO_DATE(?,'%Y-%c-%d') BETWEEN advertisement_start_date AND advertisement_end_date", array($p_account_id, $p_data));
                    }else{
                        $query = $db_default->query("SELECT * FROM Advertisement WHERE company_id = ? AND advertisement_id != ? AND STR_TO_DATE(?,'%Y-%c-%d') BETWEEN advertisement_start_date AND advertisement_end_date", array($p_account_id, $v_type[2], $p_data));
                    }                    
                    break;
                }
            break;
            case "all":
                if($p_data == ""){
                    $query = $db_default->query("SELECT * FROM Advertisement WHERE company_id = ? ORDER BY advertisement_end_date DESC", array($p_account_id));
                }else{
                    $query = $db_default->query("SELECT * FROM Advertisement WHERE company_id = ? AND advertisement_id = ? ", array($p_account_id, $p_data));
                }
            break;
        }        
        return $query;
    }
    function update_advertisement($p_account_id, $p_advertisement_id, $p_name, $p_description, $p_start_start, $p_start_end, $p_url){
        $db_default = $this->load->database('default', TRUE);
        $db_default->query("UPDATE Advertisement SET advertisement_name = ?, advertisement_description = ?, advertisement_start_date = ?, advertisement_end_date = ?, advertisement_url = ? WHERE company_id = ? AND advertisement_id = ? ", array($p_name, $p_description, $p_start_start, $p_start_end, $p_url, $p_account_id, $p_advertisement_id));
    }

    /*********************/
    /* Advertisement (e) */
    /*********************/
    
}