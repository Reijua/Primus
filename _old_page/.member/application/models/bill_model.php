<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bill_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    /*****************/
    /* Privilege (s) */
    /*****************/

    function get_privilege($p_group_id, $p_type_name){
        $db_default = $this->load->database('default', TRUE);
        $query = $db_default->query("SELECT * FROM Model INNER JOIN ModelPrivilege USING(model_id) INNER JOIN ModelPrivilegeType USING(type_id) WHERE group_id = ? AND UPPER(type_name) = UPPER(?) AND LOWER(model_name)= LOWER('Bill_Model')",array($p_group_id, $p_type_name));
        return $query;
    }

    /*****************/
    /* Privilege (e) */
    /*****************/

    /************/
    /* Bill (s) */
    /************/

    function create_bill($p_company_id, $p_status_id, $p_address, $p_pc, $p_city){
        $db_partner = $this->load->database('partner', TRUE);
        $db_partner->query("INSERT INTO Bill(bill_year, company_id, status_id, bill_date, bill_address, bill_pc, bill_city) VALUES(DATE_FORMAT(NOW(), '%Y'), ?, ?, NOW(), ?, ?, ?)", array($p_company_id, $p_status_id, $p_address, $p_pc, $p_city));
        return $db_partner->insert_id();
    }

    function get_bill($bill_year = "", $bill_id = ""){
        $db_partner = $this->load->database('partner', TRUE);
        if($bill_year == "" && $bill_id == ""){
            $query = $db_partner->query("SELECT * FROM Bill INNER JOIN BillStatus USING(status_id) INNER JOIN Company USING(company_id) ORDER BY bill_year DESC, bill_id DESC");
        }else{
            $query = $db_partner->query("SELECT * FROM Bill INNER JOIN BillStatus USING(status_id) INNER JOIN Company USING(company_id) WHERE bill_year = ? AND bill_id = ? ", array($bill_year, $bill_id));
        }
        return $query;
    }

    function update_bill($p_bill_year, $p_bill_id, $p_company_id, $p_status_id, $p_address, $p_pc, $p_city){
        $db_partner = $this->load->database('partner', TRUE);
        $db_partner->query("UPDATE Bill SET company_id = ?, status_id = ?, bill_address = ?, bill_pc = ?, bill_city = ? WHERE bill_year = ? AND bill_id = ?", array($p_company_id, $p_status_id, $p_address, $p_pc, $p_city, $p_bill_year, $p_bill_id));
    }

    /************/
    /* Bill (e) */
    /************/

    /******************/
    /* Bill Items (s) */
    /******************/

    function add_item($p_bill_year, $p_bill_id, $p_item_text, $p_item_price){
        $db_partner = $this->load->database('partner', TRUE);
        $db_partner->query("INSERT INTO BillItem (bill_year, bill_id, item_text, item_price) VALUES(?, ?, ?, ?)", array($p_bill_year, $p_bill_id, $p_item_text, $p_item_price));
    }

    function get_item($p_bill_year, $p_bill_id){
        $db_partner = $this->load->database('partner', TRUE);
        $query = $db_partner->query("SELECT * FROM BillItem WHERE bill_year = ? AND bill_id = ?", array($p_bill_year, $p_bill_id));
        return $query;
    }

    function delete_item($p_bill_year, $p_bill_id){
        $db_partner = $this->load->database('partner', TRUE);
        $db_partner->query("DELETE FROM BillItem WHERE bill_year = ? AND bill_id = ? ", array($p_bill_year, $p_bill_id));
    }

    function get_sum($p_bill_year, $p_bill_id){
        $db_partner = $this->load->database('partner', TRUE);
        return $db_partner->query("SELECT SUM(item_price) AS bill_sum FROM BillItem WHERE bill_year = ? AND bill_id = ?", array($p_bill_year, $p_bill_id))->row()->bill_sum;
    }

    /******************/
    /* Bill Items (e) */
    /******************/

    /**************/
    /* Status (s) */
    /**************/

    function get_status($p_status_id = ""){
        $db_partner = $this->load->database('partner', TRUE);
        if($p_status_id == ""){
            $query = $db_partner->query("SELECT * FROM BillStatus");
        }else{
            $query = $db_partner->query("SELECT * FROM BillStatus WHERE status_id = ? ", array($p_status_id));
        }        
        return $query;
    }

    /**************/
    /* Status (e) */
    /**************/

}

?>