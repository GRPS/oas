<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Thanks extends Public_Controller {

    public function __construct()
    {
        parent::__construct();
        //if(!isset($_SESSION)) {session_start();}
        $this->load->model('page/page_model', 'page_model');
        $this->load->model('cart/cart_model', 'cart_model');
    }

    public function index()
    {

        $this->cart_model->delete();
        $cart_badge = $this->cart_model->badge();

        $data = array(
                        "cart_badge"            => $cart_badge
                    );

        $this->load->module('templates')->thanks_tpl($data);

    }

}

/* End of file */
