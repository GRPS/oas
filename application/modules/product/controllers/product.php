<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends Public_Controller {

    public function __construct() {    
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('cart/cart_model', 'cart_model');
    }

    //Show a product.
    public function index($family = "", $brand = "", $type = "", $search = "") {

        $family = str_replace("%20", " ", $family);
        $brand = str_replace("%20", " ", $brand);
        $type = str_replace("%20", " ", $type);
                
        $passedFamily = $family;
        $passedBrand = $brand;
        $passedType = $type;
        
        comments_delete();
        
        $radio_selector = base64_encode($family . "#" . str_replace("%20", " ", $brand) . "#" . str_replace("%20", " ", $type));
        
        //Show a specific product information page.
        if (isset($_GET['id'])) {        
            $this->info($_GET['id']);
        } else {

            $feature_products = array();
            
            //Have we been passed a query string with search in.
            if(isset($_GET['search'])) {
                $family = "";
                $brand = "";
                $type = "";
                $search = $_GET['search'];                
            }

            //Get products.
            if($search == "") {
                $interest = array();
                
                //Get feature products anyway as we need the coun for the left menu.
                $feature_products = $this->product_model->feature($family); 
 
                if($brand == "") {
                    //Get featured products or limit to 8.
                    $products = $feature_products;
                } else {
                    $brand = ($brand == "all"?"":$brand);
                    $type = ($type == "all"?"":$type);
                    $products = $this->product_model->get($family, $brand, $type); 
                }
                
                $p = $products[0];
                $family = ($family == "" ? "" : $p->family);
                $brand = ($brand == "" ? "" : $p->brand);
                $type = ($type == "" ? "" : $p->type);
                
           } else {
                $interest = $this->product_model->get_interest($search);
                $products = $this->product_model->search($search);              
//                PrintExt($products);
//                exit();
            }

            //Get min/max price and set price within the $products->price and $products->pricetxt.
            $min_max = $this->product_model->price_min_max($products);

            //Sort products based on price.
            usort( $products, 'sortProducts' );

            $cart_badge = $this->cart_model->badge();

            //Get arrays on codes to add.
            //Check $fanily and/or $brand and/or $type or $search and if it matches our campaign
            //then add campaign code to array so public_tpl can loop and add all required codes.            
            $google_conversions = array();
            if ($family == "Ornaments" && $brand == "Saturno") {array_push($google_conversions, "ornaments_saturno");}
            
            $data = array(
                            "cart_badge"        => $cart_badge,
                            "view"              => "product/show",            
                            "title"             => ($search==""?"Products":"Search"),
                            "meta"              => $this->product_model->get_meta($family, $brand, $type, $search),
                            "sel"               => array("family"=>$family,"brand"=>$brand,"type"=>$type),
                            "family"            => $family,
                            "brand"             => $brand,
                            "type"              => $type,
                            "radio_selector"    => $radio_selector,
                            "feature_count"     => count($feature_products),
                            "LeftMenu"          => $this->product_model->getLeftMenuData($family, $brand, $type),
                            "breadcrumb"        => $this->product_model->breadcrumb($passedFamily, $passedBrand, $passedType, $search),
//                            "breadcrumb_pickers"=> $this->load->model('cron/cron_model')->breadcrumb_pickers($family, $brand, $type, true),
                            "description"       => $this->product_model->description($family, $brand, $type, $search),
                            "banner"            => $this->product_model->banner($family, $brand, $type, $search),
                            "interest"          => $interest,
                            "product_msg"       => array("num" => $min_max, "msg" => $this->product_model->get_found_price_range_message($products, $min_max)),
                            "thumb"             => $this->config->item('domainPICTURES'),
                            "products"          => $products,
                            "comments"          => db_get_records("comments", array()),
                            "google_conversions"=> $google_conversions
                            );

            if(empty($products)) {
                $data['meta']['image'] = $this->config->item("domainIMG")."4a.jpg";
            } else {
                $data['meta']['image'] = $this->config->item("domainPICTURES").str_replace("t.", ".", $products[0]->thumbnail);
            }
            
//            PrintExt($data);
            $this->load->module('templates')->product_tpl($data);           

        }

    }

    public function search($item) {               
        $this->index("", "", "", $item);
    }

    public function info($id) {

        //Get product.        
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where("product.id", $id);
        $this->db->join('product_category', 'product_category.id = product.id');        

        $products = $this->db->get();

        //If a product doesn't have a family defined then we need to ge the product without category information.
        if($products->num_rows() > 0) {
            $products = $products->result();
        } else {
            $products = db_get_records('product', array("id" => $id));
        }

        //Calculate min/max price and the products proper price.
        //$min_max = $this->product_model->price_min_max($products);

        //Get the only product from the array of products!
        $product = null;

        foreach($products as $p) {

            //Check product has atleast 1 category else we'll get errors.
            if(!isset($p->family)) {
                
                $p->family = "";
                $p->brand = "";
                $p->type = "";
                $p->error = "No categories defined."; //Set error message, so client can see their data error.
            }

            $product = $p;

        }

        //Remove un-wanted slashes in the description.
        $product->description = stripslashes(trim(implode("",explode("\\",$product->description))));

        $cart_badge = $this->cart_model->badge();

        //Get arrays on codes to add.
        //Check $id and if it matches our campaign
        //then add campaign code to array so public_tpl can loop and add all required codes.            
        $google_conversions = array();

        $data = array(
                        "cart_badge"        => $cart_badge,
                        "view"              => "product/info",            
                        "title"             => "Product",
                        "meta"              => $this->product_model->get_meta($product->family, $product->brand, $product->type, ""),
                        "thumb"             => $this->config->item('domainPICTURES'),
                        "carat"             => db_get_records("product_carat", array("id" => $id)),
                        "product"           => $product,
                        "images"            => explode(",", $product->images),
                        "buying"            => "po".$product->priceoption,
                        //"menu"              => $this->load->model("menu/menu_model")->main(),
                        "settings"          => $this->product_model->LoadSettings($product->priceoption),
                        "comments"          => db_get_records("comments", array()),
                        "google_conversions"=> $google_conversions
                    );

        //Get additional product information
        if ($product->priceoption == 2) {              
            $data["prodsizes"] = $this->db->from("po2_size")->where("id", $product->id)->order_by("price", "asc")->get()->result();
        }
      
        //Get specific po4 metals as only a few metals are used with diamonds set in it.
        if ($product->priceoption == 4) {   
            $data["po4metals"] = $this->db->query("SELECT metal FROM po4_metal ORDER BY sortorder LIMIT 1,50")->result();
//            $m = $this->db->from("po4_metal")->order_by("sortorder", "asc")->get()->result();
//            foreach($m as $i -> $metal) {
//                if ($i>0) {
//                    array_push($data["po4metals"], $metal->metal);
//                }
//            }
        }
        
        $data['meta']['image'] = $this->config->item("domainPICTURES").str_replace("t.", ".", $products[0]->thumbnail);
        
//            PrintExt($data); exit();            
        $this->load->module('templates')->info_tpl($data);

    }

    /*
    *  Functions designed to find bad products and act on them.
    */

    public function get_no_family() {

        $data = $this->db->query("SELECT * FROM product")->result();

        $arr = array();

        foreach($data as $p) {

            $pc = db_get_record("product_category", array("id" => $p->id));

            if(!isset($pc->family)) {
                $arr[] = array("id" => $p->id, "display" => $p->display);
                db_update_record("product", array("id" => $p->id), array("display" => "No"));
            }

        }

        array_unshift($arr, "No category products = ".count($arr));
        array_unshift($arr, "Total products = ".count($data));

        PrintExt($arr);

        exit();

    }

    public function kill_prodcalc() {
        $this->nativesession->delete('prodcalc');
        echo "done";
    }

}

/* End of file */