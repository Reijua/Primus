<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_profile_picture($p_resource_url, $p_picture_name, $p_gender_id = "" ){
        $v_url = "";
        $p_picture_name = hash("sha256", str_replace("%s", $p_picture_name, $this->config->item("encryption_image_key")));
        if(file_exists(FCPATH."resource/image/profile/picture/".$p_picture_name.".png")){
            $v_url = $p_resource_url."image/profile/picture/".$p_picture_name.".png";
        }else if(file_exists(FCPATH."resource/profile/picture/".$p_picture_name.".jpg")){
            $v_url = $p_resource_url."image/profile/picture/".$p_picture_name.".jpg";
        }else if(file_exists(FCPATH."resource/profile/picture/".$p_picture_name.".jpeg")){
            $v_url = $p_resource_url."image/profile/picture/".$p_picture_name.".jpeg";
        }else{
            switch ($p_gender_id) {
                case 1:
                $v_url = $p_resource_url."image/profile/picture/female.png";
                break;
                default:
                $v_url = $p_resource_url."image/profile/picture/male.png";
                break;
            }
        }
        return $v_url;
    }

    function create_account($salutation, $title, $firstname, $lastname, $birthday, $email){
       $this->db->query("INSERT INTO Member(gender_id, member_title, member_firstname, member_lastname, member_birthday, member_email, member_registration_date) VALUES(?, ?, ?, ?, ?, ?, NOW())", array($salutation, $title, $firstname, $lastname, $birthday, $email));
       return $this->db->insert_id();
    }

    function get_account($p_command = "", $p_data = ""){
        $db_default = $this->load->database('default', TRUE);
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case 'filter': 
                switch ($v_type[1]) {
                    case 'email': $query=$db_default->query("SELECT * FROM Member INNER JOIN MemberGroup USING(group_id) WHERE member_email = ?", array($p_data));
                    break;
                    case 'group': $query=$db_default->query("SELECT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) WHERE UPPER(group_name) = UPPER(?) ORDER BY member_lastname ASC, member_firstname ASC", array($p_data));
                    break;
                }
            break;
            case 'group':
                $query=$db_default->query("SELECT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) WHERE group_name = ? ORDER BY member_lastname", array($p_data));
            break;
            case 'class':
                $query=$db_default->query("SELECT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) INNER JOIN Class USING(class_id) WHERE class_name = ? ORDER BY member_lastname", array($p_data));
            break;
            case 'all':
                if($p_data != ""){
                    $query=$db_default->query("SELECT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) INNER JOIN Class USING(class_id) WHERE member_id = ?", array($p_data));
                }else{
                    $query=$db_default->query("SELECT * FROM Member INNER JOIN MemberGroup USING(group_id) INNER JOIN Gender USING(gender_id) INNER JOIN Class USING(class_id)  ORDER BY member_lastname ASC");
                }
            break;
        }
        return $query;
    }

    function get_statistic(){
        $query =  $this->db->query("SELECT DATE_FORMAT(member_registration_date,'%M') AS view_month, COUNT(*) AS view_member_amount FROM Member GROUP BY DATE_FORMAT(member_registration_date,'%M %Y') ORDER BY member_registration_date LIMIT 6");
        return $query;
    }

    function get_group(){
        $query=$this->db->query("SELECT * FROM MemberGroup");
        return $query;
    }

    function set_group($p_account_id ,$p_group_name){
        $this->db->query("UPDATE Member SET group_id = (SELECT group_id FROM MemberGroup WHERE LOWER(group_name) = LOWER(?)) WHERE member_id = ?", array($p_group_name, $p_account_id));
    }

    function password_hash($email, $password){
        return hash("sha512", $email.'<-¡!->'.$password.'<-!¡->'.$this->config->item('encryption_key'));
    }

    function lock_account($p_account_id, $p_length, $p_reason){
        if($p_length != "-1"){
            $this->db->query("INSERT INTO MemberBlocking(member_id, blocking_start_date, blocking_end_date, blocking_reason) VALUES(?, SYSDATE(), DATE_ADD(SYSDATE(), INTERVAL ".$p_length." SECOND), ?)", array($p_account_id, $p_reason));
        }else{
            $this->db->query("INSERT INTO MemberBlocking(member_id, blocking_start_date, blocking_end_date, blocking_reason) VALUES(?, SYSDATE(), NULL, ?)", array($p_account_id, $p_reason));
        }
       
    }

    function is_locked($p_account_id){
        $query=$this->db->query("SELECT * FROM MemberBlocking WHERE member_id = ? AND SYSDATE() BETWEEN blocking_start_date AND IFNULL(blocking_end_date, DATE_ADD(SYSDATE(), INTERVAL 1 DAY))", array($p_account_id));
        return $query;
    }
    /* Failed Login (s) */
    function get_failed_login($p_account_id){
        $query = $this->db->query("SELECT * FROM MemberLogin WHERE member_id = ?",array($p_account_id));
        return $query;
    }

    function log_failed_login($p_account_id, $p_ip_address){
        $this->db->query("INSERT INTO MemberLogin(member_id, login_ip_address) VALUES(?, ?)",array($p_account_id, $p_ip_address));
    }

    function delete_failed_login($p_account_id){
        $this->db->query("DELETE FROM MemberLogin WHERE member_id = ?",array($p_account_id));
    }
    /* Failed Login (e) */
    function log_last_login($p_account_id, $p_ip_address){
        $this->db->query("UPDATE Member SET member_last_ip = ? WHERE member_id= ?",array($p_ip_address, $p_account_id));
    }

    function log_activity($p_account_id, $p_message, $p_ip_address, $p_browser, $p_os){
        $this->db->query("INSERT INTO MemberActivity (member_id, message_id, activity_ip_address, activity_data) VALUES(?, (SELECT message_id FROM MemberActivityMessage WHERE LOWER(message_title) = LOWER(?) ), ?, ?)", array($p_account_id, $p_message, $p_ip_address, $p_browser.';'.$p_os));
    }

    function update_password($p_account_id, $p_hash){
        $this->db->query("UPDATE Member SET member_password_hash = ? WHERE member_id = ?", array($p_hash, $p_account_id));
    }
    /* Avatar */
    function upload_avatar($p_account_id, $p_image){
        $this->db->query("UPDATE Member SET member_profile_image = ? WHERE member_id = ?", array($p_image, $p_account_id));
    }
    function remove_avatar($p_account_id){
        $this->db->query("UPDATE Member SET member_profile_image = NULL WHERE member_id = ?", array($p_account_id));
    }

    function create_recovery_code($p_account_id = "", $p_code = ""){
        $this->db->query("INSERT INTO MemberRecovery(member_id, recovery_code) VALUES(?, ?)", array($p_account_id, $p_code));
    }

    function get_code($p_type="", $p_data = "", $p_code = ""){
        switch ($p_type) {
            case 'current':
            $query = $this->db->query("SELECT * FROM MemberRecovery INNER JOIN Member t_member USING(member_id) WHERE member_email = ? AND recovery_code = ? AND recovery_timestamp = (SELECT MAX(recovery_timestamp) FROM MemberRecovery WHERE member_id = t_member.member_id AND recovery_timestamp BETWEEN SYSDATE()-500 AND SYSDATE())", array($p_data, $p_code));
            break;
            case 'last 24 hours':
            $query = $this->db->query("SELECT * FROM MemberRecovery WHERE member_id = ? AND recovery_timestamp BETWEEN SYSDATE()-86400 AND SYSDATE()", array($p_data));
            break;
            case 'all':
            $query = $this->db->query("SELECT * FROM MemberRecovery WHERE member_id = ? ", array($p_data));
            break;
        }
        return $query;
    }

    function create_sign_up_blocking($p_ip_address){
        $this->db->query("INSERT INTO MemberSignUp(signup_ip_address) VALUES(?)", array($p_ip_address));
    }

    function check_sign_up_blocking($p_ip_address = ""){
        $this->db->query("DELETE FROM MemberSignUp WHERE signup_timestamp < SYSDATE()-86400");
        $query = $this->db->query("SELECT * FROM MemberSignUp WHERE signup_ip_address = ? AND SYSDATE() BETWEEN signup_timestamp AND signup_timestamp+3600", array($p_ip_address));
        return $query;
    }
}

?>