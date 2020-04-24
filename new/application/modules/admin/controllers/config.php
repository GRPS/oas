<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('config_model');        
    }
    
    public function index() {
                
        $config = db_get_records("config", array());
        
        $data = array(
                "menu"          => $this->load->model("menu/menu_model")->admin(),
                'page_title'    => "Table Configuration",
                'view'          => "admin/config/list",
                'config'        => $config,
                'btn_view'      => array(
                                        'show' => true,
                                        'url' => 'config/edit/', 
                                        'title' => "Open record",
                                        'label' => $this->config->item('icon_view')." View"
                                        )
        );
            
        $this->load->module('templates')->admin_tpl($data);
            
    }
    
    public function edit($id) {
        
        $config = db_get_record("config", array("uid" => $id));
        
        $data = array(
                "menu"          => $this->load->model("menu/menu_model")->admin(),
                'page_title'    => "Table Configuration: ",
                'view'          => "admin/config/edit",
                'config'        => $config,
                'json_viewer'   => "http://jsonviewer.stack.hu/",
                'btn_cancel'    => array(
                                        'show' => true,
                                        'url' => site_url('admin/config'), 
                                        'title' => "Cancel changes.",
                                        'label' => $this->config->item('icon_cancel')."Cancel"
                                        ),
                'btn_save'      => array(
                                        'show' => true,
                                        'url' => site_url('admin/config/save'), 
                                        'title' => "Save Record",
                                        'label' => $this->config->item('icon_save')."Save"
                                        )
        );
            
        $this->load->module('templates')->admin_tpl($data);
        
    }
    
    public function save() {
        $post = (object) $this->input->post();
        db_update_record("config", array("uid" => $post->uid), array("json" => json_decode(json_encode($post->json, JSON_FORCE_OBJECT))));
        redirect('admin/config');
    }
     
}

/* End of file */