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

    /*****************/
    /* Supporter (s) */
    /*****************/

    function get_supporter($p_suporter_id){
        $db_member = $this->load->database('member', TRUE);
        $query = $db_member->query("SELECT * FROM Member INNER JOIN Gender USING(gender_id) WHERE member_id = ? ", array($p_suporter_id));
        return $query;
    }

    /***************/
    /* Branche (s) */
    /***************/
}