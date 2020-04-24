<?php

class Admin_Model extends CI_Model {    
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_table($table, $orderby = "") {
        
        $headings = array();
        $items = $this->db->list_fields($table);

        $i = 0;
        foreach ($items as $item) {
            array_push($headings, array('fld' => $item, 'count' => ++$i));
        }
        
        //$rows = $this->db->get($table)->result_array();
        
        $this->db->select('*')->from($table);
        
//        if($table == "product") {
//            $this->db->join("product_category", "product.id = product_category.id");
//        }        
        
        if($orderby != ""){
            foreach($orderby as $item) {
                foreach($item as $key => $value) {
                    $this->db->order_by($key, $value);
                }
            }            
        }
        $rows = $this->db->get()->result_array();
        

                
        $data = array(
            'headings'  => $headings,
            'rows'      => $rows
        );
        
        return $data;
        
    }
    
    public function load_table_config($table) {

        $res = $this->nativesession->getget('json', $table);
        //if ($res == null) {
            $data = db_get_record("config", array("id" => $table));
            $this->nativesession->setset('json', $table, rawurlencode($data->json));
        //}
        
        return json_decode(rawurldecode($res));
        
    }
    
    public function get_read_data($table, $json = "") {
        
        //Get json configuration.
        if ($json == "") {
            $json = $this->admin_model->load_table_config($table);
        }
        
        //Get all data.
        $data_orig = $this->admin_model->get_table($table, $json->orderby);
        
        //if mode = read then only get fields we want to show.
        $arr = array();
        foreach($data_orig['rows'] as $d) {
            $obj = array();
            $obj['uid'] = $d['uid'];
            foreach($json->table_cols as $col) {
                $c = (array) $col;
                $obj[$c['col_name']] = $d[$c['col_name']];
            }
            array_push($arr, $obj);
        }
        
        return $arr;
        
    }
    
    public function get_carats($num = 0) {
        
        //Special product carat code.
        $preloads_carat = array();

        $arr = array();
        if ($num == 0) {
            $carats = db_get_records("po4_carat", array()); //Get all carats
        } else {
            $carats = db_get_records("po4_carat", array("num" => $num)); //Get all carats
        }
        
        foreach($carats as $carat) {
            $o = new stdClass();
            $key = $carat->carat."ct (".$carat->parent."ct * ".$carat->parentnum;
            if($carat->childnum ==0) {
                $key .= ")";
            } else {
                $key .= " : ".$carat->child."ct * ".$carat->childnum.")";
            }
            $o->value = $key;
            $o->text = "(".$carat->num.") ".$key;
            array_push($arr, $o);
        }   
        
        return $arr;
        
    }
    
}