<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends Public_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        

        $data = array(
                        "view"                  => "test"
                    );

            $this->load->module('templates')->test_tpl($data);




    }

}

/* End of file */
