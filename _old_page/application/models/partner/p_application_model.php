<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class P_application_model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_application($p_group_id = "", $p_category_name = "", $p_application_id = ""){
        $db_default = $this->load->database('partner', TRUE);
        if($p_application_id == ""){
            $query = $db_default->query("SELECT * FROM ApplicationAccessList INNER JOIN Application ON(ApplicationAccessList.application_id = Application.application_id AND ApplicationAccessList.category_id = Application.category_id) INNER JOIN ApplicationCategory ON(Application.category_id = ApplicationCategory.category_id) WHERE group_id = ? AND LOWER(category_name) = LOWER(?) ORDER BY application_priority ASC", array($p_group_id, $p_category_name));
        }else{
            $query = $db_default->query("SELECT * FROM ApplicationAccessList INNER JOIN Application ON(ApplicationAccessList.application_id = Application.application_id AND ApplicationAccessList.category_id = Application.category_id) INNER JOIN ApplicationCategory ON(Application.category_id = ApplicationCategory.category_id) WHERE group_id = ? AND LOWER(category_name) = LOWER(?) AND Application.application_id = ? ", array($p_group_id, $p_category_name, $p_application_id));
        }       
        return $query;
    }

    function get_model($p_category_id, $p_application_id){
        $db_default = $this->load->database('partner', TRUE);
        $query = $db_default->query("SELECT * FROM ApplicationModel INNER JOIN Model USING(model_id) WHERE category_id = ? AND application_id = ? ", array($p_category_id, $p_application_id));
        return $query;
    }

    function get_library($p_category_id, $p_application_id){
        $db_default = $this->load->database('partner', TRUE);
        $query = $db_default->query("SELECT * FROM ApplicationLibrary INNER JOIN Library USING(library_id) WHERE category_id = ? AND application_id = ? ", array($p_category_id, $p_application_id));
        return $query;
    }

    function get_helper($p_category_id, $p_application_id){
        $db_default = $this->load->database('partner', TRUE);
        $query = $db_default->query("SELECT * FROM ApplicationHelper INNER JOIN Helper USING(helper_id) WHERE category_id = ? AND application_id = ? ", array($p_category_id, $p_application_id));
        return $query;
    }

    function get_language_file($p_category_id, $p_application_id){
        $db_default = $this->load->database('partner', TRUE);
        $query = $db_default->query("SELECT * FROM ApplicationLanguageFile INNER JOIN LanguageFile USING(file_id) WHERE category_id = ? AND application_id = ? ", array($p_category_id, $p_application_id));
        return $query;
    }

}

?>