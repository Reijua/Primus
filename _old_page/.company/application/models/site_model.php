<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_Model extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function get_information($language_tag="", $category="", $id=""){
        if($category!="" && $id!=""){
            if(!is_numeric($id)){
                $query=$this->db->query("SELECT * FROM Site INNER JOIN SiteTranslation USING(site_id) INNER JOIN SiteCategory USING(category_id) INNER JOIN SiteCategoryTranslation ON(SiteCategory.category_id = SiteCategoryTranslation.category_id AND SiteCategoryTranslation.language_id=SiteTranslation.language_id) WHERE site_url='$id' AND category_tag='$category' AND SiteTranslation.language_id=(SELECT language_id FROM Language WHERE UPPER(language_tag)=UPPER('$language_tag'))"); 
            }else{
                $query=$this->db->query("SELECT * FROM Site INNER JOIN SiteTranslation USING(site_id) INNER JOIN SiteCategory USING(category_id) INNER JOIN SiteCategoryTranslation ON(SiteCategory.category_id = SiteCategoryTranslation.category_id AND SiteCategoryTranslation.language_id=SiteTranslation.language_id) WHERE site_id='$id' AND category_tag='$category' AND SiteTranslation.language_id=(SELECT language_id FROM Language WHERE UPPER(language_tag)=UPPER('$language_tag'))"); 

            }
        }else if($category!="" && $id==""){
            $query=$this->db->query("SELECT * FROM Site INNER JOIN SiteTranslation USING(site_id) INNER JOIN SiteCategory USING(category_id) INNER JOIN Language USING(language_id) WHERE language_tag='$language_tag' AND category_tag='$category'"); 
        }
        return $query;
    }

    function get_category($language_tag="", $category=""){
        if($language_tag!="" && $category!=""){
            $query=$this->db->query("SELECT * FROM SiteCategory INNER JOIN SiteCategoryTranslation USING(category_id) INNER JOIN Language USING(language_id) WHERE language_tag='$language_tag' AND category_tag='$category'"); 
        }     
        return $query;
    }
}

?>