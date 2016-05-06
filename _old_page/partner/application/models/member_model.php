<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_profile_picture($p_resource_url, $p_picture_name, $p_gender_id = "" ){
        $v_url = "";
        $p_picture_name = hash("sha256", str_replace("%s", $p_picture_name, $this->config->item("encryption_image_key")));
        if(file_exists(FCPATH."resource/image/profile/picture/".$p_picture_name.".png")){
            $v_url = "http://www.primus-romulus.net/resource/image/profile/picture/".$p_picture_name.".png";
        }else if(file_exists(FCPATH."resource/profile/picture/".$p_picture_name.".jpg")){
            $v_url = "http://www.primus-romulus.net/resource/image/profile/picture/".$p_picture_name.".jpg";
        }else if(file_exists(FCPATH."resource/profile/picture/".$p_picture_name.".jpeg")){
            $v_url = "http://www.primus-romulus.net/resource/image/profile/picture/".$p_picture_name.".jpeg";
        }else{
            switch ($p_gender_id) {
                case 1:
                    $v_url = "http://www.primus-romulus.net/resource/image/profile/picture/female.png";
                    break;
                default:
                    $v_url = "http://www.primus-romulus.net/resource/image/profile/picture/male.png";
                    break;
            }
        }
        return $v_url;
    }

    function get_privileg($p_group_id = "", $p_type_name = ""){
        $query = $this->db->query("SELECT * FROM Model INNER JOIN ModelPrivilege USING(model_id) INNER JOIN ModelPrivilegeType USING(type_id) WHERE group_id = ? AND UPPER(type_name) = UPPER(?) AND LOWER(model_name) = LOWER('Member_Model')", array($p_group_id, $p_type_name));
        return $query;
    }

    function update_member($p_id = "", $p_salutation = "", $p_title = "", $p_firstname = "", $p_lastname = "", $p_birthday = "", $p_class = "", $p_group = ""){
        $this->db->query("UPDATE Member SET gender_id = ?, member_title = ?, member_firstname = ?, member_lastname = ?, member_birthday = ?, class_id = ?, group_id = ? WHERE member_id = ?", array($p_salutation, $p_title, $p_firstname, $p_lastname, $p_birthday, $p_class, $p_group, $p_id));
    }
	
	function get_account($p_command = "", $p_data = ""){
        $db_member = $this->load->database('member', TRUE);
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case 'filter': 
                $sqldata = preg_split("[:]", $p_data);
                switch ($v_type[1]) {
                    case 'id': $query=$db_member->query("SELECT * FROM Member INNER JOIN MemberGroup USING(group_id) WHERE member_id = ?", array($p_data));
                    break;
                    case 'email': $query=$db_member->query("SELECT * FROM Member INNER JOIN MemberGroup USING(group_id) WHERE member_email = ?", array($p_data));
                    break;
                    case 'group': $query=$db_member->query("SELECT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) WHERE UPPER(group_name) = UPPER(?) ORDER BY member_lastname ASC, member_firstname ASC", array($p_data));
                    break;

                    case 'name_company_class': $query = $db_member->query("SELECT DISTINCT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) INNER JOIN Class USING(class_id) WHERE (UPPER(member_firstname) LIKE CONCAT('%', UPPER(?), '%') OR UPPER(member_lastname) LIKE CONCAT('%', UPPER(?), '%')) AND company_id = ? AND class_id = ?", array($sqldata[0], $sqldata[0], $sqldata[1], $sqldata[2]));
                    break;

                    case 'name_company': $query = $db_member->query("SELECT DISTINCT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) INNER JOIN Class USING(class_id) WHERE (UPPER(member_firstname) LIKE CONCAT('%', UPPER(?), '%') OR UPPER(member_lastname) LIKE CONCAT('%', UPPER(?), '%')) AND company_id = ?", array($sqldata[0], $sqldata[0], $sqldata[1]));
                    break;

                    case 'name_class': $query = $db_member->query("SELECT DISTINCT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) INNER JOIN Class USING(class_id) WHERE (UPPER(member_firstname) LIKE CONCAT('%', UPPER(?), '%') OR UPPER(member_lastname) LIKE CONCAT('%', UPPER(?), '%')) AND class_id = ?", array($sqldata[0], $sqldata[0], $sqldata[1]));
                    break;

                    case 'company_class': $query = $db_member->query("SELECT DISTINCT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) INNER JOIN Class USING(class_id) WHERE company_id = ? AND class_id = ?", array($sqldata[0], $sqldata[1]));
                    break;

                    case 'name': $query = $db_member->query("SELECT DISTINCT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) INNER JOIN Class USING(class_id) WHERE UPPER(member_firstname) LIKE CONCAT('%', UPPER(?), '%') OR UPPER(member_lastname) LIKE CONCAT('%', UPPER(?), '%')", array($sqldata[0], $sqldata[0]));
                    break;

                    case 'company': $query = $db_member->query("SELECT DISTINCT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) INNER JOIN Class USING(class_id) WHERE company_id = ?", array($sqldata[0]));
                    break;

                    case 'class': $query = $db_member->query("SELECT DISTINCT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) INNER JOIN Class USING(class_id) WHERE class_id = ?", array($sqldata[0]));
                    break;
                }
            break;
            case 'group':
                $query=$db_member->query("SELECT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) WHERE group_name = ? ORDER BY member_lastname", array($p_data));
            break;
            case 'class':
                $query=$db_member->query("SELECT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) INNER JOIN Class USING(class_id) WHERE class_name = ? ORDER BY member_lastname", array($p_data));
            break;
            case 'all':
                if($p_data != ""){
                    $query=$db_member->query("SELECT DISTINCT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) INNER JOIN Class USING(class_id) WHERE member_id = ?", array($p_data));
                }else{
                    $query=$db_member->query("SELECT DISTINCT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) INNER JOIN Class USING(class_id)  ORDER BY member_lastname ASC");
                }
            break;
        }
        return $query;
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