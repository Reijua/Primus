<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_privilege($group_id = "", $type_name = ""){
        $db_default = $this->load->database('default', TRUE);
        $query = $db_default->query("SELECT * FROM Model INNER JOIN ModelPrivilege USING(model_id) INNER JOIN ModelPrivilegeType USING(type_id) WHERE group_id = ? AND UPPER(type_name) = UPPER(?) AND LOWER(model_name)= LOWER('Gallery_Model')",array($group_id, $type_name));
        return $query;
    }

    function get_gallery($gallery_id=""){
        $db_website = $this->load->database('website', TRUE);
        if($gallery_id != ""){
			$query = $db_website->query("SELECT * FROM Gallery WHERE gallery_id = ?",array($gallery_id));
        }else{
			$query = $db_website->query("SELECT * FROM Gallery");
        }       
        return $query;
    }

    function create_gallery($name, $description){
    	$db_website = $this->load->database('website', TRUE);
		$db_website->query("INSERT INTO Gallery (gallery_name, gallery_description, gallery_release_date) VALUES(?, ?, NOW())",array($name, $description));
		return $db_website->insert_id();
    }

	function update_gallery($id, $name, $description){
		$db_website = $this->load->database('website', TRUE);
		$db_website->query("UPDATE Gallery SET gallery_name = ?, gallery_description = ? WHERE gallery_id = ?", array($name, $description, $id));
	}

    function delete_gallery($gallery_id){
		$db_website = $this->load->database('website', TRUE);
		$db_website->query("DELETE FROM Gallery WHERE gallery_id = ?", array($gallery_id));
    }

    function get_item($gallery_id){
        $this->load->helper("directory");
        return directory_map(FCPATH.'../resource/image/gallery/'.$gallery_id.'/');
    }



}

?>