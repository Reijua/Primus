<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bill_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    /************/
    /* Bill (s) */
    /************/

    function get_bill($p_partner_id, $bill_year = "", $bill_id = ""){
        $db_default = $this->load->database('default', TRUE);
        if($bill_year == "" && $bill_id == ""){
            $query = $db_default->query("SELECT * FROM Bill INNER JOIN BillStatus USING(status_id) INNER JOIN Company USING(company_id) WHERE company_id = ? ORDER BY bill_year DESC, bill_id DESC", array($p_partner_id));
        }else{
            $query = $db_default->query("SELECT * FROM Bill INNER JOIN BillStatus USING(status_id) INNER JOIN Company USING(company_id) WHERE company_id = ? AND bill_year = ? AND bill_id = ? ", array($p_partner_id, $bill_year, $bill_id));
        }
        return $query;
    }

    /************/
    /* Bill (e) */
    /************/

    /******************/
    /* Bill Items (s) */
    /******************/

    function get_item($p_bill_year, $p_bill_id){
        $db_default = $this->load->database('default', TRUE);
        $query = $db_default->query("SELECT * FROM BillItem WHERE bill_year = ? AND bill_id = ?", array($p_bill_year, $p_bill_id));
        return $query;
    }

    function get_sum($p_bill_year, $p_bill_id){
        $db_default = $this->load->database('default', TRUE);
        return $db_default->query("SELECT SUM(item_price) AS bill_sum FROM BillItem WHERE bill_year = ? AND bill_id = ?", array($p_bill_year, $p_bill_id))->row()->bill_sum;
    }

    /******************/
    /* Bill Items (e) */
    /******************/

    /**************/
    /* Status (s) */
    /**************/

    function get_status($p_status_id = ""){
        $db_default = $this->load->database('default', TRUE);
        if($p_status_id == ""){
            $query = $db_default->query("SELECT * FROM BillStatus");
        }else{
            $query = $db_default->query("SELECT * FROM BillStatus WHERE status_id = ? ", array($p_status_id));
        }        
        return $query;
    }

    /**************/
    /* Status (e) */
    /**************/

}

?>