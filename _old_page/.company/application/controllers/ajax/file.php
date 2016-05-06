<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('File_Model');
	}

	public function index()
	{
		show_404();
	}

	public function preview(){
		if(!isset($_FILES['file'])){
			$data['error']=TRUE;
			$data['message']="Bitte eine Datei auswählen";
		}else if(count($_FILES['file']['name'])>1){
			$data['error']=TRUE;
			$data['message']="Nur eine Datei auswählen";
		}else{
			$type = $_FILES['file']['type'][0];
			$content = file_get_contents($_FILES['file']['tmp_name'][0]);
			$base64url = 'data:' . $type . ';base64,' . base64_encode($content);
			$data['error']=FALSE;
			$data['array_file']=array();
			for($i = 0; $i < count($_FILES['file']['name']); $i++){
				switch ($_FILES['file']['type'][$i]) {
					case 'value':
					break;
					case 'value':
					break;
					default:
					break;
				}
				array_push($data['array_file'],'data:'.$_FILES['file']['type'][$i].';base64,' . base64_encode(file_get_contents($_FILES['file']['tmp_name'][$i])));
			}
			
		}

		if($data['error']==TRUE){
			$this->load->view("plugin/system/form_response",$data);
		}else{
			$this->load->view("plugin/system/file_upload_response",$data);
		}
	}

}