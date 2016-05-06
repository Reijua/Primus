<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plugin_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function data($group="Visitor", $plugin_name="", $menu_id=""){
        if($menu_id==""){
            $query=$this->db->query("SELECT * FROM PluginMenu INNER JOIN DataType USING(type_id) INNER JOIN PluginAccessList ON(PluginAccessList.plugin_id=PluginMenu.plugin_id AND PluginAccessList.menu_id=PluginMenu.menu_id) WHERE PluginMenu.plugin_id=(SELECT plugin_id FROM Plugin WHERE LOWER(Plugin_name)=LOWER('$plugin_name')) AND group_id=(SELECT group_id FROM CompanyGroup WHERE lower(group_name)=lower('$group')) ORDER BY menu_order ASC");
        }else{
            $query=$this->db->query("SELECT * FROM PluginMenu INNER JOIN PluginAccessList ON(PluginAccessList.plugin_id=PluginMenu.plugin_id AND PluginAccessList.menu_id=PluginMenu.menu_id) WHERE PluginMenu.plugin_id=(SELECT plugin_id FROM Plugin WHERE Plugin_name='$plugin_name') AND PluginMenu.menu_id=$menu_id AND group_id=(SELECT group_id FROM CompanyGroup WHERE lower(group_name)=lower('$group'))");
        }        
        return $query;
    }

    function get_model($plugin_name="", $menu_id=""){
        $query = $this->db->query("SELECT * FROM PluginModel INNER JOIN Plugin USING(plugin_id) INNER JOIN Model USING(model_id) WHERE plugin_name = '$plugin_name' AND menu_id = '$menu_id'");
        return $query;
    }

}

?>