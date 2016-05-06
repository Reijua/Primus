<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    

    function get_job($position_name="", $account_id="", $job_id=""){
        switch ($position_name) {
            case 'open':
                $query=$this->db->query("SELECT *, DATE_FORMAT(job_release_date, '%d.%m.%Y') AS release_date FROM Job INNER JOIN Currency USING(currency_id) INNER JOIN JobMode USING(mode_id) INNER JOIN Location ON(Location.location_id = Job.location_id AND Location.company_id = Job.company_id) INNER JOIN JobPosition USING(position_id) WHERE Job.company_id='$account_id' AND LOWER(position_name)=LOWER('$position_name') ORDER BY job_release_date DESC");
            break;
            case 'closed':
                $query=$this->db->query("SELECT *, DATE_FORMAT(job_release_date, '%d.%m.%Y') AS release_date FROM Job INNER JOIN Currency USING(currency_id) INNER JOIN JobMode USING(mode_id) INNER JOIN Location ON(Location.location_id = Job.location_id AND Location.company_id = Job.company_id) INNER JOIN JobPosition USING(position_id) WHERE Job.company_id='$account_id' AND LOWER(position_name)=LOWER('$position_name') ORDER BY job_release_date DESC");
            break;
            case 'all':
                if($job_id==""){
                    $query=$this->db->query("SELECT *, DATE_FORMAT(job_release_date, '%d.%m.%Y') AS release_date FROM Job INNER JOIN Currency USING(currency_id) INNER JOIN JobMode USING(mode_id) INNER JOIN Location ON(Location.location_id = Job.location_id AND Location.company_id = Job.company_id) INNER JOIN JobPosition USING(position_id) WHERE Job.company_id='$account_id' ORDER BY job_release_date DESC");
                }else{
                    $query=$this->db->query("SELECT * FROM Job INNER JOIN Currency USING(currency_id) INNER JOIN JobMode USING(mode_id) INNER JOIN Location ON(Location.location_id = Job.location_id AND Location.company_id = Job.company_id) WHERE Job.company_id='$account_id' AND job_id = '$job_id'");
                }
            break;
        }        
        return $query;
    }

    function get_last_job($account_id=""){
        $query = $this->db->query("SELECT * FROM Job WHERE job_release_date=(SELECT MAX(job_release_date) FROM Job WHERE company_id='$account_id') AND company_id='$account_id'");
        return $query;
    }

    function get_category(){
        $query = $this->db->query("SELECT * FROM JobCategory");
        return $query;
    }

    function get_mode(){
        $query = $this->db->query("SELECT * FROM JobMode");
        return $query;
    }

    function get_currency(){
        $query = $this->db->query("SELECT * FROM Currency");
        return $query;
    }

    function add_job($account_id="", $title="", $category="", $mode="", $month_rate="", $interval="", $currency="", $location="", $contact="", $preface="", $acknowledgement=""){
        $this->db->query("INSERT INTO Job (job_title, category_id, position_id, job_month_rate, interval_id, currency_id, mode_id, location_id, contact_id, job_preface, job_acknowledgement, company_id) VALUES ('$title', '$category', '1', '$month_rate', '$interval', '$currency', '$mode', '$location', $contact, '$preface', '$acknowledgement', '$account_id')");
    }

    function update_job($account_id="", $job_id="", $title="", $category="", $position="", $mode="", $month_rate="", $interval="", $currency="", $location="", $contact="", $preface="", $acknowledgement=""){
        $this->db->query("UPDATE Job SET job_title = '$title', category_id = '$category', position_id = '$position', job_month_rate = '$month_rate', interval_id='$interval', currency_id= '$currency', mode_id='$mode', location_id='$location', contact_id='$contact', job_preface='$preface', job_acknowledgement='$acknowledgement' WHERE company_id = '$account_id' AND job_id = '$job_id'");
    }
    
    //Section

    function get_section_item($job_id="", $section_name=""){
        $query = $this->db->query("SELECT * FROM JobSectionItem WHERE job_id='$job_id' AND section_id = (SELECT section_id FROM JobSection WHERE LOWER(section_name)=LOWER('$section_name'))");
        return $query;
    }

    function add_section_item($job_id="", $section_name="", $item_name=""){
        $this->db->query("INSERT INTO JobSectionItem (job_id, section_id, item_name) VALUES('$job_id', (SELECT section_id FROM JobSection WHERE lower(section_name) = lower('$section_name')), '$item_name')");
    }

    function delete_section_item($job_id="", $section_name=""){
        $this->db->query("DELETE FROM JobSectionItem WHERE job_id = '$job_id' AND section_id = (SELECT section_id FROM JobSection WHERE lower(section_name) = lower('$section_name'))");
    }

    //Position

    function change_position($account_id="", $job_id="", $position_name=""){
        $this->db->query("UPDATE Job SET position_id=(SELECT position_id FROM JobPosition WHERE LOWER(position_name) = LOWER('$position_name')) WHERE company_id='$account_id' AND job_id='$job_id'");
    }

    function get_payment_interval(){
        $query = $this->db->query("SELECT * FROM PaymentInterval WHERE interval_job = 1");
        return $query;
    }

    

}

?>