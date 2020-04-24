<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');        
    }
    
    public function delete_config() {
        $this->nativesession->setset('json', null);
    }
    
    public function index() {

        $page_menu = db_get_record("pages", array("id"=>"Menu"));
        $page_speedy_price = db_get_record("pages", array("id"=>"Speedy Price"));
        
        $data = array(
                'page_title'            => "Dashboard",
                'view'                  => 'admin/begin',
                'menu_update'           => $page_menu->url,
                'speedy_price_update'   => $page_speedy_price->url,
                'menu'                  => $this->load->model('menu/menu_model')->admin(),
                'po3_metal'             => db_get_records("po3_metal", array()),
                'po4_metal'             => db_get_records("po4_metal", array()),
                'po4_price'             => db_get_records("po4_price", array())
            );

        $this->load->module('templates')->admin_tpl($data);
            
    }
    
    public function update_facebook() {
        $url = "http://www.offordandsons.co.uk/";
        $pages = array("about-us","bespoke-jewellery","old-gold","services","valuations","jewellery-insurance","anniversaries","birthstones","zodiac-stones","diamonds","pearls","contact-us");
        $urlcurl = "http://developers.facebook.com/tools/debug/og/object?scrape=true&q=";
            
        $ch = curl_init();   
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER, false);
        foreach($pages as $page) {
            $fullurl = $urlcurl.$url.$page;
            curl_setopt($ch,CURLOPT_URL,$fullurl);
            $output=curl_exec($ch); 
            echo "<h4>".$fullurl."</h4>";
            echo $output;         
        }
        curl_close($ch);
        return $output;
    
    }
    
    public function set_menu() {
        $this->load->model('menu/menu_model')->set_menu();
        redirect(base_url('admin'));
        
    }
          
    public function open_table($table) {
        
        $post = (object) $this->input->post(); 
        
        //Get json configuration.
        $json = $this->admin_model->load_table_config($table);
        if(!isset($json->table)) {$json = $this->admin_model->load_table_config($table);}
        
        if (isset($post->query)) {
            if($post->query == "") {
                $data = $this->admin_model->get_read_data($table, $json);
            } else {
                $data = $this->db->query($post->query)->result_array();
            }            
        } else {
            $data = $this->admin_model->get_read_data($table, $json);
        }
       
        $data = array(
                "menu"          => $this->load->model("menu/menu_model")->admin(),
                'page_title'    => $json->title,
                'view'          => 'admin/show_table',
                'data'          => $data,
                'table'         => $table,
                'records'       => "records",
                'json'          => $json,
                'btn_back'      => array(
                                        'show'  => true,
                                        'url'   => site_url('admin'), 
                                        'title' => "Return to Admin.",
                                        'label' => $this->config->item('icon_back')."Admin"
                                        ),
                'btn_add'       => array(
                                        'show'  => (isset($json->hide_add)?false:true),
                                        'url'   => site_url('admin/add/'.$table), 
                                        'title' => "Add record",
                                        'label' => $this->config->item('icon_add')."Add"
                                        ),
                'btn_query'       => array(
                                        'show'  => true, 
                                        'url'   => base_url('admin/open_table/'.$json->table),
                                        'title' => "Run query.",
                                        'label' => "Run"
                                        )
            );
        
        if (isset($post->query)) {
            $data['query'] = $post->query;
        }
            
        $this->load->module('templates')->admin_tpl($data);
        
    }    
    
    public function view($table, $id, $mode = "read") {
        
        $data = (array) db_get_record($table, array("uid" => $id));
        
        //Get json configuration.
        $json = $this->admin_model->load_table_config($table);
        if(!isset($json->table)) {$json = $this->admin_model->load_table_config($table);}
        
        //Check if we need to preload data for loop selects.
        $preloads = array();
        if (isset($json->preload)) {
            foreach ($json->preload as $preload){
                $p = db_get_records_only_fields($preload->table, $preload->col_value.",".$preload->col_text);
                $arr = array();
                foreach($p as $v) {
                    $o = new stdClass();
                    $o->value = $v[$preload->col_value];
                    $o->text = $v[$preload->col_text];
                    $arr[] = $o;
                }
                $preloads[$preload->table] = $arr;
            }
        }
        
        if (isset($json->carats)) {
            $product = db_get_record("product", array("id" => $data['id']));
            $carats = $this->admin_model->get_carats($product->diamonddefault);
        }
        
        //$this->getJSONSession($json);
        //if(!isset($json->title)) {$this->getJSONSession($json);}
        
        $data = array(
                "menu"          => $this->load->model("menu/menu_model")->admin(),
                'page_title'    => ($mode=="read"?"":"Edit ").$json->title,
                'mode'          => $mode,
                'view'          => 'admin/item',
                'preloads'      => $preloads,
                'data'          => $data,
                'json'          => $json,
                'btn_back'      => array(
                                        'show' => true,
                                        'url' => site_url('admin/open_table/'.$table), 
                                        'title' => "Return to ".$json->title.".",
                                        'label' => $this->config->item('icon_back')."Return to ".$json->title
                                        ),
                'btn_edit'      => array(
                                        'show' => true,
                                        'url' => site_url('admin/view/'.$table."/".$id."/edit"), 
                                        'title' => "Edit Record",
                                        'label' => $this->config->item('icon_edit')."Edit"
                                        ),
                'btn_cancel'    => array(
                                        'show' => true,
                                        'url' => site_url('admin/view/'.$table."/".$id), 
                                        'title' => "Cancel changes.",
                                        'label' => $this->config->item('icon_cancel')."Cancel"
                                        ),
                'btn_save'      => array(
                                        'show' => true,
                                        'url' => site_url('admin/save'), 
                                        'title' => "Save Record",
                                        'label' => $this->config->item('icon_save')."Save"
                                        ),
                'btn_delete'    => array(
                                        'show' => true,
                                        'url' => site_url('admin/delete/'.$table."/".$id), 
                                        'title' => "Delete Record",
                                        'label' => $this->config->item('icon_delete'),
                                        'class' => "pull-right"
                                        )
            );
        
        if (isset($json->carats)) {
            $data['carats'] = $carats;
        }
        
        $this->load->module('templates')->admin_tpl($data);
        
    }

    public function save() {
        
        //Get posted data and extract the table and uid.
        $post = (object) $this->input->post();        
        $tbl = $post->table;
        $uid = $post->uid;
        
        //Remove items we don't want to be inserted or updated in the record.
        unset($post->table);
        unset($post->uid);
            
        if ($uid == "") {
            db_insert($tbl, $post);
            $uid = $this->db->insert_id();
        } else {
            db_update_record($tbl, array("uid" => $uid), $post);
        }
        
        //Open record in read mode.
        redirect('admin/view/'.$tbl.'/'.$uid);
        
    }
    
    public function add($table) {
        
        $data['table'] = $table;
        $data['uid'] = "";
        
        //$json = json_decode(file_get_contents(base_url('docs/'.$table.'.json')));
        $json = $this->admin_model->load_table_config($table);
        if(!isset($json->table)) {$json = $this->admin_model->load_table_config($table);}
            
        //Check if we need to preload data for loop selects.
        $preloads = array();
        if (isset($json->preload)) {
            foreach ($json->preload as $preload){
                $p = db_get_records_only_fields($preload->table, $preload->col_value.",".$preload->col_text);
                $arr = array();
                foreach($p as $v) {
                    $o = new stdClass();
                    $o->value = $v[$preload->col_value];
                    $o->text = $v[$preload->col_text];
                    $arr[] = $o;
                }
                $preloads[$preload->table] = $arr;
            }
        }
        
        if (isset($json->carats)) {
            $carats = $this->admin_model->get_carats();
        }
        
        //$this->getJSONSession($json);
        //if(!isset($json->title)) {$this->getJSONSession($json);}
        
        $data = array(
                "menu"          => $this->load->model("menu/menu_model")->admin(),
                'page_title'    => "Add ".$json->title,
                'mode'          => "add",
                'view'          => 'admin/item',
                'preloads'      => $preloads,
                'data'          => $data,
                'json'          => $json,
                'btn_back'      => array(
                                        'show' => true,
                                        'url' => site_url('admin/open_table/'.$table), 
                                        'title' => "Return to ".$table.".",
                                        'label' => $this->config->item('icon_back')."Return to ".$table
                                        ),
                'btn_cancel'    => array(
                                        'show' => true,
                                        'url' => site_url('admin/view/'.$table), 
                                        'title' => "Cancel changes.",
                                        'label' => $this->config->item('icon_cancel')."Cancel"
                                        ),
                'btn_save'      => array(
                                        'show' => true,
                                        'url' => site_url('admin/save'), 
                                        'title' => "Save Record",
                                        'label' => $this->config->item('icon_save')."Save"
                                        ),
                'btn_delete'    => array(
                                        'show' => false
                                        )
            );
        
        if (isset($json->carats)) {
            $data['carats'] = $carats;
        }
           
        $this->load->module('templates')->admin_tpl($data);
        
    }
    
    public function delete($table, $id) {
        
        //Remove orphans.
        $product = db_get_record($table, array('uid' => $id));        
        if($table == "product") {
            $this->db->delete("po2_size", array('id' => $product->id)); 
            $this->db->delete("product_carat", array('id' => $product->id)); 
            $this->db->delete("product_category", array('id' => $product->id)); 
        }
        
        //Remove product.
        $this->db->delete($table, array('uid' => $id));
        
        redirect("admin/open_table/".$table);
    }
    
    public function kill() {
        session_destroy();
        echo "killed";
        
        echo "<a class=\"btn btn-primary\" href=\"".base_url('admin')."\">Login</a>";
    }
    
    //WTF
    public function getJSONSession($json) {
        
        //Check if we need to set a session.
        if(isset($json->session)) {
            foreach($json->session as $s) {
                switch ($s) {
                    case "diamond_carat":
                        //unset($_SESSION["diamond_carat"]);
                        $this->nativesession->delete("diamond_carat");
                        //$_SESSION["diamond_carat"] = array("a", "b", "c");
                        $this->nativesession->set("diamond_carat", array("a", "b", "c"));
                        
                        break;
                }
            }
        }
        
    }
    
    public function speedy_prices() {
        $products = $this->load->model('product/product_model')->get();
        
        //Get just the data we want to show.
        $arr = array();
        $ids = array();
        foreach($products as $product) {
            $ids[] = $product->id;
            $o = new stdClass();
            $o->uid = $product->uid;
            $o->id = $product->id;
            $o->title = $product->title;
            $o->family = $product->family;
            $o->brand = $product->brand;
            $o->type = $product->type;
            $o->speed_price = $product->speed_price;
            $arr[] = $o;
        }
        $products = $arr;
        $product_ids = array_chunk($ids, 20); //50
        
        $data = array(
                "menu"          => $this->load->model("menu/menu_model")->admin(),
                'page_title'    => "Speedy Prices",
                'view'          => 'admin/speedy_prices',
                'products'      => $products,
                'ids'           => $product_ids
            );

        $this->load->module('templates')->admin_tpl($data);
    }

    public function update_speedy_prices() {

        $products = db_get_records("product", array());

        //We don't need $min_max, but now we have some updated prices.
        $min_max = $this->load->model('product/product_model')->set_price_min_max($products);
        
        $arr = array();
        foreach($products as $product) {
            //$arr[] = array("id"=>$product->id, "speed_price"=>$product->price2, "speed_date"=>$post->dt);
            $arr[] = array("id"=>$product->id, "speed_price"=>$product->price2);
        }
        $this->db->update_batch("product", $arr, "id");
        
        $dt = date('Y-m-d H:i:s');
        db_update_record("pages", array("id"=>"Speedy Price"), array("url"=>$dt));

        redirect(base_url('admin/speedy_prices'));
        
    }
    
}

/* End of file */