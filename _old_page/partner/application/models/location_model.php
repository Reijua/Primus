<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    /*****************/
    /* Privilege (s) */
    /*****************/

    function get_privilege($p_group_id, $p_type_name){
        $db_default = $this->load->database('default', TRUE);
        $query = $db_default->query("SELECT * FROM Model INNER JOIN ModelPrivilege USING(model_id) INNER JOIN ModelPrivilegeType USING(type_id) WHERE group_id = ? AND UPPER(type_name) = UPPER(?) AND LOWER(model_name) = LOWER('Location_Model')", array($p_group_id, $p_type_name));
        return $query;
    }

    /*****************/
    /* Privilege (e) */
    /*****************/

    /***************/
    /* Contact (s) */
    /***************/

    function add_location($p_account_id, $p_name, $p_address, $p_pc, $p_city, $p_country_id){
        $db_default = $this->load->database('default', TRUE);
        $db_default->query("INSERT INTO Location(company_id, location_name, location_address, location_pc, location_city, country_id) VALUES(?, ?, ?, ?, ?, ?)", array($p_account_id, $p_name, $p_address, $p_pc, $p_city, $p_country_id));
    }

    function get_location($p_account_id, $p_command = "", $p_data = ""){
        $db_default = $this->load->database('default', TRUE);
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case "all":
                if($p_data == ""){
                    $query = $db_default->query("SELECT * FROM Location INNER JOIN Country USING(country_id) WHERE company_id = ?", array($p_account_id));
                }else{
                    $query = $db_default->query("SELECT * FROM Location INNER JOIN Country USING(country_id) WHERE company_id = ? AND location_id = ? ", array($p_account_id, $p_data));
                }
            break;
        }        
        return $query;
    }

    function update_location($p_account_id, $p_location_id, $p_name, $p_address, $p_pc, $p_city, $p_country_id){
        $db_default = $this->load->database('default', TRUE);
        $db_default->query("UPDATE Location SET location_name = ?, location_address = ?, location_pc = ?, location_city = ?, country_id = ? WHERE company_id = ? AND location_id = ? ", array($p_name, $p_address, $p_pc, $p_city, $p_country_id, $p_account_id, $p_location_id));
    }

    function delete_location($p_account_id, $p_location_id){
        $db_default = $this->load->database('default', TRUE);
        $db_default->query("DELETE FROM Location WHERE company_id = ? AND location_id = ? ", array($p_account_id, $p_location_id));
    }

    /***************/
    /* Contact (e) */
    /***************/
    
}