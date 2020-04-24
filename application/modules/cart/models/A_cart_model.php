<?php

class Cart_Model extends CI_Model {    
    
    public function __construct() {
        parent::__construct();
    }
    
    public function delete() {
        $this->nativesession->delete('oascart');
    }
    
    public function add($o) {
        
        //Get current cart.
        $arr = $this->nativesession->get('oascart');
        
        //Build key to show in cart and to help qty incrments (duplicate product added).
        $o->key = $this->get_key($o);
        $o->unitprice = $o->price; //This unit price never changes, but price will get multiplied by the wty.
        $o->qty = 1;
        
        //Either append to existing cart or create a new cart.
        if(isset($arr)) {        
            
            //Is key match found.
            $found = false;
            
            //Incrment qty if key is a duplicate.
            foreach($arr as $a) {
                if ($a->key == $o->key) {
                    $found = true;
                    $a->qty++;
                    $a->price = $a->unitprice * $a->qty;
                    break;
                }
            }

            if(!$found) {
                array_push($arr, $o);
            }
            
        } else {
            $arr[] = $o;
        }
        
        //Save cart.
        $this->nativesession->set('oascart', $arr);
        
    }
    
    public function badge() {
        
        $o = new stdClass;
        
        //Get current cart.
        $arr = $this->nativesession->get('oascart');
        
        $cnt = 0;
        $price = 0;
        
        if(isset($arr)) {
            foreach($arr as $a) {
                $cnt += $a->qty;
                $price += $a->price;
            }
        }
        $o->cnt = $cnt;
        $o->price = fp($price);
        
        return $o;
    }
    
    //Used to build a key for the product added to the cart, so if another exact product is added we can just adjust the qty. We show this key in the cart.
    public function get_key($o) {
        
        $key = "";
        
        switch ($o->po) {
            case 1:
                $key = $o->id;
                break;
            case 2:
                $key = $o->id." : ".$o->description;
                break;
            case 3:
                $key = $o->id." : ".$o->metal." : Size ".$o->size." : ".$o->weight." weight : ".$o->width. "mm";
                break;
            case 4:
                $key = $o->id." : ".$o->metal." : Size ".$o->size." : ".$o->carat." : ".$o->clarity." : ".$o->colour." : ".$o->diamondcut;
                break;
        }
        
        return $key;
        
    }
    
}