<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends Public_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');        
    }
    
    public function index() {
        echo "hello from auth.";
    }
    
    public function login() {
            
        $data = array(
            'page_title'    => "admin Login",
            'view'          => 'auth/public'
        );

        $this->load->module('templates')->admin_tpl($data);                       

    }

    public function login_attempt() {
    
        //Check user and pass against database
        //redirect to auth/login if failed.
        
        $post = (object) $this->input->post();
        
        $user = db_get_record("users", array("name" => $post->username, "password" => md5($post->pwd)));
        
        
        if(!empty($user)) {
            //$_SESSION['loggedin'] = 1;
            $this->nativesession->set('loggedin', 1);
        } 
        
        redirect('admin');
        
    }
    
    public function logout() {
        
        //unset($_SESSION['loggedin']);
        $this->nativesession->delete('loggedin');
        redirect('/');
        
    }
        
}

/* End of file */