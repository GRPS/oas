<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Storage extends Public_Controller{

	public function __construct() {
            parent::__construct();
	}

	public function index() {

            $get = (object) $this->input->get();

            $data['show_data']      = true;
            $res 					= $this->nativesession->get('data');
            $data['view_data']      = ($this->config->item('show_footer_storage')&&$res != null ? $res : "");
            $data['view_session']   = $_SESSION;

            $this->load->view('storage', $data);

	}

}

/* End of file */
