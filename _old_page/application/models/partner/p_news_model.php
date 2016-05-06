<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_Model extends CI_Model {

    function __construct(){
        parent::__construct();
    }

    /*****************/
    /* Privilege (s) */
    /*****************/

    function get_privilege($p_group_id = "", $p_type_name = ""){
        $db_default = $this->load->database('default', TRUE);
        $query = $db_default->query("SELECT * FROM Model INNER JOIN ModelPrivilege USING(model_id) INNER JOIN ModelPrivilegeType USING(type_id) WHERE group_id = ? AND UPPER(type_name) = UPPER(?) AND LOWER(model_name) = LOWER('News_Model')", array($p_group_id, $p_type_name));
        return $query;
    }

    /*****************/
    /* Privilege (e) */
    /*****************/

    /**************/
    /* Banner (s) */
    /**************/

    function get_banner($p_cdn_url = "", $p_news_id = ""){
        $v_url = null;
        if(file_exists(FCPATH."../resource/image/news/".$p_news_id.".png")){
            $v_url = $p_cdn_url."image/news/".$p_news_id.".png";
        }else if(file_exists(FCPATH."../resource/image/news/".$p_news_id.".jpg")){
            $v_url = $p_cdn_url."image/news/".$p_news_id.".jpg";
        }else if(file_exists(FCPATH."../resource/image/news/".$p_news_id.".jpeg")){
            $v_url = $p_cdn_url."image/news/".$p_news_id.".jpeg";
        }else{
            $v_url = "";
        }
        return $v_url;
    }

    function delete_banner($p_news_id = ""){
        if(file_exists(FCPATH.'../resource/image/news/'.$p_news_id.'.png')){
            unlink(FCPATH.'../resource/image/news/'.$p_news_id.'.png');
        }else if(file_exists(FCPATH.'../resource/image/news/'.$p_news_id.'.jpg')){
            unlink(FCPATH.'../resource/image/news/'.$p_news_id.'.jpg');
        }else if(file_exists(FCPATH.'../resource/image/news/'.$p_news_id.'.jpeg')){
            unlink(FCPATH.'../resource/image/news/'.$p_news_id.'.jpeg');
        }
    }

    /**************/
    /* Banner (e) */
    /**************/

    /****************/
    /* Category (s) */
    /****************/

    function create_category($p_category_name = ""){
        $db_website = $this->load->database("website", TRUE);
        $db_website->query("INSERT INTO NewsCategory(category_name) VALUES(?)", array($p_category_name));
    }

    function get_category($p_category_id = ""){
        $db_website = $this->load->database("website", TRUE);
        if($p_category_id==""){
            $query = $db_website->query("SELECT * FROM NewsCategory");
        }else{
            $query = $db_website->query("SELECT * FROM NewsCategory WHERE category_id = ? ", array($p_category_id));
        }
        return $query;
    }

    function update_category($p_category_id = "", $p_category_name = ""){
        $db_website = $this->load->database("website", TRUE);
        $db_website->query("UPDATE NewsCategory SET category_name = ? WHERE category_id = ? ", array($p_category_name, $p_category_id));
    }

    function delete_category($p_category_id = ""){
        $db_website = $this->load->database("website", TRUE);
        $db_website->query("DELETE FROM NewsCategory WHERE category_id = ? ", array($p_category_id));
    }

    /****************/
    /* Category (e) */
    /****************/

    /************/
    /* News (s) */
    /************/

    function create_news($p_title = "", $p_category_id = "", $p_text = ""){
        $db_website = $this->load->database("website", TRUE);
        $db_website->query("INSERT INTO News (news_title, category_id, news_text, news_release_date) VALUES(?, ?, ?, NOW())", array($p_title, $p_category_id, $p_text));
        return $db_website->insert_id();
    }

    function get_news($p_command = "", $p_data= ""){
        $db_website = $this->load->database("website", TRUE);
        $v_type = preg_split("[:]", $p_command);
        switch ($v_type[0]) {
            case "filter":
                switch ($v_type[1]) {
                    case "category":
                        $query = $db_website->query("SELECT * FROM News INNER JOIN NewsCategory USING(category_id) WHERE category_id = ? ", array($p_data));
                    break;
                }
            break;
            case "all":
                if($p_data == ""){
                    $query = $db_website->query("SELECT * FROM News INNER JOIN NewsCategory USING(category_id) ORDER BY news_release_date DESC");
                }else{
                    $query = $db_website->query("SELECT * FROM News INNER JOIN NewsCategory USING(category_id) WHERE news_id = ? ", array($p_data));
                }
            break;
        }        
        return $query;
    }    

    function update_news($p_id = "", $p_title = "", $p_category_id = "", $p_text = ""){
        $db_website = $this->load->database("website", TRUE);
        $db_website->query("UPDATE News SET news_title = ?, category_id = ?, news_text = ? WHERE news_id = ? ", array($p_title, $p_category_id, $p_text, $p_id));
    }

    function delete_news($p_news_id = ""){
        $db_website = $this->load->database("website", TRUE);
        $db_website->query("DELETE FROM News WHERE news_id = ? ", array($p_news_id));
    }

    /************/
    /* News (e) */
    /************/

    /***************/
    /* Gallery (s) */
    /***************/

    function get_gallery($p_news_id = ""){
        $db_website = $this->load->database("website", TRUE);
        $query = $db_website->query("SELECT * FROM NewsGallery INNER JOIN Gallery USING(gallery_id) WHERE news_id = ? ORDER BY gallery_release_date", array($p_news_id));
        return $query;
    }

    function add_gallery($p_news_id = "", $p_gallery_id = ""){
        $db_website = $this->load->database("website", TRUE);
        $db_website->query("INSERT INTO NewsGallery(news_id, gallery_id) VALUES(?, ?)", array($p_news_id, $p_gallery_id));
    }

    function delete_gallery($p_news_id = ""){
        $db_website = $this->load->database("website", TRUE);
        $db_website->query("DELETE FROM NewsGallery WHERE news_id = ? ", $p_news_id);
    }

    /***************/
    /* Gallery (e) */
    /***************/

}

?>