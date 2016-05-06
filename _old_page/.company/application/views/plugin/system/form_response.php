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

if(isset($p_file_list)){
	$data['file_list']=$p_file_list;
}

if(isset($p_target)){
	$data['target']=$p_target;
}

if(isset($p_format)){
	$data['format']=$p_format;
}

echo json_encode($data);

?>