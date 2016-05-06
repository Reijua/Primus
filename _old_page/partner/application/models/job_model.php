<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    /*****************/
    /* Privilege (s) */
    /*****************/

    function get_privilege($p_group_id, $p_type_name){
        $db_default = $this->load->database('default', TRUE);
        $query = $db_default->query("SELECT * FROM Model INNER JOIN ModelPrivilege USING(model_id) INNER JOIN ModelPrivilegeType USING(type_id) WHERE group_id = ? AND UPPER(type_name) = UPPER(?) AND LOWER(model_name) = LOWER('Job_Model')", array($p_group_id, $p_type_name));
        return $query;
    }

    /*****************/
    /* Privilege (e) */
    /*****************/

    function create_job($p_account_id, $p_title, $p_contact_id, $p_location_id, $p_preamble, $p_summary){
        $db_default = $this->load->database('default', TRUE);
        $db_default->query("INSERT INTO Job (company_id, job_title, location_id, contact_id, job_release_date, job_preamble, job_summary) VALUES(?, ?, ?, ?, NOW(), ?, ?)", array($p_account_id, $p_title, $p_contact_id, $p_location_id, $p_preamble, $p_summary));
        return $db_default->insert_id();
    }

    function get_job($p_account_id, $p_command = "", $p_data = ""){
        $db_default = $this->load->database('default', TRUE);
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case "filter":
                switch ($v_type[1]) {
                    case "open": $query=$db_default->query("SELECT * FROM Job INNER JOIN JobStatus USING(status_id) WHERE company_id = ? AND UPPER(status_name)=UPPER('OPEN') ORDER BY job_release_date DESC", array($p_account_id));
                    break;
                    case "closed": $query=$db_default->query("SELECT * FROM Job INNER JOIN JobStatus USING(status_id) WHERE company_id = ? AND UPPER(status_name)=UPPER('CLOSED') ORDER BY job_close_date DESC", array($p_account_id));
                    break;
                    case "year": $query=$db_default->query("SELECT * FROM Job INNER JOIN JobStatus USING(status_id) WHERE company_id = ? AND DATE_FORMAT(job_release_date, '%Y') = DATE_FORMAT(SYSDATE(), '%Y')", array($p_account_id));
                    break;
                }
            break;
            case "all":
                if($p_data==""){
                    $query=$db_default->query("SELECT * FROM Job INNER JOIN JobStatus USING(status_id) WHERE company_id = ? ORDER BY job_release_date DESC", array($p_account_id));
                }else{
                    $query=$db_default->query("SELECT * FROM Job INNER JOIN JobStatus USING(status_id) WHERE company_id = ? AND job_id = ? ", array($p_account_id, $p_data));
                }
            break;
        }        
        return $query;
    }

    function update_job($p_account_id, $job_id, $p_title, $p_contact_id, $p_location_id, $p_preamble, $p_summary){
        $db_default = $this->load->database('default', TRUE);
        $db_default->query("UPDATE Job SET job_title = ?, location_id = ?, contact_id = ?, job_preamble = ?, job_summary = ? WHERE company_id = ? AND job_id = ? ", array($p_title, $p_contact_id, $p_location_id, $p_preamble, $p_summary, $p_account_id, $job_id));
        
    }

    /***************/
    /* Section (s) */
    /***************/

    function add_section_item($p_job_id, $p_section_id, $p_text){
        $db_default = $this->load->database('default', TRUE);
        $db_default->query("INSERT INTO JobSectionItem(job_id, section_id, item_text) VALUES(?, ?, ?) ", array($p_job_id, $p_section_id, $p_text));
    }

    function get_section_item($p_job_id = "", $p_section_name = ""){
        $db_default = $this->load->database('default', TRUE);
        $query=$db_default->query("SELECT * FROM JobSectionItem INNER JOIN JobSection USING(section_id) WHERE job_id = ? AND LOWER(section_name) = LOWER(?) ", array($p_job_id, $p_section_name));
        return $query;
    }

    function remove_section_items($p_job_id, $p_section_id){
        $db_default = $this->load->database('default', TRUE);
        $db_default->query("DELETE FROM JobSectionItem WHERE job_id = ? AND section_id = ? ", array($p_job_id, $p_section_id));

    }

    /***************/
    /* Section (e) */
    /***************/

    /**************/
    /* Status (s) */
    /**************/

    function change_status($p_account_id, $p_job_id, $p_status_name){
        $db_default = $this->load->database('default', TRUE);
        switch (strtoupper($p_status_name)) {
            case "OPEN": $db_default->query("UPDATE Job SET status_id = 1, job_close_date = NULL WHERE company_id = ? AND job_id = ? ", array($p_account_id, $p_job_id));
            break;
            case "CLOSED": $db_default->query("UPDATE Job SET status_id = 2, job_close_date = NOW() WHERE company_id = ? AND job_id = ? ", array($p_account_id, $p_job_id));
            break;
        }
    }

    /**************/
    /* Status (e) */
    /**************/



}

?>