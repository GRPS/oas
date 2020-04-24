<?php



class Cron_Model extends CI_Model {    

    

    public function __construct() {

        parent::__construct();

    }

    //Get breadcrumb picker data for pickers.
    public function breadcrumb_pickers($family = "", $brand = "", $type = "", $returnObject = false) {
              
        $arrFamily = array();
        $arrBrand = array();
        $arrType = array();
        
        $family = (isset($_GET['family'])?$_GET['family']:$family);
        $brand = (isset($_GET['brand'])?$_GET['brand']:$brand);
        $type = (isset($_GET['type'])?$_GET['type']:$type);
        
        //Get family.
        $query  = "SELECT SQL_CALC_FOUND_ROWS distinct family FROM product INNER JOIN product_category ON product_category.id = product.id";
        $query .= " WHERE product.display='Yes'";
        $query .= " ORDER BY family";
        $families = $this->db->query($query)->result_array();
        foreach($families as $k => $v) {
            foreach($v as $k2 => $v2) {
                if($v2 != "") {array_push($arrFamily, $v2);}
            }
        }
        
        //Get family brands.
        if($brand != "") {
            $query  = "SELECT SQL_CALC_FOUND_ROWS distinct brand FROM product INNER JOIN product_category ON product_category.id = product.id";
            $query .= " WHERE product.display='Yes'";
            $query .= ($family=="")?"":" AND (product_category.family='".$family."' OR product_category.family='".str_replace("-", " ", $family)."')";
            $query .= " ORDER BY brand";
            $brands = $this->db->query($query)->result_array();
            array_push($arrBrand, "All");
            foreach($brands as $k => $v) {
                foreach($v as $k2 => $v2) {
                    if($v2 != "") {array_push($arrBrand, $v2);}
                }
            }
        }
        
        //Get family types.
        if($type != "") {
            $query  = "SELECT SQL_CALC_FOUND_ROWS distinct type FROM product INNER JOIN product_category ON product_category.id = product.id";
            $query .= " WHERE product.display='Yes'";
            $query .= ($family=="")?"":" AND (product_category.family='".$family."' OR product_category.family='".str_replace("-", " ", $family)."')";
            $query .= ($brand=="")?"":" AND (product_category.brand='".$brand."' OR product_category.brand='".str_replace("-", " ", $brand)."')"; 
            $query .= " ORDER BY type";
            $types = $this->db->query($query)->result_array();
            array_push($arrType, "All");
            foreach($types as $k => $v) {
                foreach($v as $k2 => $v2) {
                    if($v2 != "") {array_push($arrType, $v2);}
                }
            }
        }

        $o = new stdClass();
        $o->family = $arrFamily;
        $o->brand = $arrBrand;
        $o->type = $arrType;
        $o->play = $this->play(true);
        
        if($returnObject) {
            return $o;
        } else {
            return json_encode($o);
        }
        
    }
    
    public function play($returnObject = false) {
        $arr = $this->db->query("SELECT family, brand, type FROM product_category JOIN product on product.id=product_category.id WHERE product.display='Yes' GROUP BY family, brand, type ORDER BY family, brand, type")->result();
        
        $o = new stdClass();
        $o->family = array();
        $o->brand = array();
        $o->type = array();
        
        foreach($arr as $a) {
            if($a->type != "") {
                array_push($o->family, $a->family);
                array_push($o->brand, $a->family."@".$a->brand);
                array_push($o->type, $a->family."@".$a->brand."@".$a->type);
                
            } else if($a->brand != "") {
                array_push($o->brand, $a->family."@".$a->brand);
                
            } else {
                array_push($o->family, $a->family);
            }
        }        
        
        $o->family = array_unique($o->family);
        $o->brand = array_unique($o->brand);
        $o->type = array_unique($o->type);
        
        if($returnObject) {
            return $o;
        } else {
            return json_encode($new);
        }
        
    }
    
}