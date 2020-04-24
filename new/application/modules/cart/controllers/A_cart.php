<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends Public_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cart_model');        
    }
    
    public function index() {
        
        $cart_badge = $this->cart_model->badge();
        $cart = $this->nativesession->get('oascart');
        
        //Grab the thumbnail.
        if (isset($cart)) {
            foreach($cart as $c) {
                $product = db_get_record("product", array("id" => $c->id));
                $c->thumbnail = $product->thumbnail;
            }
        } else {
            $cart = array();
        }
        
        $data = array(
                        "meta"              => array("title" => "Shopping Cart", "description" => "", "keywords" => ""),
                        "cart_badge"        => $cart_badge,
                        "view"              => "cart/show",            
                        "title"             => "Shopping Cart",
                        "thumb"             => $this->config->item('domainLIVE')."/pictures/",
                        "cart"              => $cart,                        
                        "menu"              => $this->load->model("menu/menu_model")->main()
                        );

        $this->load->module('templates')->cart_tpl($data);
        
    }
    
    public function delete() {
        $this->cart_model->delete();
        redirect("cart");
    }
        
}

/* End of file */