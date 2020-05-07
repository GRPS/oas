<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    $config['show_footer_storage']  = false;
    $config['use_debug_comments']   = true; //If true then comments are written to a comments database and can be shown in the storage footer.
    $config['company_title']        = 'Offord &amp; Sons DEV';
    $config['company_footer_year']  = '2020';
    $config['copyright']            = 'Copyright &copy; 2020 Offord & Sons All rights reserved.';
    $config['designed']             = 'Designed and created by Graham Simmons 2020.';
    
    //NOT USED
//    $config['domainLIVE'] = "http://www.offordandsons.co.uk";
//    $config['domainLOCAL'] = "http://localhost/offordandsons";
    
    
    $config['domainIMG'] = "http://www.offordandsons.co.uk/assets/img/";
    $config['domainPICTURES'] = "http://www.offordandsons.co.uk/pictures/";
    
    //==Price details
    $config['default_finger_size']      = "L";
    $config['default_width']            = "3";
    $config['PriceOnApplicationNum']    = -1;
    $config['PriceOnApplication']       = "POA";
    $config['PriceSoldNum']             = -2;
    $config['PriceSold']                = "SOLD";
    
    //==Icons
    $config['icon_back']        = '<span class="glyphicon glyphicon-chevron-left"></span> ';
    $config['icon_edit']        = '<span class="glyphicon glyphicon-pencil"></span> ';
    $config['icon_read']        = '<span class="glyphicon glyphicon-eye-open"></span> ';
    $config['icon_save']        = '<span class="glyphicon glyphicon-ok"></span> ';
    $config['icon_add']         = '<span class="glyphicon glyphicon-plus"></span> ';
    $config['icon_delete']      = '<span class="glyphicon glyphicon-trash"></span> ';
    $config['icon_cancel']      = '<span class="glyphicon glyphicon-chevron-left"></span> ';
    $config['icon_view']        = '<span class="glyphicon glyphicon-chevron-right"></span> ';
    $config['icon_yes']         = '<span class="glyphicon glyphicon-ok"></span> ';
    $config['icon_no']          = '<span class="glyphicon glyphicon-remove"></span> ';
        
    //== Path
    $config['asset']            = 'assets/';
    
    //Image
    $config['wait']             = $config['asset'].'img/wait.gif';
    $config['wait_small']       = $config['asset'].'img/wait-small.gif';
    
    //== CSS
    $config['css_select']               = $config['asset'].'bootstrap-select/css/bootstrap-select.min.css';
    $config['css_smint']                = $config['asset'].'smint/css/demo.css';
    
    //== JS
    $config['js_page']                  = $config['asset'].'js/page/';
    $config['js_select']                = $config['asset'].'bootstrap-select/js/bootstrap-select.min.js';
    $config['js_smint']                 = $config['asset'].'smint/js/jquery.smint.js';
    

/* End of file */
