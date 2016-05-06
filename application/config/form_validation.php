<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// For more information see: http://www.codeigniter.com/user_guide/libraries/form_validation.html

$config = array(
	'error_prefix' => '<div class="alert alert-danger form-alert" role="alert">',
	'error_suffix' => '</div>',

	'member/login' => array(
		array(
			'field' => 'email',
			'label' => 'lang:auth_login_email',
			'rules' => 'required|valid_email',
		),
		array(
			'field' => 'password',
			'label' => 'lang:auth_login_password',
			'rules' => 'required',
		),
		array(
			'field' => 'remember',
			'label' => 'lang:auth_login_remember',
		),
	),

	'member/register' => array(
		array(
			'field' => 'salutation',
			'label' => 'lang:auth_register_salutation',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'title',
			'label' => 'lang:auth_register_title',
			'rules' => 'max_length[250]',
		),
		array(
			'field' => 'firstname',
			'label' => 'lang:auth_register_firstname',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'lastname',
			'label' => 'lang:auth_register_lastname',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'birthdate',
			'label' => 'lang:auth_register_birthdate',
			'rules' => 'required|valid_date',
		),
		array(
			'field' => 'email',
			'label' => 'lang:auth_register_email',
			'rules' => 'required|valid_email|max_length[250]',
		),
		array(
			'field' => 'password',
			'label' => 'lang:auth_register_password',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'confirm-password',
			'label' => 'lang:auth_register_confirm_password',
			'rules' => 'required|matches[password]|max_length[250]',
		),
	),

	'member/settings/personal-settings' => array(
		array(
			'field' => 'title',
			'label' => 'Titel',
			'rules' => 'max_length[250]',
		),
		array(
			'field' => 'firstname',
			'label' => 'Vorname',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'lastname',
			'label' => 'Nachname',
			'rules' => 'required|max_length[250]',
		),
	),

	'member/settings/change-password' => array(
		array(
			'field' => 'current-password',
			'label' => 'Aktuelles Passwort',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'new-password',
			'label' => 'Neues Passwort',
			'rules' => 'required|differs[current-password]|max_length[250]',
		),
		array(
			'field' => 'confirm-new-password',
			'label' => 'Neues Passwort bestätigen',
			'rules' => 'required|matches[new-password]|max_length[250]',
		),
	),

	'partner/login' => array(
		array(
			'field' => 'email',
			'label' => 'lang:auth_login_email',
			'rules' => 'required|valid_email',
		),
		array(
			'field' => 'password',
			'label' => 'lang:auth_login_password',
			'rules' => 'required',
		),
		array(
			'field' => 'remember',
			'label' => 'lang:auth_login_remember',
		),
	),

	'feed/create-post' => array(
		array(
			'field' => 'title',
			'label' => 'Titel',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'text',
			'label' => 'Text',
			'rules' => 'required',
		),
	),

	'feed/edit-post' => array(
		array(
			'field' => 'title',
			'label' => 'Titel',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'text',
			'label' => 'Text',
			'rules' => 'required',
		),
	),

	'advertisements/create-advertisement' => array(
		array(
			'field' => 'title',
			'label' => 'Titel',
			'rules' => 'required|max_length[100]',
		),
		array(
			'field' => 'url-text',
			'label' => 'URL-Text',
			'rules' => 'required|max_length[100]',
		),
		array(
			'field' => 'url',
			'label' => 'URL',
			'rules' => 'required|valid_url|max_length[250]',
		),
		array(
			'field' => 'text',
			'label' => 'Text',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'start-date',
			'label' => 'Geschaltet von',
			'rules' => 'required|valid_date',
		),
		array(
			'field' => 'end-date',
			'label' => 'Geschaltet bis',
			'rules' => 'required|valid_date',
		),
	),

	'advertisements/edit-advertisement' => array(
		array(
			'field' => 'title',
			'label' => 'Titel',
			'rules' => 'required|max_length[100]',
		),
		array(
			'field' => 'url-text',
			'label' => 'URL-Text',
			'rules' => 'required|max_length[100]',
		),
		array(
			'field' => 'url',
			'label' => 'URL',
			'rules' => 'required|valid_url|max_length[250]',
		),
		array(
			'field' => 'text',
			'label' => 'Text',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'start-date',
			'label' => 'Geschaltet von',
			'rules' => 'required|valid_date',
		),
		array(
			'field' => 'end-date',
			'label' => 'Geschaltet bis',
			'rules' => 'required|valid_date',
		),
	),

	'jobs/create-job' => array(
		array(
			'field' => 'title',
			'label' => 'Titel',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'lead-text',
			'label' => 'Vorwort',
			'rules' => 'required|max_length[300]',
		),
		array(
			'field' => 'text',
			'label' => 'Text',
			'rules' => 'required',
		),
		array(
			'field' => 'salary-text',
			'label' => 'Gehaltsangabe',
			'rules' => 'required|max_length[300]',
		),
		array(
			'field' => 'status',
			'label' => 'Status',
			'rules' => 'required',
		),
		array(
			'field' => 'start-date',
			'label' => 'Eintrittsdatum',
			'rules' => 'required|valid_date',
		),
		array(
			'field' => 'contact',
			'label' => 'Kontaktperson',
		),
		array(
			'field' => 'type',
			'label' => 'Anstellungsart',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'location',
			'label' => 'Standort',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'sector',
			'label' => 'Branche',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
	),

	'jobs/edit-job' => array(
		array(
			'field' => 'title',
			'label' => 'Titel',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'lead-text',
			'label' => 'Vorwort',
			'rules' => 'required|max_length[300]',
		),
		array(
			'field' => 'text',
			'label' => 'Text',
			'rules' => 'required',
		),
		array(
			'field' => 'salary-text',
			'label' => 'Gehaltsangabe',
			'rules' => 'required|max_length[300]',
		),
		array(
			'field' => 'status',
			'label' => 'Status',
			'rules' => 'required',
		),
		array(
			'field' => 'start-date',
			'label' => 'Eintrittsdatum',
			'rules' => 'required|valid_date',
		),
		array(
			'field' => 'contact',
			'label' => 'Kontaktperson',
		),
		array(
			'field' => 'type',
			'label' => 'Anstellungsart',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'location',
			'label' => 'Standort',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'sector',
			'label' => 'Branche',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
	),

	'locations/create-location' => array(
		array(
			'field' => 'name',
			'label' => 'Bezeichnung',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'street',
			'label' => 'Straße',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'zipcode',
			'label' => 'Postleitzahl',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'city',
			'label' => 'Ort',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'country',
			'label' => 'Land',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'phone',
			'label' => 'Telefonnummer',
			'rules' => 'max_length[250]',
		),
		array(
			'field' => 'fax',
			'label' => 'Faxnummer',
			'rules' => 'max_length[250]',
		),
		array(
			'field' => 'email',
			'label' => 'E-Mail',
			'rules' => 'valid_email|max_length[250]',
		),
		array(
			'field' => 'website',
			'label' => 'Webseite',
			'rules' => 'valid_url|max_length[250]',
		),
	),

	'locations/edit-location' => array(
		array(
			'field' => 'name',
			'label' => 'Bezeichnung',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'street',
			'label' => 'Straße',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'zipcode',
			'label' => 'Postleitzahl',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'city',
			'label' => 'Ort',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'country',
			'label' => 'Land',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'phone',
			'label' => 'Telefonnummer',
			'rules' => 'max_length[250]',
		),
		array(
			'field' => 'fax',
			'label' => 'Faxnummer',
			'rules' => 'max_length[250]',
		),
		array(
			'field' => 'email',
			'label' => 'E-Mail',
			'rules' => 'valid_email|max_length[250]',
		),
		array(
			'field' => 'website',
			'label' => 'Webseite',
			'rules' => 'valid_url|max_length[250]',
		),
	),

	'contacts/create-contact' => array(
		array(
			'field' => 'salutation',
			'label' => 'Anrede',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'title',
			'label' => 'Titel',
			'rules' => 'max_length[250]',
		),
		array(
			'field' => 'firstname',
			'label' => 'Vorname',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'lastname',
			'label' => 'Nachname',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'email',
			'label' => 'E-Mail',
			'rules' => 'required|valid_email|max_length[250]',
		),
		array(
			'field' => 'phone',
			'label' => 'Telefonnummer',
			'rules' => 'max_length[250]',
		),
	),

	'contacts/edit-contact' => array(
		array(
			'field' => 'salutation',
			'label' => 'Anrede',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'title',
			'label' => 'Titel',
			'rules' => 'max_length[250]',
		),
		array(
			'field' => 'firstname',
			'label' => 'Vorname',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'lastname',
			'label' => 'Nachname',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'email',
			'label' => 'E-Mail',
			'rules' => 'required|valid_email|max_length[250]',
		),
		array(
			'field' => 'phone',
			'label' => 'Telefonnummer',
			'rules' => 'max_length[250]',
		),
	),

	'parnter/settings/company-settings' => array(
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'description',
			'label' => 'Beschreibung',
			'rules' => 'required',
		),
		array(
			'field' => 'location',
			'label' => 'Hauptstandort',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'contact',
			'label' => 'Hauptkontaktperson',
		),
		array(
			'field' => 'job-email',
			'label' => 'E-Mail für Jobangebote',
			'rules' => 'valid_email|max_length[250]',
		),
		array(
			'field' => 'contact-email',
			'label' => 'E-Mail für die Kontaktaufnahme',
			'rules' => 'valid_email|max_length[250]',
		),
	),

	'partner/settings/change-password' => array(
		array(
			'field' => 'current-password',
			'label' => 'Aktuelles Passwort',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'new-password',
			'label' => 'Neues Passwort',
			'rules' => 'required|differs[current-password]|max_length[250]',
		),
		array(
			'field' => 'confirm-new-password',
			'label' => 'Neues Passwort bestätigen',
			'rules' => 'required|matches[new-password]|max_length[250]',
		),
	),

	'contact' => array(
		array(
			'field' => 'salutation',
			'label' => 'lang:contact_salutation',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'firstname',
			'label' => 'lang:contact_firstname',
			'rules' => 'required',
		),
		array(
			'field' => 'lastname',
			'label' => 'lang:contact_lastname',
			'rules' => 'required',
		),
		array(
			'field' => 'email',
			'label' => 'lang:contact_email',
			'rules' => 'required|valid_email',
		),
		array(
			'field' => 'message',
			'label' => 'lang:contact_message',
			'rules' => 'required',
		),
	),
	
	'admin/login' => array(
		array(
			'field' => 'email',
			'label' => 'lang:auth_login_email',
			'rules' => 'required|valid_email',
		),
		array(
			'field' => 'password',
			'label' => 'lang:auth_login_password',
			'rules' => 'required',
		)
	),
	
	'newsletter/create-newsletter' => array(
		array(
			'field' => 'subject',
			'label' => 'Betreff',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'text',
			'label' => 'Text',
			'rules' => 'required',
		),
	),

	'newsletter/edit-newsletter' => array(
		array(
			'field' => 'subject',
			'label' => 'Betreff',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'text',
			'label' => 'Text',
			'rules' => 'required',
		),
	),
	
	'memberfunction/ban' => array(
		array(
			'field' => 'duration',
			'label' => 'Dauer',
			'rules' => 'required|max_length[10]',
		),
		array(
			'field' => 'reason',
			'label' => 'Grund',
			'rules' => 'required|max_length[250]',
		),
	),

	'messages/write-message' => array(
		array(
			'field' => 'subject',
			'label' => 'Betreff',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'message',
			'label' => 'Nachricht',
			'rules' => 'required',
		),
	),
	
	'partnerfunction/create-partner' => array(
		array(
			'field' => 'email',
			'label' => 'E-Mail',
			'rules' => 'required|valid_email|max_length[250]',
		),
		array(
			'field' => 'password',
			'label' => 'Passwort',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'confirm-password',
			'label' => 'Passwort wiederholen',
			'rules' => 'required|matches[password]|max_length[250]',
		),
		array(
			'field' => 'company-name',
			'label' => 'Firmenname',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'packet',
			'label' => 'Paket',
			'rules' => 'required',
		),
		array(
			'field' => 'name',
			'label' => 'Bezeichnung',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'street',
			'label' => 'Straße',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'zipcode',
			'label' => 'Postleitzahl',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'city',
			'label' => 'Ort',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'country',
			'label' => 'Land',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
	),
	
	'partnerfunction/edit-partner' => array(
		array(
			'field' => 'email',
			'label' => 'E-Mail',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'password',
			'label' => 'Passwort',
			'rules' => 'max_length[250]',
		),
		array(
			'field' => 'confirm-password',
			'label' => 'Passwort wiederholen',
			'rules' => 'matches[password]|max_length[250]',
		),
		array(
			'field' => 'company-name',
			'label' => 'Firmenname',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'packet',
			'label' => 'Paket',
			'rules' => 'required',
		),
	),
	
	'event/create-event' => array(
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'description',
			'label' => 'Beschreibung',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'startdate',
			'label' => 'Beginn',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'enddate',
			'label' => 'Ende',
			'rules' => 'max_length[250]',
		),
		array(
			'field' => 'street',
			'label' => 'Straße',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'zipcode',
			'label' => 'Postleitzahl',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'city',
			'label' => 'Ort',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'country',
			'label' => 'Land',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'leader',
			'label' => 'Verantwortlicher',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'eventtype',
			'label' => 'Typ',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'maxmember',
			'label' => 'Teilnehmeranzahl',
			'rules' => 'required|max_length[5]|is_natural_no_zero',
		),
	),
	
	'event/create-eventtype' => array(
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'required|max_length[250]',
		),
	),
	
	'event/edit-event' => array(
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'description',
			'label' => 'Beschreibung',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'startdate',
			'label' => 'Beginn',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'enddate',
			'label' => 'Ende',
			'rules' => 'max_length[250]',
		),
		array(
			'field' => 'street',
			'label' => 'Straße',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'zipcode',
			'label' => 'Postleitzahl',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'city',
			'label' => 'Ort',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'country',
			'label' => 'Land',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'leader',
			'label' => 'Verantwortlicher',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'eventtype',
			'label' => 'Typ',
			'rules' => 'required|not[-]',
			'errors' => array(
				'not' => 'lang:form_validation_select',
			),
		),
		array(
			'field' => 'maxmember',
			'label' => 'Teilnehmeranzahl',
			'rules' => 'required|max_length[5]|is_natural_no_zero',
		),
	),
	
	'news/create-news' => array(
		array(
			'field' => 'title',
			'label' => 'Titel',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'text',
			'label' => 'Text',
			'rules' => 'required',
		),
	),
	
	'news/edit-news' => array(
		array(
			'field' => 'title',
			'label' => 'Titel',
			'rules' => 'required|max_length[250]',
		),
		array(
			'field' => 'text',
			'label' => 'Text',
			'rules' => 'required',
		),
	),
);