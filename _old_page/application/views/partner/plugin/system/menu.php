<?php 

	$data=array();
	foreach ($menu_array as $row) {
			$row_data = array(
				"id"=>$row->menu_id,
				"name"=>$this->lang->line("plugin_name_".str_replace(" ", "_", strtolower($row->menu_name))),
				"type"=>$row->type_description,
				"data"=>$row->menu_data,
				"icon"=>$resource_url."image/icon/grey/".$row->menu_icon,
				"parent"=>$row->menu_parent_id
			);
		array_push($data,$row_data);		
	}
	echo json_encode($data);
?>