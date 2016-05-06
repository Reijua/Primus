<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_branche(){
        $query = $this->db->query("SELECT * FROM Branche");
        return $query;
    } 

    function get_company($type="",$company_id=""){
        switch ($type) {
            case 'all':
            $query = $this->db->query("SELECT * FROM Company");
            break;
            case 'paltinum':
            $query = $this->db->query("SELECT * FROM Company INNER JOIN CompanyGroup USING(group_id) WHERE LOWER(group_name)=LOWER('Platinum')");
            break;
            case 'gold':
            $query = $this->db->query("SELECT * FROM Company INNER JOIN CompanyGroup USING(group_id) WHERE LOWER(group_name)=LOWER('Gold')");
            break;
            case 'silver':
            $query = $this->db->query("SELECT * FROM Company INNER JOIN CompanyGroup USING(group_id) WHERE LOWER(group_name)=LOWER('Silver')");
            break;
            default:
            $query = $this->db->query("SELECT * FROM Company");
            break;
        }
        return $query;
    }

}

?>