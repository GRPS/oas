<?php

class Menu_Model extends CI_Model {    
    
    public function __construct() {
        parent::__construct();
    }
    
    public function main() {
        $menu = db_get_record("pages", array("id"=>"Menu"));
        return $menu;
    }
    
    public function set_menu() {
        $menu = $this->makeUL($this->data());
        $dt = date('Y-m-d H:i:s');
        db_update_record("pages", array("id"=>"Menu"), array("url"=>$dt, "content"=>$menu));
    }
    
    public function data()
    {
        
        $this->db->query("DELETE FROM temp");
        $this->db->query("insert into temp SELECT family, brand, type FROM product_category JOIN product on product.id=product_category.id WHERE product.display='Yes'");
        $this->db->query("insert into temp SELECT family, brand, type FROM product_category2");

        $arr = $this->db->query("SELECT family, brand, type FROM temp GROUP BY family, brand, type ORDER BY family, brand, type")->result();
        
        //$arr = $this->db->query("SELECT family, brand, type FROM product_category JOIN product on product.id=product_category.id WHERE product.display='Yes' GROUP BY family, brand, type ORDER BY family, brand, type")->result();
            
        //Add brand 'All' to all new family.
        $arrnew = array();
        $prev_family = "";
        $prev_brand = "";
        foreach($arr as $a) {            
            if ($prev_family != $a->family) {                
                if(strpos($a->family, "_no_all") === false) {
                    $o = new stdClass();
                    $o->family = $a->family;
                    $o->brand = "All";
                    $o->type = "";
                    $arrnew[] = $o;
                } else {
                    
                }
                $prev_family = $a->family;
                $prev_brand = "";
            }
            $a->family = str_replace("_no_all", "", $a->family);
            $arrnew[] = $a;
        }
        $arr = $arrnew;
        
        
        $new = array();
        $fi = -1;
        $bi = -1;
        $ti = -1;
        $f = "";
        $b = "";
        $t = "";
        foreach($arr as $a) {
            if($f <> $a->family) {
                $f = $a->family;
                $new[++$fi]['name'] = $a->family;
                if ($a->brand == "") {
                    $new[$fi]['link'] = "product/".make_safe($a->family);
                } else {
                    $new[$fi]['link'] = "";
                }
                $new[$fi]['sub'] = null;
                $b = "";
                $bi = -1;
                $t = "";
                $ti = -1;
            }
            if($b <> $a->brand) {
                $b = $a->brand;
                
                if(strpos($a->brand, "~")) {
                    
                    $v = explode("~", $a->brand);
                    $new[$fi]['sub'][++$bi]['name'] = $v[0];
                    $new[$fi]['sub'][$bi]['link'] = $v[1];
                    
                } else {
                
                    $new[$fi]['sub'][++$bi]['name'] = $a->brand;
                    if ($a->type == "") {
                        $new[$fi]['sub'][$bi]['link'] = "product/".make_safe($a->family."/".$a->brand);
                    } else {                    
                        $new[$fi]['sub'][$bi]['link'] = "";
                    }
                    $new[$fi]['sub'][$bi]['sub'] = null;
                    
                }
                
                $t = "";
                $ti = -1;
            }
            if($t <> $a->type) {
                $t = $a->type;
                $new[$fi]['sub'][$bi]['sub'][++$ti]['name'] = $a->type;
                $new[$fi]['sub'][$bi]['sub'][$ti]['link'] = "product/".make_safe($a->family."/".$a->brand."/".$a->type);
                $new[$fi]['sub'][$bi]['sub'][$ti]['sub'] = null;
            }
        }   
        
        $info[] = array('name' => 'Jewellery Insurance', 'icon' => '', 'link' => 'jewellery-insurance', 'sub' => null);
        $info[] = array('name' => 'Anniversaries', 'icon' => '', 'link' => 'anniversaries', 'sub' => null);
        $info[] = array('name' => 'Birthstones', 'icon' => '', 'link' => 'birthstones', 'sub' => null);
        $info[] = array('name' => 'Zodiac Stones', 'icon' => '', 'link' => 'zodiac-stones', 'sub' => null);
        $info[] = array('name' => 'Diamonds', 'icon' => '', 'link' => 'diamonds', 'sub' => null);
        $info[] = array('name' => 'Pearls', 'icon' => '', 'link' => 'pearls', 'sub' => null);
        
        $popular[] = array('name' => 'Bespoke jewellery', 'icon' => '', 'link' => 'bespoke-jewellery', 'sub' => null);
        $popular[] = array('name' => 'Diamond rings', 'icon' => '', 'link' => 'product/rings/diamond', 'sub' => null);
        $popular[] = array('name' => 'Engagement rings', 'icon' => '', 'link' => 'product/rings/engagement', 'sub' => null);
        $popular[] = array('name' => 'Eternity rings', 'icon' => '', 'link' => 'product/rings/eternity', 'sub' => null);
        $popular[] = array('name' => 'Wedding rings', 'icon' => '', 'link' => 'product/rings/wedding', 'sub' => null);
        $popular[] = array('name' => 'Platinum products', 'icon' => '', 'link' => 'product?search=platinum', 'sub' => null);
        $popular[] = array('name' => 'Rolex watches', 'icon' => '', 'link' => 'product/watches/rolex', 'sub' => null);
        $popular[] = array('name' => 'Saturno ornaments', 'icon' => '', 'link' => 'product/ornaments/saturno', 'sub' => null);

//        $res = $this->nativesession->get('loggedin');
//        if ($res != null) {
//            $menu[] = array('name' => 'Admin', 'icon' => 'fa-key', 'link' => 'admin', 'sub' => $this->admin());
//        }
        
        $menu[] = array('name' => 'Home', 'icon' => 'fa-home', 'link' => 'home', 'sub' => null);
        $menu[] = array('name' => 'Special Offers', 'icon' => 'fa-legal', 'link' => 'product', 'sub' => null);
        $menu[] = array('name' => 'Most Popular Requests', 'icon' => 'fa-heart-o', 'link' => '', 'sub' => $popular);
        $menu[] = array('name' => 'Products', 'icon' => 'fa-star-o', 'link' => '', 'sub' => $new);
        $menu[] = array('name' => 'About Us', 'icon' => 'fa-user', 'link' => 'about-us', 'sub' => null);
        $menu[] = array('name' => 'Bespoke &amp; Custom Jewellery', 'icon' => 'fa-edit', 'link' => 'bespoke-jewellery', 'sub' => null);
        $menu[] = array('name' => 'Old Gold', 'icon' => 'fa-tree', 'link' => 'old-gold', 'sub' => null);
        $menu[] = array('name' => 'Services', 'icon' => 'fa-wrench', 'link' => 'services', 'sub' => null);
        $menu[] = array('name' => 'Valuations', 'icon' => 'fa-money', 'link' => 'valuations', 'sub' => null); 
        $menu[] = array('name' => 'Information', 'icon' => 'fa-info', 'link' => '', 'sub' => $info);
        $menu[] = array('name' => 'Contact Us', 'icon' => 'fa-phone', 'link' => 'contact-us', 'sub' => null);
        
        return $menu;
            
    }
    
    public function kill($item) {
        
        //session_start(); //Need this as we are bypassing welcome conroller.
        //unset($_SESSION[$item]);
        $this->nativesession->delete($item);
        
    }
        
    private function makeUL($arr) {
        
        if (empty($arr)) return '';
        
        $output = '<ul>';        
        foreach ($arr as $key => $arrSub) {
            $output .= '<li>';            
            if ($arrSub['link'] == "") {
                $output .= '<span>';
            } else {
                if(strpos($arrSub['link'], "http") !== false) {
                    $output .= '<a data-id="1" href="'.$arrSub['link'].'" target="_blank">';
                } else {
                    $output .= '<a data-id="2" href="'.base_url($arrSub['link']).'">';
                }
            }
            if(isset($arrSub['icon'])) {
                if($arrSub['icon'] != "") {
                    $output .= '<i class="text-warning fa '.$arrSub['icon'].'"></i> ';
                }
            }
            $output .= $arrSub['name'];
            if ($arrSub['link'] == "") {
                $output .= '</span>';
            } else {
                $output .= '</a>';
            }       
            if(!empty($arrSub['sub'])) {
                $output .= $this->makeUL($arrSub['sub']);
            }
            $output .= '</li>';
        }        
        $output .= '</ul>';
		
	return $output;
        
    }
    
    public function admin($reset = "") {
            
        $menu[] = array('name' => 'Dashboard', 'icon' => '', 'link' => 'admin', 'sub' => null);

        $general[] = array('name' => 'Settings', 'icon' => '', 'link' => 'admin/open_table/settings', 'sub' => null);
        $general[] = array('name' => 'Home Page', 'icon' => '', 'link' => 'admin/open_table/home', 'sub' => null);
        $general[] = array('name' => 'Pages', 'icon' => '', 'link' => 'admin/open_table/pages', 'sub' => null);
        $general[] = array('name' => 'Slider', 'icon' => '', 'link' => 'admin/open_table/slider', 'sub' => null);
        $general[] = array('name' => 'Special Offers', 'icon' => '', 'link' => 'admin/open_table/specialoffers', 'sub' => null);
        $general[] = array('name' => 'Popular Products', 'icon' => '', 'link' => 'admin/open_table/product_popular', 'sub' => null);            
        $general[] = array('name' => 'Tag Cloud', 'icon' => '', 'link' => 'admin/open_table/tagcloud', 'sub' => null);            
        $general[] = array('name' => 'Finger Size', 'icon' => '', 'link' => 'admin/open_table/po3_size', 'sub' => null);
        //$general[] = array('name' => 'Help', 'icon' => '', 'link' => 'admin/open_table/help', 'sub' => null);
        $menu[] = array('name' => 'General', 'icon' => '', 'link' => '', 'sub' => $general);

        $product_configuration[] = array('name' => 'Products', 'icon' => '', 'link' => 'admin/open_table/product', 'sub' => null);
        $product_configuration[] = array('name' => 'Descriptions', 'icon' => '', 'link' => 'admin/open_table/productdesc', 'sub' => null);
        $product_configuration[] = array('name' => 'Categories', 'icon' => '', 'link' => 'admin/open_table/product_category', 'sub' => null);
        $product_configuration[] = array('name' => 'Additional Categories', 'icon' => '', 'link' => 'admin/open_table/product_category2', 'sub' => null);
        $product_configuration[] = array('name' => 'Product Carats', 'icon' => '', 'link' => 'admin/open_table/product_carat', 'sub' => null);
        $product_configuration[] = array('name' => 'Meta Tags', 'icon' => '', 'link' => 'admin/open_table/meta', 'sub' => null);
        $menu[] = array('name' => 'Product Configuration', 'icon' => '', 'link' => '', 'sub' => $product_configuration);

        $po2[] = array('name' => 'Multiple Sizes', 'icon' => '', 'link' => 'admin/open_table/po2_size', 'sub' => null);
        $menu[] = array('name' => 'Price Option 2', 'icon' => '', 'link' => '', 'sub' => $po2);

        $po3[] = array('name' => 'Metal Prices & Ratios', 'icon' => '', 'link' => 'admin/open_table/po3_metal', 'sub' => null);
        $po3[] = array('name' => 'Weight Ratios', 'icon' => '', 'link' => 'admin/open_table/po3_weight_ratio', 'sub' => null);
        $po3[] = array('name' => 'Profiles', 'icon' => '', 'link' => 'admin/open_table/po3_profile', 'sub' => null);
        $po3[] = array('name' => 'Weights', 'icon' => '', 'link' => 'admin/open_table/po3_weight', 'sub' => null);
        $po3[] = array('name' => 'Widths', 'icon' => '', 'link' => 'admin/open_table/po3_width', 'sub' => null);
        $menu[] = array('name' => 'Price Option 3', 'icon' => '', 'link' => '', 'sub' => $po3);

        $po4[] = array('name' => 'Metal Prices', 'icon' => '', 'link' => 'admin/open_table/po4_metal', 'sub' => null);
        $po4[] = array('name' => 'Diamond Prices', 'icon' => '', 'link' => 'admin/open_table/po4_price', 'sub' => null);
        $po4[] = array('name' => 'Cut', 'icon' => '', 'link' => 'admin/open_table/po4_cut', 'sub' => null);
        $po4[] = array('name' => 'Clarity', 'icon' => '', 'link' => 'admin/open_table/po4_clarity', 'sub' => null);
        $po4[] = array('name' => 'Colour', 'icon' => '', 'link' => 'admin/open_table/po4_colour', 'sub' => null);
        $po4[] = array('name' => 'Carat Weight', 'icon' => '', 'link' => 'admin/open_table/po4_carat', 'sub' => null);
        $menu[] = array('name' => 'Price Option 4', 'icon' => '', 'link' => '', 'sub' => $po4);
          
        return $this->makeUL($menu);
        
    }

}