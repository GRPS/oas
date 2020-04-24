<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends Public_Controller {
    
    public function __construct()
    {    
        parent::__construct();
        //if(!isset($_SESSION)) {session_start();}
        $this->load->model('test/test_model');
    }
            
    public function index() {
        
        $data = array(
                        "view"          => "test",
                        "slider_html"   => $this->load->view("page/slide", array("slides" => db_get_records("slider", array())), true)
                    );
        
        $this->load->module('templates')->test_tpl($data);
        
    }
    
}

/* End of file */
