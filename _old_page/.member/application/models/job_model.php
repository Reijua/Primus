<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    /**/

    function get_job($p_command = "", $p_data = ""){
        $db_partner = $this->load->database('partner', TRUE);
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case "filter":
                /*switch ($v_type[1]) {
                    case "last_login":
                    break;
                }*/
            break;
            case "all":
                if($p_data==""){
                    $query=$db_partner->query("SELECT * FROM Job INNER JOIN Company USING(company_id) INNER JOIN Contact ON(Job.company_id = Contact.company_id AND Job.contact_id = Contact.contact_id) INNER JOIN Location ON(Job.company_id = Location.company_id AND Job.location_id = Location.location_id) ORDER BY job_release_date DESC");
                }else{
                    $query=$db_partner->query("SELECT * FROM Job INNER JOIN Company USING(company_id) INNER JOIN Contact ON(Job.company_id = Contact.company_id AND Job.contact_id = Contact.contact_id) INNER JOIN Location ON(Job.company_id = Location.company_id AND Job.location_id = Location.location_id) WHERE job_id = ? ", array($p_data));
                }
            break;
        }        
        return $query;
    }

    function increase_job_view($p_job_id){
        $db_partner = $this->load->database('partner', TRUE);
        $db_partner->query("UPDATE Job SET job_views = job_views + 1 WHERE job_id = ? ", array($p_job_id));
    }

    function get_section_item($p_job_id = "", $p_section_name = ""){
        $db_partner = $this->load->database('partner', TRUE);
        $query=$db_partner->query("SELECT * FROM JobSectionItem INNER JOIN JobSection USING(section_id) WHERE job_id = ? AND LOWER(section_name) = LOWER(?) ", array($p_job_id, $p_section_name));
        return $query;
    }



}

?>