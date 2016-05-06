<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model('Account_Model');
		$this->load->model('Feed_Model');

		if (!$this->input->is_ajax_request()) {
			show_404();
		}
	}

	public function index() {
		show_404();
	}

	// Called from /partner/application/views/modal/create_feedpost.php
	public function create_feedpost() {
		if ($this->session->userdata('login')) {
			$v_account = $this->Account_Model->get_account("all", $this->session->userdata("account_id"))->row();

			if ($this->Feed_Model->get_privilege($v_account->group_id, "CREATE")->num_rows() == 1) {
				$v_text = $this->input->get_post("text");

				$v_img_width = 0;
				$v_img_height = 0;

				$v_valid_image_type = array('image/png', 'image/jpeg', 'image/jpg');
				if (isset($_FILES['file']['name'])) {
					list($v_img_width, $v_img_height, $v_type, $v_attr) = getimagesize($_FILES['file']['tmp_name'][0]);
				}

				if ($v_text == '') {
					$data['error'] = TRUE;
					$data['p_element_focus'] = "text";
					$data['message'] = "Bitte geben Sie einen Text ein.";
				} else if (isset($_FILES['file']['name']) && count($_FILES['file']['name']) != 1) {
					$data['error'] = TRUE;
					$data['message'] = "Bitte wählen Sie nur eine Datei zum Hochladen aus.";
				} else if (isset($_FILES['file']['name']) && !in_array(strtolower($_FILES['file']['type'][0]), $v_valid_image_type)) {
					$data['error'] = TRUE;
					$data['message'] = "Es dürfen nur Bilder im Format .png, .jpg und .jpeg hochgeladen werden.";
				} else if (isset($_FILES['file']['name'][0]) && $v_img_width > 500) {
					$data['error'] = TRUE;
					$data['message'] = "Das Bild darf nicht breiter sein als 500px.";
				} else if (isset($_FILES['file']['name'][0]) && $v_img_height > 500) {
					$data['error'] = TRUE;
					$data['message'] = "Das Bild darf nicht höher sein als 500px.";
				} else {
					$v_image_path = '';

					if (isset($_FILES['file']['name'][0])) {
						$v_image_name = uniqid($v_account->company_id) .".". strtolower(end(explode('.', $_FILES["file"]["name"][0])));
						$v_image_path = $this->config->item('resource_url') ."image/post/". $v_image_name;

						@move_uploaded_file($_FILES["file"]["tmp_name"][0], FCPATH ."resource/image/post/". $v_image_name);
					}

					$this->Feed_Model->create_feedpost($v_account->company_id, $v_text, $v_image_path);

					$data['error'] = FALSE;
					$data['message'] = "Der Post wurde erfolgreich erstellt.";
				}
			} else {
				$data['error'] = TRUE;
				$data['message'] = "Sie können keinen Post verfassen, da Sie keine Berechtigung haben.";
			}

			$this->load->view("plugin/system/form_response", $data);
		} else {
			show_404();
		}
	}

	public function update_feedpost() {
		if ($this->session->userdata('login')) {
			
		} else {
			show_404();
		}
	}

	public function delete_feedpost() {
		if ($this->session->userdata('login')) {
			
		} else {
			show_404();
		}
	}

}