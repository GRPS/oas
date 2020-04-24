<?php

class Product_Model extends CI_Model
{
    
    public function __construct() {
        parent::__construct();
    }

    private function clean(&$family = "", &$brand = "", &$type = "", &$search, $propercase = false)
    {
    
        $family = urldecode($family);
        $brand = urldecode($brand);
        $type = urldecode($type);
        $search = urldecode($search);
        
        if($propercase) {
            $family = ucwords($family);
            $brand = ucwords($brand);
            $type = ucwords($type);
            $search = ucwords($search);
        }
        
    }
    
    //Get all products.
    public function get($family = "", $brand = "", $type = "", $search = "")
    {
           
        $this->clean($family, $brand, $type, $search);
        
        $query  = "SELECT SQL_CALC_FOUND_ROWS * FROM product INNER JOIN product_category ON product_category.id = product.id";
        $query .= " WHERE product.display='Yes'";
        $query .= ($family=="")?"":" AND (product_category.family='".$family."' OR product_category.family='".str_replace("-", " ", $family)."')";
        $query .= ($brand=="")?"":" AND (product_category.brand='".$brand."' OR product_category.brand='".str_replace("-", " ", $brand)."')"; 
        $query .= ($type=="")?"":" AND (product_category.type='".$type."' OR product_category.type='".str_replace("-", " ", $type)."')"; 
        $query .= " GROUP BY product.id ORDER BY product.price ASC ";
        
        $a = $this->db->last_query();
        
        $data = $this->db->query($query)->result();
        
        return  $data;
            
    }
    
    public function search($search = "") {
        
        $family = "";
        $brand = "";
        $type = "";
        
        $this->clean($family, $brand, $type, $search);
                
        $query = "SELECT SQL_CALC_FOUND_ROWS p.id AS id, pc.family AS family, pc.brand AS brand, pc.type AS type, p.priceoption AS priceoption, p.price AS price, p.pricetxt AS pricetxt, p.pricediamond AS pricediamond, p.diamondmin AS diamondmin, p.diamondmax AS diamondmax, p.diamonddefault AS diamonddefault, p.diamondcut AS diamondcut, p.diamondcolour AS diamondcolour, p.diamondclarity AS diamondclarity, p.diamondprice AS diamondprice, p.pricemetal AS pricemetal, p.metal AS metal, p.profile AS profile, p.defaultweight AS defaultweight, p.title AS title, p.description AS description, p.thumbnail AS thumbnail, p.images AS images, p.imgalt AS imgalt, p.speed_price as speed_price FROM product AS p LEFT JOIN product_category AS pc ON p.id = pc.id LEFT JOIN product_popular AS pp ON p.id = pp.id WHERE p.display='Yes' AND (p.description LIKE '%".$search."%' OR p.title LIKE '%".$search."%' OR p.id LIKE '%".$search."%' OR pc.family LIKE '%".$search."%' OR pc.brand LIKE '%".$search."%' OR pc.type LIKE '%".$search."%' OR pp.term LIKE '%".$search."%') GROUP By id";

        $data = $this->db->query($query)->result();
        
        foreach($data as $p) {
            //Check product has atleast 1 category else we'll get errors.
            if(!isset($p->family)) {
                $p->family = "";
                $p->brand = "";
                $p->type = "";
                $p->error = "No categories defined."; //Set error message, so client can see their data error.
            }
        }
        
        return  $data;
        
    }
    
    public function price_min_max(&$products = array())
    {
        
        $max = 0;
        $min = 1000000;
        foreach( $products as $row ) {
            $max = max(array($max, $row->speed_price));
            $min = min(array($min, $row->speed_price));
            
            $row->pricetxt = ($row->priceoption == 2?"From":"");
                        
        }
        return array("min" => $min, "max" => $max);

    }
    
    public function set_price_min_max(&$products = array())
    {
        
        //All data required for po2 is loaded into this variable on the first call for a po2 item
        $multiple_size_for_po2 = null;
        
        //Set default min and max price for the $products passed.
        $pricemin = 100000;
        $pricemax = 0.1;
        
        foreach($products as &$row) {
                                 
            $po = $row->priceoption;

            //We may need to load additional information based off the po.
            switch ($po) {
                case 1 : //single item fixed price (eg watch).

                    $price = $row->price;
                    $row->price2 = $price;
                    break;

                case 2 : //Multiple prices (eg saturno).

                    //First call to get po2 we load multiple sizes for subcequent calls.
                    if($multiple_size_for_po2 == null) {
                        $multiple_size_for_po2 = $this->LoadMultipleSizes();
                    }

                    $o = array();
                    
                    //Get multiple sizes for current id.
                    if(isset($multiple_size_for_po2[$row->id])) {
                        $res = $multiple_size_for_po2[$row->id];
                        $o = $res;
                    } else {
                        $res = null;
                    }
                    
                    if ($res == null) {
                        $price = 0;
                        $row->price2 = 0;
                    } else if (count($o) == 1) {
                        $price = $o[0];
                        $row->price2 = $price;
                    } else {
                        $price = $o[0];
                        $row->price2 = $price;
                        if($row->pricetxt == "") {$row->pricetxt = "From ";}
                    }

                    break;

                case 3 : //Ring metal calculation.

                    $lowest_finger_size = $this->GetLowestFingerSize($row);

                    $o = new stdClass();
                    $o->id = base64_encode($row->id);
                    $o->family = (isset($row->family)?$row->family:"");
                    $o->brand = (isset($row->brand)?$row->brand:"");
                    $o->type = (isset($row->type)?$row->type:"");
                    $o->metal = $row->metal;
                    $o->weight = $row->defaultweight;
                    $o->width = 3;
                    $o->size = $lowest_finger_size;
                    $o->diamond = $row->diamonddefault;

                    $price = $this->PO3Price($o, $row);
                    $row->price2 = rfp($price->price);
                    
                    break;

                case 4 : //ring metal and diaond calculation.

                    $res = $this->db->query("SELECT * FROM product_carat WHERE id='".$row->id."' AND defaultcarat='Yes'");
                    if ($res->num_rows() > 0) {
                        $row2 = $res->row();
                        //$o = '{"id":"'.base64_encode($row->id).'", "metal":"'.$row->metal.'", "carat":"'.$row2->carat.'", "colour":"'.$row->diamondcolour.'", "clarity":"'.$row->diamondclarity.'", "gramweight":"'.$row2->gramweight.'"}';
                        
                        $o = new stdClass();
                        $o->id = base64_encode($row->id);
                        $o->metal = $row->metal;
                        $o->carat = $row2->carat;
                        $o->colour = $row->diamondcolour;
                        $o->clarity = $row->diamondclarity;
                        $o->gramweight = $row2->gramweight;
                        
                        
                        $a = $row->id;
                        $j = $this->PO4Price($o, $row);     
                    }

                    if (isset($j->price)) {
                        $row->price2 = rfp($j->price);
                    } else {
                        $row->price2 = 0;
                    }

                    break;               

            }

            //Save in memory the new product details, so we can quickly grab it next time.
            $o = new stdClass();
            $o->price2      = $row->price2;
            $o->pricetxt    = ($row->pricetxt==""?"":$row->pricetxt);                

            //Process min/max price.
            if ($row->price2 > 0) {
                $a = $row->price2;
                if ($pricemin > $row->price2) {
                    $pricemin = $row->price2;                    
                }
                if ($pricemax < $row->price2) {
                    $pricemax = $row->price2;                    
                }
            }
                        
            comments_add("ID = ".$row->id." = ".$row->price2);
            
        }
        
        if ($pricemin == 100000) {$pricemin = 0;}
        if ($pricemax == 0.1) {$pricemax = 0;}
        
        return array("min" => $pricemin, "max" => $pricemax);
        
    }
    
    public function PO3Price($o, $row = null) {
 
        //Get diamond price
        if($row != null) {
            $settings = $this->LoadSettings($row->priceoption);
            $o->price = $row->price;
            $o->profile = $row->profile;
            $o->pricediamond = $row->pricediamond;
            $o->diamondprice = $row->diamondprice;
        } else {
            $settings = $this->LoadSettings($o->priceoption);
        }
        
        //We have changed Z+1 and Z+2 to be Z1 and Z2 as couldn't submit form as it had disallowed characters.
        $o->size = str_replace("+", "", $o->size); 
        
        $dprice = ($o->pricediamond == "Yes"?$o->diamond * $o->diamondprice:0);
        
        //Get metal weight for passed configuration.
        $key = "Platinum~".$o->profile."~".$o->weight."~".$o->width."~".$o->size;
        comments_add("Key = ".$key);
        
        if (isset($settings['Weights'][$key])) {    
            
            //return 0; //Ring doesn't come in the selected config, so call for details.
            $o = new stdClass();
            $o->price = 0;
            return $o;
            
        } else {
            
            $ps = db_get_records("po3_weight_ratio", array("metal"=>"Platinum","profile"=>$o->profile,"weight"=>$o->weight,"width"=>$o->width));           
            if(empty($ps)){
                $o = new stdClass();
                $o->price = 0;
                return $o;
            }            
            $ps = (array) $ps[0];
            $res = $ps[$o->size];            
            
            $metalweight = $res;  
            $metalratio = $settings['Metal ratio'][$o->metal];
            comments_add("Metal Weight ".$metalweight." * Metal Ratio ".$metalratio." = ". $metalweight * $metalratio);
            $metalweight = $metalweight * $metalratio;
                        
            $a1 = $settings['Metal prices'][$o->metal];
            $a2 = $metalweight;
            $a3 = $settings['Markup'];
            $price = ($settings['Metal prices'][$o->metal] * $metalweight * $settings['Markup']) + $o->price + $dprice;            
            comments_add("(Metal price ".$settings['Metal prices'][$o->metal]." * metal weight ".$metalweight." * markup ".$settings['Markup'].") + initial price ".$o->price." + diamond price ".$dprice." = ".$price);
            
            $o = new stdClass();
            $o->price = ($price==0?0:rfp($price));
            return $o;
        
        }
        
    }
    
    public function PO4Price($o, $row = null) {

        //Gets set if the metal or diamind price cannot be set.
        $poerror = 0;
        
        //Get diamond price
        if($row != null) {
            $settings = $this->LoadSettings($row->priceoption);
            $o->diamonddefault = $row->diamonddefault;
            $o->diamondcut = $row->diamondcut;
            $o->colour = $row->diamondcolour;
            $o->clarity = $row->diamondclarity;
            $o->initialprice = $row->price;
        } else {
            $settings = $this->LoadSettings($o->priceoption);
        }
        
        //Get initial price
        $iprice = $o->initialprice;
        comments_add("Initial price = ".$o->initialprice);
        //Get metal price.   
        if ($o->metal != "na") {
            $w = $settings['Metal ratio'][$o->metal] * $o->gramweight;
            $mprice = $settings['Diamond Metal Prices'][$o->metal] * $w * $settings['MarkupSS'];
            comments_add("Metal ratio ".$settings['Metal ratio'][$o->metal]." * gram weight ".$o->gramweight." = ".$w);
            comments_add("Metal price ".$settings['Diamond Metal Prices'][$o->metal]." * metal ratio ".$w." * markup ".$settings['MarkupSS']." = ".$mprice);
        } else {
            $mprice = 0;
            $poerror = 1;
        }
        comments_add("Carat = ".$o->carat);
        //Get diamond price.
        if ($o->carat != "") {
            $v = explode("ct", $o->carat);
            $carat_caret = $v[0];
            if (strpos($o->carat, ":") == false) {
                //We only have a parent diamond
                $v = explode(" ", $o->carat);    
                $carat_parent =  str_replace("ct", "", str_replace("(", "", $v[1]));
                $carat_parent_count = str_replace(")", "", $v[3]);
                $carat_child = "";
                $carat_child_count = 0;
            } else {
                //We have a parent and a child diamond
                $v = explode(" ", $o->carat);    
                $carat_parent =  str_replace("ct", "", str_replace("(", "", $v[1]));
                $carat_parent_count = $v[3];
                $carat_child =  str_replace("ct", "", $v[5]);
                $carat_child_count = str_replace(")", "", $v[7]);
            }
            
            //Get diamonds that amount to the carat
            $query2 = "SELECT * FROM po4_carat WHERE num=".$o->diamonddefault." AND carat=".$carat_caret." AND parent=".$carat_parent;
            if ($carat_child_count == 0) {
                $query2 .= " AND child=0";  
            } else {
                $query2 .= " AND child=".$carat_child;
            }
            $q = $this->db->query($query2);
            
            if ($q->num_rows() > 0) {
                $row2 = $q->row();
            } else {                
                $row2 = new stdClass();
                $row2->parent = 0;
                $row2->parentnum = 0;
                $row2->childnum = 0;
            }
            
            //Get parent diamond price
            $q = $this->db->query("SELECT * FROM po4_price WHERE cut='".$o->diamondcut."' AND ".$row2->parent." BETWEEN caratfrom AND caratto AND colour='".$o->colour."' AND clarity='".$o->clarity."' LIMIT 1");
            if ($q->num_rows() > 0) {
                $row3 = $q->row();
            } else {
                $row3 = new stdClass();
                $row3->price = 0;
            }
            $dpprice = $row2->parentnum * ($row3->price * $row2->parent);
            comments_add("parent diamond price is ".$row2->parentnum." diamonds * (diamond price ".$row3->price." * carat ".$row2->parent.") = ".$dpprice);
            
            //Get child diamond price
            if ($carat_child_count > 0) {
                $q = $this->db->query("SELECT * FROM po4_price WHERE cut='".$o->diamondcut."' AND ".$row2->child." BETWEEN caratfrom AND caratto AND colour='".$o->colour."' AND clarity='".$o->clarity."'");
                $a = $this->db->last_query();
                if ($q->num_rows() > 0) {
                    $row4 = $q->row();
                    $dcprice = $row2->childnum * ($row4->price * $row2->child);
                    comments_add("child diamond price is ".$row2->childnum." diamonds * (diamond price ".$row4->price." * carat ".$row2->child.") = ".$dcprice);
                } else {
                    $row4 = new stdClass();
                    $row4->price = 0;
                    $dcprice = 0;
                }
            } else {
                $dcprice = 0;
            }
                
            $fitprice = ($row2->parentnum + $row2->childnum) * 9;
            comments_add("Fit price = parent ".$row2->parentnum." + child ".$row2->childnum." * 9 = ".$fitprice);
            
        } else {
            
            $poerror = 2;
            $dpprice = 0;
            $dcprice = 0;
            $fitprice = 0;
            
        }
        
        //Calculate final price.        
        $mmprice = $iprice + $mprice + $dpprice + $dcprice + $fitprice;
        comments_add("Total = inital price ".$iprice." + metal price ".$mprice." + diamond parent ".$dpprice." + diamond child ".$dcprice." + fit price ".$fitprice." = ".$mmprice);

        $o = new stdClass();
        $o->price = ($mmprice==0?0:rfp($mmprice));
        return $o;
        
    }
    
    public function LoadMultipleSizes() {

        $arr = array();

        $res = $this->db->query("SELECT * FROM po2_size ORDER BY price")->result();

        foreach($res as $row) {
           $arr[$row->id][] = $row->price;
        }
        
        return $arr;
        
    }
            
    public function GetLowestFingerSize($row) {
        
        $settings = $this->LoadSettings($row->priceoption);
        
        $f1 = array("L");
        $f = array_merge($f1, $settings["Finger Sizes"]);
        $i = 0;
        while ($i <= count($f)) {
            $mprice = $settings['Weigths']["Platinum~".$row->profile."~".$row->defaultweight."~3~".$f[$i]];            
            if ($mprice != null) {
                return $f[$i];
            } else {
                $i++;
            }
        }
        return "L"; //Either profile or defaultweight not defined .
        
    }
    
    //Get breadcrumbs.
    public function breadcrumb($family = "", $brand = "", $type = "", $search = "")
    {
        
        $this->clean($family, $brand, $type, $search, true);
        return array_filter(array($family, $brand, $type, $search));
        
    }
    
    //Get product description.
    //Process FBT then FB then F to see when a description arises ... if any!
    public function description($family = "", $brand = "", $type = "", $search = "") {
    
        $tbl = "productdesc";
        
        if($search == "") {
            $res = db_get_record($tbl, array("family" => $family, "brand" => $brand, "type" => $type));        
            if (empty($res)) {$res = db_get_record($tbl, array("family" => $family, "brand" => $brand));}        
            if (empty($res)) {$res = db_get_record($tbl, array("family" => $family));}        
            if (empty($res)) {
                $res = new stdClass();
                $res->description = "";            
            }
        } else {
            $res = db_get_record($tbl, array("family" => $search));
            if (empty($res)) {
                $res = new stdClass();
                $res->description = "";            
            }
        }
        
        return $res->description;
        
    }
    
    public function get_found_price_range_message($products, $price_range) {
        
        $num = COUNT($products);
        $msg = "";
        
        if($num == 1) {
            $msg = "<span class=\"price\">1</span> product has been found.";
        } else {
            $msg = "<span class=\"price\">".$num."</span> products have been found";
            if($price_range['min'] == 0 || $price_range['max'] == 0) {
                $msg .= " .";
            } elseif($price_range['min'] == 0) {
                $msg .= " and all cost <span class=\"price\">".fp($price_range['max'])."</span>";
            } elseif($price_range['max'] == 0) {
                $msg .= " and all cost <span class=\"price\">".fp($price_range['min'])."</span>";
            } elseif($price_range['min'] == $price_range['max']) {
                $msg .= " and all cost <span class=\"price\">".fp($price_range['min'])."</span>";
            } else {
                $msg .= " and range from <span class=\"price\">".fp($price_range['min'])."</span> to <span class=\"price\">".fp($price_range['max'])."</span>.";
            }
        }
        
        return $msg;
        
    }
    
    public function get_meta($family = "", $brand = "", $type = "", $search = "") {
        
        //Override meta tags if we have a custom entry.
        $q = $this->db->query("SELECT metatitle, metakeywords, metadescription FROM meta WHERE family = '".$family."' AND brand = '".$brand."' AND type = '".$type."'");
        if ($q->num_rows() > 0) {
            
            $row = $q->row();
            $metaTitleExtra = $row->metatitle;
            $metaKeywordsExtra = $row->metakeywords;
            $metaDescriptionExtra = $row->metadescription;
            
        } else {
        
            //Set title and breadcrumb
            if ($search == "") {

                if ($family == "") {

                    $metaTitleExtra = "High quality jewellery and watches";
                    $metaDescriptionExtra = "High quality jewellery and watches";
                    $metaKeywordsExtra = "";

                } else {                     

                    if ($brand == "") {

                        $metaTitleExtra = $family;
                        $metaDescriptionExtra = "High quality ".$family;
                        $metaKeywordsExtra = ",".$family;

                    } else {                                                                                  
                        if ($type == "") {                                  

                            $metaTitleExtra = $family." - ".strtolower($brand);
                            $metaDescriptionExtra = "High quality ".strtolower($brand)." ".strtolower($family);
                            $metaKeywordsExtra = ", ".strtolower($family).", ".strtolower($brand);

                        } else {

                            $metaTitleExtra = $family." - ".strtolower($brand)." ".strtolower($type);
                            $metaDescriptionExtra = "High quality ".strtolower($type)." ".strtolower($brand)." ".strtolower($family); 
                            $metaKeywordsExtra = ", ".strtolower($family).", ".strtolower($brand).", ".strtolower($type); 

                        }
                    }
                }
                
            } else {

                $metaTitleExtra = $search;
                $metaDescriptionExtra = $search;
                $metaKeywordsExtra = $search;
                
            }
        
        }

        //Declare meta tag details
        $metaTitle = ucwords($metaTitleExtra)." | Romsey &amp; Winchester in Hampshire";
        $metaDescription = $metaDescriptionExtra." and based in Romsey and Winchester in Hampshire areas.";
        $metaKeywords = "offord and sons, jewellery, romsey, winchester, hampshire, wedding, eternity, engagement".$metaKeywordsExtra;

        return array("title" => rawurldecode($metaTitle), "description" => rawurldecode($metaDescription), "keywords" => rawurldecode($metaKeywords));
        
    }
    
    public function get_interest($search) {
        
        $query = "SELECT * FROM pages WHERE id LIKE '%".$search."%' OR content LIKE '%".$search."%' AND uid<42";
        $res = $this->db->query($query);

        $interest = array();
        
        if ($res->num_rows() == 0) {
            return $interest;
        } else {
            return $res->result();
//            foreach($res->result() as $row) {
//                $interest[] = $row->id;
//            }
            
        }
            
//        return $interest;
            
    }
    
    public function LoadSettings($po) {

        $rows = db_get_records("settings", array());
        foreach($rows as $row){$settings[$row->id] = $row->value;}
        
        $rows = db_get_records("help", array());
        foreach($rows as $row){$settings["Help"][$row->id] = $row->content;}
        
        $rows = db_get_records("po3_size", array());
        foreach($rows as $row){$settings["Finger Sizes"][] = $row->size;}
            
        //Metal ratio used by both po 3 and 4.
        $rows = $this->db->query("SELECT * FROM po3_metal order by metal")->result();
        foreach($rows as $row){
            if ($row->metal != "na") {
                $settings["Metals"][] = $row->metal;
                $settings["Metal prices"][$row->metal] = $row->price;
                $settings["Metal ratio"][$row->metal] = $row->ratio;                    
            }
        }

        if ($po == 3) {
            
            $rows = db_get_records("po3_profile", array());
            foreach($rows as $row){$settings["Profiles"][] = $row->profile;}

            $rows = $this->db->query("SELECT * FROM po3_width order by width")->result();
            foreach($rows as $row){$settings["Widths"][] = $row->width;}

            $rows = $this->db->query("SELECT * FROM po3_weight order by sortorder")->result();
            foreach($rows as $row){$settings["Weight"][] = $row->weight;}

            $rows = $this->db->query("SELECT * FROM po3_weight_ratio order by weight")->result();
            $sizes = $settings['Finger Sizes'];
            foreach($rows as $row){
                $key = $row->metal."~".$row->profile."~".$row->weight."~".$row->width;
                foreach ($sizes as $s) {
                    $new_s = str_replace("+", "", $s); //Z+1 and Z+2 = Z1 and Z2 now due to disallowed characters.
                    $k = $key."~".$new_s;
                    $w = $row->$new_s;
                    $settings['Weigths'][$k] = $w;
                }            
            }
            
        } elseif ($po == 4) {
            
            $rows = $this->db->query("SELECT * FROM po4_metal order by sortorder")->result();
            foreach($rows as $row){
                $settings["Diamond Metals"][] = $row->metal;
                $settings["Diamond Metal Prices"][$row->metal] = $row->price;
            }

            $rows = $this->db->query("SELECT * FROM po4_cut order by cut")->result();
            foreach($rows as $row){$settings["Diamond Cut"][] = $row->cut;}

            $rows = $this->db->query("SELECT * FROM po4_colour order by sortorder")->result();
            foreach($rows as $row){$settings["Diamond Colour"][] = $row->colour;}

            $rows = $this->db->query("SELECT * FROM po4_clarity order by sortorder")->result();
            foreach($rows as $row){$settings["Diamond Clarity"][] = $row->clarity;}

            $rows = $this->db->query("SELECT * FROM po4_carat")->result();
            foreach($rows as $row){
                $n = $row->num;
                $c = $row->carat;  
                $settings["Diamond Carat"][$n][$c] = array("carat"=>$row->carat, "parent"=>$row->parent, "parentnum"=>$row->parentnum, "child"=>$row->child, "childnum"=>$row->childnum);
            }

            $rows = $this->db->query("SELECT * FROM po4_price")->result();
            foreach($rows as $row){$settings["Diamond Price"][$row->cut."~".$row->colour."~".$row->clarity] = array("caratfrom"=>$row->caratfrom, "caratto"=>$row->caratto, "price"=>$row->price);}        

        }
        
        return $settings;
        
    }
        
    //NOT SURE THIS FUNCTION IS USED AT ALL!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    public function get_setting_po3_weight() {
	$arr = array();
	$rows = $this->db->query("SELECT * FROM po3_weight_ratio order by weight")->result();
	//$sizes = $this->get_setting_po3_size();
        $sizes = db_get_records("po3_size", array());
	foreach($rows as $row){
            $key = $row->metal."~".$row->profile."~".$row->weight."~".$row->width;
            foreach ($sizes as $s) {
                $new_s = str_replace("+", "", $s); //Z+1 and Z+2 = Z1 and Z2 now due to disallowed characters.
                $k = $key."~".$new_s;
                $w = $row->$new_s;
                $arr[$k] = $w;
            }            
	}
	return $arr;
    }

    public function getSpecialOffers() {
        return $this->db->query("SELECT * FROM specialoffers ORDER BY sortorder ASC")->result();
    }
    

}