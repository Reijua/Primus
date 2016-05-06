<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

	function get_jobs(){
		$database_partner = $this->load->database('partner', TRUE);
		return $database_partner->query("SELECT * FROM Job WHERE job_close_date > NOW() OR job_close_date IS NULL");
	}

}

?>