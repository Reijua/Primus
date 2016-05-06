<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class P_account_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    /************/
    /* Logo (s) */
    /************/

    function get_logo($p_resource_url, $p_picture_name){
        $v_url = "";
        if(file_exists(FCPATH."/resource/image/partner/logo/".$p_picture_name.".png")){
            $v_url = $p_resource_url."image/partner/logo/".$p_picture_name.".png";
        }else if(file_exists(FCPATH."/resource/image/partner/logo/".$p_picture_name.".jpg")){
            $v_url = $p_resource_url."image/partner/logo/".$p_picture_name.".jpg";
        }else if(file_exists(FCPATH."/resource/image/partner/logo/".$p_picture_name.".jpeg")){
            $v_url = $p_resource_url."image/partner/logo/".$p_picture_name.".jpeg";
        }else{
            $v_url = $p_resource_url."image/partner/logo/default.png";
        }
        return $v_url;
    }

    function delete_logo($p_picture_name){
        switch (true) {
            case file_exists(FCPATH."../resource/image/partner/logo/".$p_picture_name.".png"):
                unlink(FCPATH."../resource/image/partner/logo/".$p_picture_name.".png");
            break;
            case file_exists(FCPATH."../resource/image/partner/logo/".$p_picture_name.".jpg"):
                unlink(FCPATH."../resource/image/partner/logo/".$p_picture_name.".jpg");
            break;
            case file_exists(FCPATH."../resource/image/partner/logo/".$p_picture_name.".jpeg"):
                unlink(FCPATH."../resource/image/partner/logo/".$p_picture_name.".jpeg");
            break;
        }
    }

    /************/
    /* Logo (e) */
    /************/

    /**************/
    /* Banner (s) */
    /**************/

    function get_banner($p_resource_url, $p_picture_name){
        $v_url = "";
        if(file_exists(FCPATH."/resource/image/partner/banner/".$p_picture_name.".png")){
            $v_url = $p_resource_url."image/partner/banner/".$p_picture_name.".png";
        }else if(file_exists(FCPATH."/resource/image/partner/banner/".$p_picture_name.".jpg")){
            $v_url = $p_resource_url."image/partner/banner/".$p_picture_name.".jpg";
        }else if(file_exists(FCPATH."/resource/image/partner/banner/".$p_picture_name.".jpeg")){
            $v_url = $p_resource_url."image/partner/banner/".$p_picture_name.".jpeg";
        }else{
            $v_url = $p_resource_url."image/partner/banner/1.jpg"; // Standard Banner
        }
        return $v_url; 
    }

    function delete_banner($p_picture_name){
        switch (true) {
            case file_exists(FCPATH."/resource/image/partner/banner/".$p_picture_name.".png"):
                unlink(FCPATH."/resource/image/partner/banner/".$p_picture_name.".png");
            break;
            case file_exists(FCPATH."/resource/image/partner/banner/".$p_picture_name.".jpg"):
                unlink(FCPATH."/resource/image/partner/banner/".$p_picture_name.".jpg");
            break;
            case file_exists(FCPATH."/resource/image/partner/banner/".$p_picture_name.".jpeg"):
                unlink(FCPATH."/resource/image/partner/banner/".$p_picture_name.".jpeg");
            break;
        }
    }

    /**************/
    /* Banner (e) */
    /**************/

    /***************/
    /* Partner (s) */
    /***************/

    function get_account($p_command = "", $p_data = ""){
        $db_default = $this->load->database('partner', TRUE);
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case 'filter': 
                switch ($v_type[1]) {
                    case 'email': $query=$db_default->query("SELECT * FROM Company INNER JOIN CompanyGroup USING(group_id) WHERE company_email = ?", array($p_data));
                    break;
                    case 'group': $query=$db_default->query("SELECT * FROM Company INNER JOIN CompanyGroup USING(group_id) WHERE UPPER(group_name) = UPPER(?) ORDER BY company_name", array($p_data));
                    break;
                }
            break;
            case 'all':
                if($p_data != ""){
                    $query=$db_default->query("SELECT * FROM Company INNER JOIN CompanyGroup USING(group_id) WHERE Company.company_id = ?", array($p_data));
                }else{
                    $query=$db_default->query("SELECT * FROM Company INNER JOIN CompanyGroup USING(group_id)");
                }
            break;
        }
        return $query;
    }

    function update_account($p_account_id, $p_location_id = "", $p_contact_id = "", $p_description = ""){
        $db_default = $this->load->database('partner', TRUE);
        $db_default->query("UPDATE Company SET location_id = ?, contact_id = ?, company_description = ? WHERE company_id = ? ", array($p_location_id, $p_contact_id, $p_description, $p_account_id));

    }

    /***************/
    /* Partner (e) */
    /***************/

    /***************/
    /* Contact (s) */
    /***************/

    function get_contact_portrait($p_resource_url, $p_account_id, $p_contact_id, $p_gender_id){
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

    function add_contact($p_account_id, $p_gender_id, $p_title, $p_firstname, $p_lastname, $p_position, $p_email, $p_phone, $p_fax, $p_tip){
        $db_default = $this->load->database('partner', TRUE);
        $db_default->query("INSERT INTO Contact(company_id, gender_id, contact_title, contact_firstname, contact_lastname, contact_position, contact_email, contact_phone, contact_fax, contact_tip) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array($p_account_id, $p_gender_id, $p_title, $p_firstname, $p_lastname, $p_position, $p_email, $p_phone, $p_fax, $p_tip));
        return $db_default->insert_id();
    }

    function get_contact($p_account_id, $p_command = "", $p_data = ""){
        $db_default = $this->load->database('partner', TRUE);
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case "all":
                if($p_data == ""){
                    $query = $db_default->query("SELECT * FROM Contact INNER JOIN Gender USING(gender_id) WHERE company_id = ?", array($p_account_id));
                }else{
                    $query = $db_default->query("SELECT * FROM Contact INNER JOIN Gender USING(gender_id) WHERE company_id = ? AND contact_id = ? ", array($p_account_id, $p_data));
                }
            break;
        }        
        return $query;
    }

    function update_contact($p_account_id, $p_contact_id, $p_gender_id, $p_title, $p_firstname, $p_lastname, $p_position, $p_email, $p_phone, $p_fax, $p_tip){
        $db_default = $this->load->database('partner', TRUE);
        $db_default->query("UPDATE Contact SET gender_id = ?, contact_title = ?, contact_firstname = ?, contact_lastname = ?, contact_position = ?, contact_email = ?, contact_phone = ?, contact_fax = ?, contact_tip = ? WHERE company_id = ? AND contact_id = ? ", array($p_gender_id, $p_title, $p_firstname, $p_lastname, $p_position, $p_email, $p_phone, $p_fax, $p_tip, $p_account_id, $p_contact_id));
    }

    function delete_contact($p_account_id, $p_contact_id){
        $db_default = $this->load->database('partner', TRUE);
        $db_default->query("DELETE FROM Contact wHERE company_id = ? AND contact_id = ? ", array($p_account_id, $p_contact_id));

    }


    /***************/
    /* Contact (e) */
    /***************/

    /****************/
    /* Location (s) */
    /****************/

    function get_location($p_account_id = "", $p_command = "", $p_data = ""){
        $db_default = $this->load->database('partner', TRUE);
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case "all":
                if($p_data == ""){
                    $query = $db_default->query("SELECT * FROM Location INNER JOIN Country USING(country_id) WHERE company_id = ? ", array($p_account_id));
                }else{
                    $query = $db_default->query("SELECT * FROM Location INNER JOIN Country USING(country_id) WHERE company_id = ? AND location_id = ? ", array($p_account_id, $p_data));
                }
            break;
        }
        return $query;
    }

    /****************/
    /* Location (e) */
    /****************/

    /****************/
    /* Property (s) */
    /****************/

    function add_property($p_account_id, $p_property_name = "", $p_property_text = ""){
        $db_default = $this->load->database('partner', TRUE);
        $query = $db_default->query("INSERT INTO CompanyProperty(company_id, property_name, property_text) VALUES(?, ?, ?)", array($p_account_id, $p_property_name, $p_property_text));
    }

    function get_property($p_account_id){
        $db_default = $this->load->database('partner', TRUE);
        $query = $db_default->query("SELECT * FROM CompanyProperty WHERE company_id = ? ", array($p_account_id));
        return $query;
    }

    function remove_properties($p_account_id){
        $db_default = $this->load->database('partner', TRUE);
        $query = $db_default->query("DELETE FROM CompanyProperty WHERE company_id = ? ", array($p_account_id));
    }

    /****************/
    /* Property (e) */
    /****************/

    /***************/
    /* Branche (s) */
    /***************/

    function add_branche($p_account_id, $p_branche_id){
        $db_default = $this->load->database('partner', TRUE);
        $query = $db_default->query("INSERT INTO CompanyBranche(company_id, branche_id) VALUES(?, ?)", array($p_account_id, $p_branche_id));
        return $db_default;
    }

    function get_branche($p_account_id, $p_branche_id = ""){
        $db_default = $this->load->database('partner', TRUE);
        if( $p_branche_id == ""){
            $query = $db_default->query("SELECT * FROM CompanyBranche INNER JOIN Branche USING(branche_id) WHERE company_id = ? ", array($p_account_id));
        }else{
            $query = $db_default->query("SELECT * FROM CompanyBranche WHERE company_id = ? AND branche_id = ? ", array($p_account_id, $p_branche_id));
        }        
        return $query;
    }

    function remove_branche($p_account_id){
        $db_default = $this->load->database('partner', TRUE);
        $query = $db_default->query("DELETE FROM CompanyBranche WHERE company_id = ?", array($p_account_id));
        return $db_default;
    }

    /***************/
    /* Branche (e) */
    /***************/

    /************/
    /* Link (s) */
    /************/

    function add_website($p_account_id, $p_website_name, $p_type_id, $p_website_url){
        $db_default = $this->load->database('partner', TRUE);
        $db_default->query("INSERT INTO CompanyWebsite(company_id, website_name, type_id, website_url) VALUES(?, ?, ?, ?)", array($p_account_id, $p_website_name, $p_type_id, $p_website_url));
    }

    function get_link($p_account_id, $p_type = ""){
        $db_default = $this->load->database('partner', TRUE);
        switch ($p_type) {
            case 'WEBSITE': $query = $db_default->query("SELECT * FROM CompanyWebsite INNER JOIN CompanyWebsiteType USING(type_id) WHERE company_id = ? AND UPPER(type_name)=UPPER('Firmenwebsite')", array($p_account_id));
            break;
            case 'CAREER': $query = $db_default->query("SELECT * FROM CompanyWebsite INNER JOIN CompanyWebsiteType USING(type_id) WHERE company_id = ? AND UPPER(type_name)=UPPER('Karriereportal')", array($p_account_id));
            break;
            case 'SOCAIL_NETWORK': $query = $db_default->query("SELECT * FROM CompanyWebsite INNER JOIN CompanyWebsiteType USING(type_id) WHERE company_id = ? AND type_name IN( 'Facebook', 'Google +', 'LinkedIn', 'Twitter', 'Xing', 'YouTube' )", array($p_account_id));
            break;
            case 'ALL': $query = $db_default->query("SELECT * FROM CompanyWebsite INNER JOIN CompanyWebsiteType USING(type_id) WHERE company_id = ? ", array($p_account_id));
            break;
        }
        return $query;
    }

    function remove_websites($p_account_id){
        $db_default = $this->load->database('partner', TRUE);
        $db_default->query("DELETE FROM CompanyWebsite WHERE company_id = ? ", array($p_account_id));

    }

    /************/
    /* Link (e) */
    /************/

    /****************/
    /* Password (s) */
    /****************/

    function password_hash($p_email, $p_password){
        return hash("sha512", '<-¡!->'.str_replace(array("%e", "%p"), array($p_email, $p_password), $this->config->item('encryption_key')).'<-!¡->');
    }

    function update_password($p_account_id, $p_hash){
        $db_default = $this->load->database('partner', TRUE);
        $db_default->query("UPDATE Company SET company_password_hash = ? WHERE company_id = ?", array($p_hash, $p_account_id));
    }

    /****************/
    /* Password (e) */
    /****************/

    /****************/
    /* Blocking (s) */
    /****************/

    function is_locked($p_account_id){
        $db_default = $this->load->database('partner', TRUE);
        $query=$db_default->query("SELECT * FROM CompanyBlocking WHERE company_id = ? AND SYSDATE() BETWEEN blocking_start_date AND IFNULL(blocking_end_date, DATE_ADD(SYSDATE(), INTERVAL 1 DAY))", array($p_account_id));
        return $query;
    }

    /****************/
    /* Blocking (e) */
    /****************/

    /***********************/
    /* Signin Blocking (s) */
    /***********************/

    function get_failed_login($p_account_id){
        $db_default = $this->load->database('partner', TRUE);
        $query = $this->db->query("SELECT * FROM CompanyLogin WHERE company_id = ?",array($p_account_id));
        return $query;
    }

    function log_failed_login($p_account_id, $p_ip_address){
        $db_default = $this->load->database('partner', TRUE);
        $db_default->query("INSERT INTO CompanyLogin(company_id, login_ip_address) VALUES(?, ?)",array($p_account_id, $p_ip_address));
    }

    function delete_failed_login($p_account_id){
        $db_default = $this->load->database('partner', TRUE);
        $db_default->query("DELETE FROM CompanyLogin WHERE company_id = ?",array($p_account_id));
    }

    /***********************/
    /* Signin Blocking (e) */
    /***********************/

    /****************/
    /* Recovery (s) */
    /****************/

    function create_recovery_code($p_account_id = "", $p_code = ""){
        $db_default = $this->load->database('partner', TRUE);
        $db_default->query("INSERT INTO CompanyRecovery(company_id, recovery_code) VALUES(?, ?)", array($p_account_id, $p_code));
    }

    function get_code($p_command="", $p_data = ""){
        $db_default = $this->load->database('partner', TRUE);
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case 'filter':
                switch ($v_type[1]) {
                    case 'last':
                        switch ($v_type[2]) {
                            case '24hours':
                                $query = $this->db->query("SELECT * FROM CompanyRecovery WHERE company_id = ? AND recovery_timestamp BETWEEN SYSDATE()-86400 AND SYSDATE()", array($p_data));
                            break;
                        }
                    break;
                    case 'current':
                        switch ($v_type[2]) {
                            case 'email':
                                $query = $db_default->query("SELECT * FROM CompanyRecovery INNER JOIN Company USING(company_id) WHERE company_email = ? AND recovery_timestamp = (SELECT MAX(recovery_timestamp) FROM CompanyRecovery WHERE company_id = Company.company_id AND recovery_timestamp BETWEEN SYSDATE()-300 AND SYSDATE())", array($p_data));
                            break;
                            case 'id':
                                $query = $db_default->query("SELECT * FROM CompanyRecovery INNER JOIN Company USING(company_id) WHERE company_id = ? AND recovery_timestamp = (SELECT MAX(recovery_timestamp) FROM CompanyRecovery WHERE company_id = Company.company_id AND recovery_timestamp BETWEEN SYSDATE()-300 AND SYSDATE())", array($p_data));
                            break;
                        }
                    break;
                }
            break;
            case 'all':
                $query = $this->db->query("SELECT * FROM CompanyRecovery WHERE company_id = ? ", array($p_data));
            break;
        }
        return $query;
    }

    /****************/
    /* Recovery (e) */
    /****************/

    /***********/
    /* Log (s) */
    /***********/

    function log_last_signin($p_account_id, $p_ip_address){
		$db_default = $this->load->database('partner', TRUE);
        $db_default->query("UPDATE Company SET company_last_ip = ? WHERE company_id= ?", array($p_ip_address, $p_account_id));
    }

    function log_activity($p_account_id, $p_message, $p_ip_address, $p_browser, $p_os){
        $db_default = $this->load->database('partner', TRUE);
		$db_default->query("INSERT INTO CompanyActivity (company_id, message_id, activity_ip_address, activity_data) VALUES(?, (SELECT message_id FROM CompanyActivityMessage WHERE LOWER(message_key_word) = LOWER(?) ), ?, ?)", array($p_account_id, $p_message, $p_ip_address, $p_browser.';'.$p_os));
    }

    /***********/
    /* Log (e) */
    /***********/

    

    

    
}

?>