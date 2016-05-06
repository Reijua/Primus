<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bill_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function create_bill($bill_year="", $account_id="", $list, $address="", $pc="", $city=""){
        $this->db->query("INSERT INTO Bill(bill_year, company_id, bill_date, bill_address, bill_pc, bill_city) VALUES($bill_year, $account_id, SYSDATE(), '$address', '$pc', '$city');");
        foreach ($list as $row) {
            $this->db->query("INSERT INTO BillList(bill_year, bill_id, item_name, item_price) VALUES($bill_year, (SELECT MAX(bill_id) FROM Bill WHERE company_id='$account_id' AND bill_year='$bill_year'),'".$row[0]."','".$row[1]."')");
        }        
    }

    function get_bill($account_id="", $bill_year="" ,$bill_id=""){
        if($bill_id==""){
            $query=$this->db->query("SELECT *,DATE_FORMAT(bill_date,'%d.%m.%Y') AS bill_fdate FROM Bill WHERE company_id = '$account_id'");    
        }else{
             $query=$this->db->query("SELECT *,DATE_FORMAT(bill_date,'%d.%m.%Y') AS bill_fdate FROM Bill WHERE company_id = '$account_id' AND bill_year = '$bill_year' AND bill_id = '$bill_id'");
        }       
        return $query;
    }

    function get_last_bill_id($account_id="", $bill_year=""){
        $query=$this->db->query("SELECT MAX(bill_id) AS last_id FROM Bill WHERE company_id='$account_id' AND bill_year='$bill_year'");
        return $query;
    }

    function get_item($item_name){
        $query=$this->db->query("SELECT * FROM BillItem WHERE item_name = '$item_name'");
        return $query;
    }

    function get_item_list($account_id="", $bill_year="",$bill_id=""){
        $query=$this->db->query("SELECT * FROM Bill INNER JOIN BillList ON(Bill.bill_id = BillList.bill_id AND Bill.bill_year = BillList.bill_year) WHERE company_id = '$account_id' AND Bill.bill_year='$bill_year' AND Bill.bill_id = '$bill_id'");    
        return $query;
    }

}

?>