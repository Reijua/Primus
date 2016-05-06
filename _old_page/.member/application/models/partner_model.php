<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partner_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    /*****************/
    /* Privilege (s) */
    /*****************/

    function get_privilege($p_group_id = 1, $p_type_name){
        $db_default = $this->load->database('default', TRUE);
        $query = $db_default->query("SELECT * FROM Model INNER JOIN ModelPrivilege USING(model_id) INNER JOIN ModelPrivilegeType USING(type_id) WHERE group_id = ? AND UPPER(type_name) = UPPER(?) AND LOWER(model_name) = LOWER('Partner_Model')", array($p_group_id, $p_type_name));
        return $query;
    }

    /*****************/
    /* Privilege (e) */
    /*****************/

    function get_banner($p_cdn_url = "", $p_banner_name = ""){
        $v_url = null;
        if(file_exists(FCPATH."../resource/image/company/banner/".$p_banner_name.".png")){
            $v_url = $p_cdn_url."image/company/banner/".$p_banner_name.".png";
        }else if(file_exists(FCPATH."../resource/image/company/banner/".$p_banner_name.".jpg")){
            $v_url = $p_cdn_url."image/company/banner/".$p_banner_name.".jpg";
        }else if(file_exists(FCPATH."../resource/image/company/banner/".$p_banner_name.".jpeg")){
            $v_url = $p_cdn_url."image/company/banner/".$p_banner_name.".jpeg";
        }else{
            $v_url = "";
        }
        return $v_url;
    }

    function get_logo($p_cdn_url = "", $p_picture_name = ""){
        $v_url = null;
        if(file_exists(FCPATH."../resource/image/company/logo/".$p_picture_name.".png")){
            $v_url = $p_cdn_url."image/company/logo/".$p_picture_name.".png";
        }else if(file_exists(FCPATH."../resource/company/logo/".$p_picture_name.".jpg")){
            $v_url = $p_cdn_url."image/company/logo/".$p_picture_name.".jpg";
        }else if(file_exists(FCPATH."../resource/company/logo/".$p_picture_name.".jpeg")){
            $v_url = $p_cdn_url."image/company/logo/".$p_picture_name.".jpeg";
        }else{
            $v_url = "";
        }
        return $v_url;
    }

    /***************/
    /* Partner (s) */
    /***************/

    function create_partner($p_name, $p_group, $p_email, $p_supporter, $p_comment){
        $db_partner = $this->load->database('partner', TRUE);
        $db_partner->query("INSERT INTO Company (company_name, group_id, company_email, supporter_id, company_comment, company_registration_date) VALUES(?, ?, ?, ?, ?, NOW())", array($p_name, $p_group, $p_email, $p_supporter, $p_comment));
        return $db_partner->insert_id();
    }

    function get_partner($p_command = "", $p_data = ""){
        $db_partner = $this->load->database('partner', TRUE);
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case 'filter':
                switch ($v_type[1]) {
                    case 'name': $query=$db_partner->query("SELECT * FROM Company WHERE LOWER(company_name) = LOWER(?) ", array($p_data));
                    break;
                    case 'email': $query=$db_partner->query("SELECT * FROM Company WHERE LOWER(company_email) = LOWER(?) ", array($p_data));
                    break;
                }
            break;
            case 'all':
                if($p_data != ""){
                    $query=$db_partner->query("SELECT * FROM Company INNER JOIN CompanyGroup USING(group_id) INNER JOIN CompanyStatus USING(status_id) WHERE company_id = ? ", array($p_data));
                }else{
                    $query=$db_partner->query("SELECT * FROM Company INNER JOIN CompanyGroup USING(group_id) INNER JOIN CompanyStatus USING(status_id)");
                }
            break;
        }
        return $query;
    }

    function update_partner($p_id, $p_name, $p_group, $p_email, $p_supporter, $p_comment){
        $db_partner = $this->load->database('partner', TRUE);
        $db_partner->query("UPDATE Company SET company_name = ?, group_id = ?, company_email = ?, supporter_id = ?, company_comment = ? WHERE company_id = ? ", array($p_name, $p_group, $p_email, $p_supporter, $p_comment, $p_id));
    }

    /***************/
    /* Partner (e) */
    /***************/

    /*************/
    /* Group (s) */
    /*************/

    function get_group(){
        $db_partner = $this->load->database('partner', TRUE);
        $query = $db_partner->query("SELECT * FROM CompanyGroup WHERE group_visibility = 1");
        return $query;
    }

    /*************/
    /* Group (e) */
    /*************/

    /***************/
    /* Gallery (s) */
    /***************/

    function create_gallery_folder($p_id){
        mkdir(FCPATH."../resource/image/company/gallery/".$p_id."/");
    }

    /***************/
    /* Gallery (e) */
    /***************/

    /****************/
    /* Download (s) */
    /****************/

    function create_download_folder($p_id){
        mkdir(FCPATH."../resource/download/company/".$p_id."/");
    }

    /****************/
    /* Download (e) */
    /****************/

    function is_locked($p_company_id = ""){
        $db_partner = $this->load->database('partner', TRUE);
        $query=$db_partner->query("SELECT * FROM CompanyBlocking WHERE company_id = ? AND SYSDATE() BETWEEN blocking_start_date AND IFNULL(blocking_end_date, DATE_ADD(SYSDATE(), INTERVAL 1 DAY))", array($p_company_id));
        return $query;
    }

    function lock_partner(){
        $db_partner = $this->load->database('partner', TRUE);
    }

    function unlock_partner(){
        $db_partner = $this->load->database('partner', TRUE);
    }
}