<?php 

	$data=array();
	foreach ($array_dock as $row) {
			$row_data = array(
				"id"=>$row->dock_id,
				"name"=>$this->lang->line("dock_".strtolower($row->dock_name)),
				"type"=>$row->type_name,
				"icon"=>$row->dock_icon
			);
		array_push($data,$row_data);		
	}
	echo json_encode($data);
?>