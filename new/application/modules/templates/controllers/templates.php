<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends MX_Controller {
    
    public function __construct()
    {    
        parent::__construct();
    }
    
    public function test_tpl($data = array()) {
        $data['specialoffers'] = $this->load->model('product/product_model')->getSpecialOffers();
        $data['all'] = serialize($data);
        $this->load->view('test', $data);       
    }
    
    public function home_tpl($data = array()) {
        $data['specialoffers'] = $this->load->model('product/product_model')->getSpecialOffers();
        $data['all'] = serialize($data);
        $this->load->view('home', $data);       
    }
        
    public function page_tpl($data = array()) {
        $data['specialoffers'] = $this->load->model('product/product_model')->getSpecialOffers();
        $data['all'] = serialize($data);
        $this->load->view('page', $data);       
    }
    
    public function product_tpl($data = array()) {
        $data['specialoffers'] = $this->load->model('product/product_model')->getSpecialOffers();
        $data['all'] = serialize($data);
        $this->load->view('product', $data);       
    }
    
    public function info_tpl($data = array()) {
        $data['specialoffers'] = $this->load->model('product/product_model')->getSpecialOffers();
        $data['all'] = serialize($data);
        $this->load->view('info', $data);       
    }
    
    public function cart_tpl($data = array()) {
        $data['specialoffers'] = $this->load->model('product/product_model')->getSpecialOffers();
        $data['all'] = serialize($data);
        $this->load->view('cart', $data);       
    }
    
    public function admin_tpl($data = array()) {
        $data['all'] = serialize($data);
        $this->load->view('admin', $data);       
    }
    
    public function thanks_tpl($data = array()) {
        $data['all'] = serialize($data);
        $this->load->view('thanks', $data);       
    }
    
}

/* End of file */
