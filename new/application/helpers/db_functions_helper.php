<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function db_get_records_by_field($tbl, $where, $fld) {
    $CI =& get_instance();
    $result = $CI->db->get_where($tbl, $where)->result();
    $new = array();
    
    foreach($result as $res) {
        //$new[$fld] = $res;
        $a = $res->$fld;
        $new[$a] = $res;
        
    }
    return $new;
}

function db_get_records_only_fields($tbl, $flds, $where = array()) {
    $CI =& get_instance();
    
    $CI->db->select($flds);
    $CI->db->from($tbl);
    $CI->db->where($where);

    return $CI->db->get()->result_array();

}

function db_get_record($tbl, $where) {
    $CI =& get_instance();
    return $CI->db->get_where($tbl, $where)->row();
}

function db_get_records($tbl, $where) {
    $CI =& get_instance();
    return $CI->db->get_where($tbl, $where)->result();
}

function db_update_record($tbl, $where, $data) {
    $CI =& get_instance();
    $CI->db->update($tbl, $data, $where);
}

function db_insert($tbl, $data) {
    $CI =& get_instance();
    $CI->db->insert($tbl, $data); 
    return $CI->db->insert_id();
}