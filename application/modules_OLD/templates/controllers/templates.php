<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends MX_Controller {
    
    public function __construct()
    {    
        parent::__construct();
    }
     
    public function test_tpl($data = array())
    {
        $this->load->view('test', $data);       
    }
    
    public function home_tpl($data = array())
    {
        $data['specialoffers'] = $this->load->model('product/product_model')->getSpecialOffers();
        $data['all'] = serialize($data); //We want to show all data passed to the view by not putting it into the session.
        $this->load->view('home', $data);       
    }
    
    public function home_1page_tpl($data = array())
    {
        $data['all'] = serialize($data); //We want to show all data passed to the view by not putting it into the session.
        $this->load->view('home_1page', $data);       
    }
    
    public function public_tpl($data = array())
    {
        $data['specialoffers'] = $this->load->model('product/product_model')->getSpecialOffers();
        $data['all'] = serialize($data); //We want to show all data passed to the view by not putting it into the session.
        $this->load->view('public', $data);       
    }
    
    public function cart_tpl($data = array())
    {
        $data['specialoffers'] = $this->load->model('product/product_model')->getSpecialOffers();
        $data['all'] = serialize($data); //We want to show all data passed to the view by not putting it into the session.
        $this->load->view('cart', $data);       
    }
    
    public function admin_tpl($data = array())
    {
        $data['all'] = serialize($data); //We want to show all data passed to the view by not putting it into the session.
        $this->load->view('admin', $data);       
    }
    
    public function thanks_tpl($data = array())
    {
        $data['all'] = serialize($data); //We want to show all data passed to the view by not putting it into the session.
        $this->load->view('thanks', $data);       
    }
    
}

/* End of file */
