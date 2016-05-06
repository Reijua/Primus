<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    function get_currency(){
    	$query = $this->db->query("SELECT * FROM Currency");
        return $query;
    }

    function get_interval(){
    	$query = $this->db->query("SELECT * FROM PaymentInterval WHERE interval_product = 1");
        return $query;
    }

    function get_product($account_id="", $product_id=""){
        $query = $this->db->query("SELECT * FROM Product INNER JOIN Currency USING(currency_id) INNER JOIN PaymentInterval USING(interval_id) WHERE company_id = '$account_id'");
        return $query;
    }

}

?>