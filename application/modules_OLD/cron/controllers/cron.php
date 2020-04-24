<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends Public_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cron_model');        
    }
    
    public function index() {
        
        $family = (isset($_GET['family'])?$_GET['family']:"");
        $brand = (isset($_GET['brand'])?$_GET['brand']:"");
        $type = (isset($_GET['type'])?$_GET['type']:"");

        echo json_encode($this->cron_model->breadcrumb_pickers($family, $brand, $type));
        
    }
    
    
}

/* End of file */