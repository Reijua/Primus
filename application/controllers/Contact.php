<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Contact extends CI_Controller {



	public function __construct()

	{

		parent::__construct();

		

		if (($language = get_cookie('language')) != NULL && in_array($language, $this->config->item('supported_languages'))) {

			load_language($language);

		}

	}



	public function index()

	{

		$header_data = array(

			'title' => 'Primus Romulus - '. lang('elements_header_contact'), 

			'page' => 'contact',

		);



		$this->load->view('elements/header', $header_data);



		$message = '';



		if ($this->input->post('form') != NULL) {

			if ($this->form_validation->run('contact') == FALSE) {

				$this->load->view('contact', array('message' => $message));

				$this->load->view('elements/footer');



				return;

			}



			$salutation = html_escape($this->input->post('salutation'));

			$firstname = html_escape($this->input->post('firstname'));

			$lastname = html_escape($this->input->post('lastname'));

			$email = html_escape($this->input->post('email'));

			$message = html_escape($this->input->post('message'));



			$config = Array(

				'protocol'	=> 'smtp',

				'smtp_host'	=> 'smtp.world4you.com',

				'smtp_port'	=> 587,

				'smtp_user'	=> 'noreply@primus-romulus.net',

				'smtp_pass'	=> 'maborD8*',

				'mailtype'	=> 'html',

				'charset'	=> 'utf-8', // iso-8859-1

				'starttls'	=> true,

			);



			$this->email->initialize($config);

			

			$this->email->from('noreply@primus-romulus.net', $firstname .' '. $lastname);

			$this->email->reply_to($email, $firstname .' '. $lastname);

			$this->email->to('office@primus-romulus.net'); 



			$this->email->subject('Primus Romulus - Kontaktformular');



			// Determine salutation

			if ($salutation == 'female') {

				$salutation = 'Frau';

			} else {

				$salutation = 'Herr';

			}



			$email_data = array(

				'salutation' => $salutation,

				'firstname' => $firstname,

				'lastname' => $lastname,

				'email' => $email,

				'date' => date('d.m.Y'),

				'time' => date('H:i:s'),

				'message' => nl2br($message),

			);



			$this->email->message($this->parser->parse('template/email/contact', $email_data, true));



			$this->email->send();



			$message = '<div class="alert alert-success" role="alert">Vielen Dank für Ihre Nachricht! Wir werden uns sobald wie möglich bei Ihnen melden.</div>';

		}



		$this->load->view('contact', array('message' => $message));

		$this->load->view('elements/footer');

	}



}

