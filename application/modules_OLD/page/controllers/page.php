<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends Public_Controller {
    
    public function __construct()
    {    
        parent::__construct();
        //if(!isset($_SESSION)) {session_start();}
        $this->load->model('page/page_model', 'page_model');
        $this->load->model('cart/cart_model', 'cart_model');
    }
            
    public function index($id = "Home")
    {

        $advert = (isset($_GET['advert'])? true : false);
        
        $orig_id = $id;
        $id = ($id == "home_1page"?"home":$id);
        
        $cart_badge = $this->cart_model->badge();

        $page = $this->page_model->get($id);

        $meta = $this->page_model->get_meta($page->id);

        //Get arrays on codes to add.
        //Check $fanily and/or $brand and/or $type or $search and if it matches our campaign
        //then add campaign code to array so public_tpl can loop and add all required codes.            
        $google_conversions = array();

        $data = array(
                        "cart_badge"    => $cart_badge,
                        "view"          => "page/show",
                        "title"         => str_replace("-", " ", $page->id),
                        "h1"            => (isset($page->h1)?$page->h1:""),
                        "h2"            => (isset($page->h2)?$page->h2:""),
                        "meta"          => $meta,
                        "menu"          => $this->load->model("menu/menu_model")->main(),
                        "page"          => $page,
                        "ogimage"       => $this->config->item('domainPICTURES').$page->url.".jpg",
                        "advert"        => $advert,
                        "google_conversions"=> $google_conversions
                    );

        $id = $orig_id;
        if (strtolower($id) == "home") {
//            $sliders = db_get_records("slider", array());
//            $sliders = db_get_records_by_field("slider", array(), "sort_order");
            $query = "SELECT * FROM slider ORDER BY sort_order";
            $sliders = $this->db->query($query)->result();
            $data["slider_html"] = $this->load->view("slide", array("slides" => $sliders), true);
            $a=1;
            $this->load->module('templates')->home_tpl($data);
        } elseif (strtolower($id) == "home_1page") {
            $this->load->module('templates')->home_1page_tpl($data);        
        } else {
            $this->load->module('templates')->public_tpl($data);
        }

        
      
    }
    
}

/* End of file */
