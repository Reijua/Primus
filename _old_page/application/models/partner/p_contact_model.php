<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class P_contact_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    /****************/
    /* Privileg (s) */
    /****************/

    function get_privilege($p_group_id, $p_type_name){
        $db_partner = $this->load->database('partner', TRUE);
        $query = $db_partner->query("SELECT * FROM Model INNER JOIN ModelPrivilege USING(model_id) INNER JOIN ModelPrivilegeType USING(type_id) WHERE group_id = ? AND UPPER(type_name) = UPPER(?) AND LOWER(model_name) = LOWER('Contact_Model')", array($p_group_id, $p_type_name));
        return $query;
    }

    /****************/
    /* Privileg (e) */
    /****************/

    /****************/
    /* Portrait (s) */
    /****************/

    function get_portrait($p_resource_url, $p_account_id, $p_contact_id, $p_gender_id){
        $v_url = "";
        if(file_exists(FCPATH."resource/image/partner/contact/".$p_account_id."/".$p_contact_id.".png")){
            $v_url = $p_resource_url."image/partner/contact/".$p_account_id."/".$p_contact_id.".png";
        }else if(file_exists(FCPATH."resource/image/partner/contact/".$p_account_id."/".$p_contact_id.".jpg")){
            $v_url = $p_resource_url."image/partner/contact/".$p_account_id."/".$p_contact_id.".jpg";
        }else if(file_exists(FCPATH."resource/image/partner/contact/".$p_account_id."/".$p_contact_id.".jpeg")){
            $v_url = $p_resource_url."image/partner/contact/".$p_account_id."/".$p_contact_id.".jpeg";
        }else{
            if($p_gender_id == 1){
                $v_url = $p_resource_url."image/partner/contact/female.png";
            }else{
                $v_url = $p_resource_url."image/partner/contact/male.png";
            }                
        }
        return $v_url;
    }

    function delete_portrait($p_account_id, $p_contact_id){
        switch (true) {
            case file_exists(FCPATH."resource/image/partner/contact/".$p_account_id."/".$p_contact_id.".png"):
                unlink(FCPATH."resource/image/partner/contact/".$p_account_id."/".$p_contact_id.".png");
            break;
            case file_exists(FCPATH."resource/image/partner/contact/".$p_account_id."/".$p_contact_id.".jpg"):
                unlink(FCPATH."resource/image/partner/contact/".$p_account_id."/".$p_contact_id.".jpg");
            break;
            case file_exists(FCPATH."resource/image/partner/contact/".$p_account_id."/".$p_contact_id.".jpeg"):
                unlink(FCPATH."resource/image/partner/contact/".$p_account_id."/".$p_contact_id.".jpeg");
            break;
        }
    }

    /****************/
    /* Portrait (e) */
    /****************/

    /***************/
    /* Contact (s) */
    /***************/

    function add_contact($p_account_id, $p_gender_id, $p_title, $p_firstname, $p_lastname, $p_position, $p_email, $p_phone, $p_fax, $p_tip){
        $db_partner = $this->load->database('partner', TRUE);
        $db_partner->query("INSERT INTO Contact(company_id, gender_id, contact_title, contact_firstname, contact_lastname, contact_position, contact_email, contact_phone, contact_fax, contact_tip) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array($p_account_id, $p_gender_id, $p_title, $p_firstname, $p_lastname, $p_position, $p_email, $p_phone, $p_fax, $p_tip));
        return $db_partner->insert_id();
    }

    function get_contact($p_account_id, $p_command = "", $p_data = ""){
        $db_partner = $this->load->database('partner', TRUE);
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case "all":
                if($p_data == ""){
                    $query = $db_partner->query("SELECT * FROM Contact INNER JOIN Gender USING(gender_id) WHERE company_id = ?", array($p_account_id));
                }else{
                    $query = $db_partner->query("SELECT * FROM Contact INNER JOIN Gender USING(gender_id) WHERE company_id = ? AND contact_id = ? ", array($p_account_id, $p_data));
                }
            break;
        }        
        return $query;
    }

    function update_contact($p_account_id, $p_contact_id, $p_gender_id, $p_title, $p_firstname, $p_lastname, $p_position, $p_email, $p_phone, $p_fax, $p_tip){
        $db_partner = $this->load->database('partner', TRUE);
        $db_partner->query("UPDATE Contact SET gender_id = ?, contact_title = ?, contact_firstname = ?, contact_lastname = ?, contact_position = ?, contact_email = ?, contact_phone = ?, contact_fax = ?, contact_tip = ? WHERE company_id = ? AND contact_id = ? ", array($p_gender_id, $p_title, $p_firstname, $p_lastname, $p_position, $p_email, $p_phone, $p_fax, $p_tip, $p_account_id, $p_contact_id));
    }

    function delete_contact($p_account_id, $p_contact_id){
        $db_partner = $this->load->database('partner', TRUE);
        $db_partner->query("DELETE FROM Contact WHERE company_id = ? AND contact_id = ? ", array($p_account_id, $p_contact_id));

    }

    /***************/
    /* Contact (e) */
    /***************/
    
}