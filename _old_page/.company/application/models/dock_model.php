<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dock_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_dock($group="Visitor", $dock_id=""){
    	if($dock_id==""){
			$query=$this->db->query("SELECT * FROM Dock INNER JOIN DockType USING(type_id) INNER JOIN DockAccessList USING(dock_id) INNER JOIN CompanyGroup USING(group_id) WHERE LOWER(group_name)=LOWER('$group') ORDER BY dock_id");
    	}else{
			$query=$this->db->query("SELECT * FROM Dock INNER JOIN DockType USING(type_id) INNER JOIN DockAccessList USING(dock_id) INNER JOIN CompanyGroup USING(group_id) WHERE LOWER(group_name)=LOWER('$group') AND dock_id=$dock_id");
    	}
        return $query;
    }

}

?>