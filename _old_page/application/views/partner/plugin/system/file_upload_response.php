<?php 

$data = array();
$data['error']=$error;
$data['preview']=$element_preview;
$data['format']=$format;
$data['list'] = $array_file;

echo json_encode($data);

?>