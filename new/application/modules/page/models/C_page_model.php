<?php

class Page_Model extends CI_Model
{
    
    public function __construct() {
        parent::__construct();
    }
            
    public function get($id) {
        return db_get_record("pages", array("url" => strtolower($id)));
    }
    
    public function get_meta($id) {
        $id = str_replace(" ", "-", $id);
        //Override meta tags if we have a custom entry.
        $q = $this->db->query("SELECT * FROM meta WHERE family = '".strtolower($id)."'");
//        echo $this->db->last_query();
        if ($q->num_rows() > 0) {
//            echo "a";exit();
            $row = $q->row();
            $metaTitleExtra = $row->metatitle;
            $metaKeywordsExtra = $row->metakeywords;
            $metaDescriptionExtra = $row->metadescription;
            $metaImageExtra = $row->metaimage;
        } else {
//            echo "b";exit();
            $metaTitleExtra = "High quality jewellery and watches";            
            $metaKeywordsExtra = "";
            $metaDescriptionExtra = "High quality jewellery and watches";
            $metaImageExtra = "default.jpg";

        }
        
        $metaTitle = $metaTitleExtra." | Romsey &amp; Winchester in Hampshire";
        $metaDescription = $metaDescriptionExtra." and based in Romsey and Winchester in Hampshire areas.";
        $metaKeywords = "offord and sons, jewellery, romsey, winchester, hampshire, wedding, eternity, engagement, ".$metaKeywordsExtra;
        $metaImage = $metaImageExtra;
        
        return array("title" => rawurldecode($metaTitle), "description" => rawurldecode($metaDescription), "keywords" => rawurldecode($metaKeywords), "image" => rawurldecode($this->config->item("domainIMG").$metaImage));
        
    }
    
}