<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends Public_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');        
    }
    
    public function index() {
        
    }
    
    public function main($reset = "")
    {
        $data = $this->menu_model->main($reset);
        return $data;
    }
    
    public function kill($item = 'menu_main') {
        $this->menu_model->kill($item);
    }
        
}

/* End of file */