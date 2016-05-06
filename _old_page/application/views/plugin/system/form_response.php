<?php 
/* Creating the Response Array*/
$data=array();
$data['error']=$error;
if(isset($message)){
	$data['message']=$message;
}

if(isset($content)){
	$data['content']=$content;
}

if(isset($p_element_reset)){
	$array_reset_element=array();
	for ($i=0; $i < count($p_element_reset); $i++) { 
		array_push($array_reset_element,$p_element_reset[$i]);
	}
	$data['element_reset']=$array_reset_element;
}

if(isset($p_element_focus)){
	$data['element_focus']=$p_element_focus;
}


/*foreach ($menu_array as $row) {
		$row_data = array(
			"id"=>$row->menu_id,
			"name"=>$this->lang->line("tag_".strtolower($row->menu_name)),
			"type"=>$row->type_description,
			"data"=>$row->menu_data,
			"icon"=>$resource_url."/image/icon/".$row->menu_icon,
			"parent"=>$row->menu_parent_id,
			"color"=>$row->color_hex
		);
	array_push($data,$row_data);		
}*/
echo json_encode($data);

?>