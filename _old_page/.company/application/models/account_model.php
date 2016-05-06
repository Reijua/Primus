<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    function create_account($name, $email, $password_hash, $package){
        $this->db->query("INSERT INTO Company(company_name, company_email, company_password_hash, group_id) VALUES('$name','$email','$password_hash','$package')");
    }

    function create_membership($package){
        $this->db->query("INSERT INTO Company(company_name, company_email, company_password_hash, group_id) VALUES('$name','$email','$password_hash','$package')");
    }

    function get_detail($value=""){
        if(is_int($value)){
           $query=$this->db->query("SELECT * FROM Company INNER JOIN CompanyGroup USING(group_id) WHERE company_id = '$value'");
        }else{
            $query=$this->db->query("SELECT * FROM Company INNER JOIN CompanyGroup USING(group_id) WHERE company_email = '$value'");
        }    	
        return $query;
    }



    function get_current_package($account_id){
        $query = $this->db->query("SELECT * FROM CompanyPackage WHERE company_id = $account_id AND NOW() BETWEEN package_from AND package_to");
        return $query;
    }

    function update_password($account_id,$hash){
        $this->db->query("UPDATE Company SET company_password_hash='$hash' WHERE company_id=$account_id");
    }

    function log_last_login($account_id,$ip){
        $this->db->query("UPDATE Company SET company_last_ip='$ip' WHERE company_id='$account_id'");
    }

    /* Logo */
    function upload_logo($account_id, $image){
        $this->db->query("UPDATE Company SET company_logo = '$image' WHERE company_id=$account_id");
    }
    function remove_logo($account_id){
        $this->db->query("UPDATE Company SET company_logo = NULL WHERE company_id=$account_id");
    }

    /* Banner */
    function upload_banner($account_id, $image){
        $this->db->query("UPDATE Company SET company_banner = '$image' WHERE company_id=$account_id");
    }
    function remove_banner($account_id){
        $this->db->query("UPDATE Company SET company_banner = NULL WHERE company_id=$account_id");
    }

    /* Location */
    function get_location($account_id = "", $location_id = ""){
        if($location_id==""){
            $query = $this->db->query("SELECT * FROM Location INNER JOIN Country USING(country_id) WHERE company_id='$account_id'");
        }else{
            $query = $this->db->query("SELECT * FROM Location INNER JOIN Country USING(country_id) WHERE company_id='$account_id' AND location_id='$location_id'");
        }
        return $query;        
    }

    

    function add_location($account_id="", $name="", $address="", $pc="", $city="", $country="", $email="", $phone="", $fax="", $website=""){
        $this->db->query("INSERT INTO Location(company_id, location_name, location_address, location_pc, location_city, country_id, location_email, location_phone, location_fax, location_website) VALUES('$account_id','$name','$address', '$pc', '$city', '$country', '$email', '$phone', '$fax', '$website')");
    }

    function update_location($account_id = "", $location_id = "", $name="", $address="", $pc="", $city="", $country="", $email="", $phone="", $fax="", $website=""){
        $this->db->query("UPDATE Location SET location_name='$name', location_address='$address', location_pc='$pc', location_city='$city', country_id='$country', location_email='$email', location_phone='$phone', location_fax='$fax', location_website='$website' WHERE company_id='$account_id' AND location_id='$location_id'");
    }

    function delete_location($account_id = "", $location_id = ""){
        $this->db->query("DELETE FROM Location WHERE company_id='$account_id' AND location_id='$location_id'");
    }

    /* Contact */
    function get_contact($account_id = "", $contact_id = ""){
        if($contact_id==""){
            $query = $this->db->query("SELECT * FROM Contact INNER JOIN Gender USING(gender_id) WHERE company_id='$account_id'");
        }else{
            $query = $this->db->query("SELECT * FROM Contact INNER JOIN Gender USING(gender_id) WHERE company_id='$account_id' AND contact_id='$contact_id'");
        }
        return $query;        
    }

    function add_contact($account_id="", $portrait="", $gender="", $title="", $firstname="", $lastname="", $position="", $email="", $phone=""){
        $this->db->query("INSERT INTO Contact(company_id, contact_portrait, gender_id, contact_title, contact_firstname, contact_lastname, contact_position, contact_email, contact_phone) VALUES($account_id, '$portrait', $gender, '$title', '$firstname', '$lastname', '$position', '$email', '$phone')");

    }

    function update_contact($account_id="", $contact_id="", $portrait="", $gender="", $title="", $firstname="", $lastname="", $position="", $email="", $phone=""){
        $this->db->query("UPDATE Contact SET contact_portrait='$portrait', gender_id='$gender', contact_title='$title', contact_firstname='$firstname', contact_lastname='$lastname', contact_position='$position', contact_email='$email', contact_phone='$phone' WHERE company_id='$account_id' AND contact_id='$contact_id'");

    }

    function delete_contact($account_id = "", $contact_id = ""){
        $this->db->query("DELETE FROM Contact WHERE company_id='$account_id' AND contact_id='$contact_id'");
    }

    /* Branche */
    function get_branche($id=""){
        if($id==""){
            $query = $this->db->query("SELECT * FROM Branche");
        }else{
            $query = $this->db->query("SELECT * FROM Branche WHERE branche_id = '$id'");
        }
        return $query;
    }

    function update_profile($account_id, $branche="", $amount_of_employee="", $employee_per_year="", $most_common_employees="", $release_year="", $location="", $contact="", $description="", $facebook="", $google_plus="", $linkedin="", $twitter="", $xing="", $youtube=""){
        $this->db->query("UPDATE Company SET branche_id='$branche', amount_of_employee='$amount_of_employee', employee_per_year='$employee_per_year', most_common_employee='$most_common_employees', company_release_year='$release_year', location_id='$location', contact_id='$contact', company_description='$description', company_facebook='$facebook', company_google_plus='$google_plus', company_linkedin='$linkedin', company_twitter='$twitter', company_xing='$xing', company_youtube='$youtube' WHERE company_id='$account_id'"); 
    }
}

?>