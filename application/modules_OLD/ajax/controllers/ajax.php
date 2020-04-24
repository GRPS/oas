<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product/product_model', 'product_model');
        $this->load->model('cart/cart_model', 'cart_model');
        $this->load->model('admin/admin_model', 'admin_model');
    }

    public function index() {
        echo "ajax hi";
    }
    
    public function get_session() {
        //session_destroy();
        echo "All: ".mb_strlen(serialize($_SESSION))."<br>";
        PrintExt($_SESSION);
    }
    
    public function delete_session() {
        session_destroy();
        echo "Session deleted!";
    }

    public function set_qty() {

        //Get posted information.
        $post = (object) $this->input->post(); 

        $cart = $this->nativesession->get('oascart');

        $new = array();
        //Set the qty of the required product.      
        foreach($cart as $c) {
            if($c->key == $post->key) {
                if ($post->qty > 0) {
                    $c->qty = $post->qty;
                    $c->price = $c->unitprice * $c->qty;
                    array_push($new, $c);
                } 
            } else {
                array_push($new, $c);
            }
        }

        $this->nativesession->set('oascart', $new);

        //Don'th bother returning anything as the calling js code does a window redirect to the cart.

    }

    public function get_price() {

        //Get posted information.
        $post = (object) $this->input->post();            
        $config = json_decode($post->config);
        $product = json_decode(rawurldecode($post->item));

        //Create new array to store returned values.
        $new = array();
        $new['id'] = $product->id;
        $new['po'] = $product->po;
        $new['title'] = $product->title;

        //Parse config into it's own json object.
        foreach($config as $c) {
            $new[$c->name] = $c->value;
        }
        $new = (object) $new;

        //If we have been sent a carat then it's got the gram weight appended to it.
        if(isset($new->carat)) {
            $v = explode("~",$new->carat);
            $new->gramweight = $v[1];
            $new->carat = $v[0];
        }

        $o = new stdClass;
        $o->priceoption = $product->po;

        //Calculate price based off price option and it'll use the attributes we've set.
        if ($product->po == 3) {

            //Get passed configuration.

            //Initial price.
            $o->price           = $new->price;

            //Actual ring configuration.
            $o->metal           = $new->metal;
            $o->profile         = $new->profile;
            $o->weight          = $new->weight;
            $o->width           = $new->width;
            $o->size            = $new->size;

            //Used basic diamond calculation here.
            $o->pricediamond    = $new->pricediamond;
            $o->diamond         = $new->diamond;
            $o->diamondprice    = $new->diamondprice;

            $price = $this->product_model->PO3Price($o);

        } elseif ($product->po == 4) {

            //Initial price.
            $o->initialprice    = $new->initialprice;

            //Actual ring configuration.
            $o->metal           = $new->metal;
            $o->gramweight      = $new->gramweight;
            $o->size            = $new->size;

            //Used basic diamond calculation here.
            $o->carat           = $new->carat;
            $o->diamonddefault  = $new->diamonddefault;
            $o->diamondcut      = $new->diamondcut;
            $o->colour          = $new->colour;
            $o->clarity         = $new->clarity;

            $price = $this->product_model->PO4Price($o);
        }

        //Set the price.
        $new->price = $price->price;
        $new->price_txt = fp($price->price);

        //Return json for the buy button and for the new price to be shown.
        echo json_encode($new);

    }

    public function save_product_to_cart() {

        //Get posted information.
        $o = (object) $this->input->post();  

        $this->cart_model->add($o);

        $json = json_encode($this->cart_model->badge());

        echo $json;

    }
        
    public function show_table_data($table) {
        $data = $this->admin_model->get_read_data($table);
        PrintExt($data);
    }
               
}        
