<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_privileg($p_group_id = "", $p_type_name = ""){
        $query = $this->db->query("SELECT * FROM Model INNER JOIN ModelPrivilege USING(model_id) INNER JOIN ModelPrivilegeType USING(type_id) WHERE group_id = ? AND UPPER(type_name) = UPPER(?) AND LOWER(model_name) = LOWER('Member_Model')", array($p_group_id, $p_type_name));
        return $query;
    }

    function update_member($p_id = "", $p_salutation = "", $p_title = "", $p_firstname = "", $p_lastname = "", $p_birthday = "", $p_class = "", $p_group = ""){
        $this->db->query("UPDATE Member SET gender_id = ?, member_title = ?, member_firstname = ?, member_lastname = ?, member_birthday = ?, class_id = ?, group_id = ? WHERE member_id = ?", array($p_salutation, $p_title, $p_firstname, $p_lastname, $p_birthday, $p_class, $p_group, $p_id));
    }

    

    function unlock_member($p_member_id=""){
        $query=$this->db->query("UPDATE MemberBlocking SET blocking_end_date = SYSDATE() WHERE member_id = ? AND SYSDATE() BETWEEN blocking_start_date AND COALESCE(blocking_end_date, DATE_ADD(SYSDATE(), INTERVAL 1 DAY))", array($p_member_id));
        return $query;
    }

    function get_blocking($p_type="", $p_data=""){
        $v_type = preg_split("[:]", $p_type);
        switch ($v_type[0]) {
            case 'all':
            if($p_data==""){
                $query = $this->db->query("SELECT * FROM MemberBlocking");
            }else{
                $query = $this->db->query("SELECT * FROM MemberBlocking WHERE member_id = ? ORDER BY blocking_start_date DESC", array($p_data));
            }                
            break;
        }
        return $query;
    }

    function get_class(){
        $query = $this->db->query("SELECT * FROM Class");
        return $query;
    }

}

?>