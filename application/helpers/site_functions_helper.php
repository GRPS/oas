<?php

// Layout print_r nicely
function PrintExt($arr) {
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

function back_level($o) {
    $new = array();

    foreach($o as $k => $v) {
        $new[$k] = $v;
    }

    return $new;
}

function make_safe($s) {
    return strtolower(str_replace(" ", "%20", $s));
}

function kill_session_item($item) {
    $CI =& get_instance();
    if ($item == "") {
        $CI->session->unset_userdata();
    } else {
        $CI->session->unset_userdata($item);
    }
}

//Round to upper £5
function rfp($price) {

    $CI =& get_instance();
    
//    if ($price == $CI->config->item('PriceOnApplicationNum')) {return $CI->config->item('PriceOnApplication');}
//    if ($price == $CI->config->item('PriceSoldNum')) {return $CI->config->item('PriceSold');} 
//    $price = str_replace("&pound;", "", $price);
    $pricenew = round($price, 0);
    $c = substr($pricenew, -1);    
    switch ($c) {
        case "0": $n = 0; break;
        case "1": $n = 4; break;            
        case "2": $n = 3; break;            
        case "3": $n = 2; break;
        case "4": $n = 1; break;
        case "5": $n = 0; break;                        
        case "6": $n = 4; break;
        case "7": $n = 3; break;
        case "8": $n = 2; break;
        case "9": $n = 1; break;                                                      
    }
    //return number_format(($pricenew+$n), 0);
    return $pricenew+$n;
}

function sortProducts( $a, $b ) {
    $c = ($a->speed_price == 0?999999:$a->speed_price);
    $d = ($b->speed_price == 0?999999:$b->speed_price);
    return $c == $d ? 0 : ( $c > $d ) ? 1 : -1;
}

function fp($price = 0) {
    $CI =& get_instance();
    switch ($price) {
        case $CI->config->item('PriceOnApplication') :
        case $CI->config->item('PriceSold') :
            return $price;
        default:
            return "&pound;".number_format($price, 0, ".", ",");            
    }        
}

function comments_delete() {
    $CI =& get_instance();
    if($CI->config->item('use_debug_comments')) {
        $CI->db->empty_table('comments');
    }
}
function comments_add($comment) {
    $CI =& get_instance();
    if($CI->config->item('use_debug_comments')) {
        $data = array(
            "comment" => $comment,
            "dt" => date('Y-m-d h:i:s')
        );
        $CI->db->insert("comments", $data);
    }
}
function comments_get() {
    $CI =& get_instance();
    if($CI->config->item('use_debug_comments')) {
        $CI->db->get("comments")->result();
    }
}

function bytesToSize($bytes, $precision = 2) {  
    $kilobyte = 1024;
    $megabyte = $kilobyte * 1024;
    $gigabyte = $megabyte * 1024;
    $terabyte = $gigabyte * 1024;
   
    if (($bytes >= 0) && ($bytes < $kilobyte)) {
        return $bytes . ' B';
 
    } elseif (($bytes >= $kilobyte) && ($bytes < $megabyte)) {
        return round($bytes / $kilobyte, $precision) . ' KB';
 
    } elseif (($bytes >= $megabyte) && ($bytes < $gigabyte)) {
        return round($bytes / $megabyte, $precision) . ' MB';
 
    } elseif (($bytes >= $gigabyte) && ($bytes < $terabyte)) {
        return round($bytes / $gigabyte, $precision) . ' GB';
 
    } elseif ($bytes >= $terabyte) {
        return round($bytes / $terabyte, $precision) . ' TB';
    } else {
        return $bytes . ' B';
    }
}