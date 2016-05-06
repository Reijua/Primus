<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_privileg($p_group_id = "", $p_type_name = ""){
        $query = $this->db->query("SELECT * FROM Model INNER JOIN ModelPrivilege USING(model_id) INNER JOIN ModelPrivilegeType USING(type_id) WHERE group_id = ? AND UPPER(type_name) = UPPER(?) AND LOWER(model_name) = LOWER('Event_Model')", array($p_group_id, $p_type_name));
        return $query;
    }
    
    function get_event($p_event_id=""){
        if($p_event_id == ""){
            $query=$this->db->query("SELECT * FROM Event INNER JOIN EventType USING(type_id) ORDER BY event_start_date DESC");
        }else{
            $query=$this->db->query("SELECT * FROM Event INNER JOIN EventType USING(type_id) WHERE event_id = ?", array($p_event_id));
        }
        return $query;
    }

    function create_event($name, $description, $release_date, $address, $pc, $city, $leader, $type, $amount){
        $this->db->query("INSERT INTO Event (event_name, event_description, event_start_date, event_address, event_pc, event_city, leader_id, type_id, event_amount_member) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)", array($name, $description, $release_date, $address, $pc, $city, $leader, $type, $amount));
    }

    function update_event($id, $name, $description, $release_date, $address, $pc, $city, $leader, $type, $amount){
        $this->db->query("UPDATE Event SET event_name = ?, event_description = ?, event_start_date = ?, event_address = ?, event_pc = ?, event_city = ?, leader_id = ?, type_id = ?, event_amount_member = ? WHERE event_id = ?", array($name, $description, $release_date, $address, $pc, $city, $leader, $type, $amount , $id));
    }

    function delete_event($p_event_id=""){
        $this->db->query("DELETE FROM Event WHERE event_id = ?", array($p_event_id));
        $this->db->query("DELETE FROM EventMember WHERE event_id = ?", array($p_event_id));
    }

    function get_member($p_event_id=""){
        $query=$this->db->query("SELECT * FROM EventMember WHERE event_id = ?", array($p_event_id));
        return $query;
    }

    function get_category($p_category_id=""){
        $query=$this->db->query("SELECT * FROM EventType");
        return $query;
    }


}