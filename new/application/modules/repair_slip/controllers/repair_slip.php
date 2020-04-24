<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MYPDF extends TCPDF {
       
    public $details;
    
    public function __construct($details, $orientation='L', $unit='mm', $format='A4', $unicode=true, $encoding='UTF-8', $diskcache=false, $pdfa=false)
    {
        $this->details = $details;
        parent::__construct( $orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa );
    }

}

class Repair_Slip extends Admin_Controller {

    public function index($from = -1, $too = -1) {
        
        if($from == -1 || $too == -1) {
            echo "<h3>Missing number range!</h3>";
            echo "<h3>Example: </h3>";
            echo "<p>".site_url("/repair/10/20")."</p>";
            exit();
        }
        
    }
    
}       