<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {
    
    public function __construct() {
        parent::__construct();

        if(!$this->is_logged_in()) {
            redirect('auth/login');
        }
        
    }        
  
    protected function is_logged_in() {
      return ( isset($_SESSION['loggedin']) );
    }
    
}

/* End of file */
