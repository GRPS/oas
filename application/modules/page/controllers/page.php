<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends Public_Controller {

    public function __construct()
    {
        parent::__construct();
        //if(!isset($_SESSION)) {session_start();}
        $this->load->model('page/page_model', 'page_model');
        $this->load->model('cart/cart_model', 'cart_model');
    }

    public function index($id = "Home")
    {

        $cart_badge = $this->cart_model->badge();

        $page = $this->page_model->get($id);
       
        $meta = $this->page_model->get_meta($page->id);
//echo $id."<br>";
//echo $page->id."<br>";
//PrintExt($meta);
//exit();
        //Get arrays on codes to add.
        //Check $fanily and/or $brand and/or $type or $search and if it matches our campaign
        //then add campaign code to array so public_tpl can loop and add all required codes.
        $google_conversions = array();
        
        $data = array(
                        "cart_badge"            => $cart_badge,
                        "view"                  => "page/show",
                        "title"                 => str_replace("-", " ", $page->id),
                        "h1"                    => (isset($page->h1)?$page->h1:""),
                        "h2"                    => (isset($page->h2)?$page->h2:""),
                        "meta"                  => $meta,
                        "page"                  => $page,
                        "ogimage"               => $this->config->item('domainPICTURES').$page->url.".jpg",
                        "google_conversions"    => $google_conversions                        
                    );

        if (strtolower($id) == "home") {
            $data['panels'] = $this->db->query("SELECT * FROM home order by sort_order")->result(); //db_get_records("home", array());
            
            $this->load->module('templates')->home_tpl($data);
        } else {
            if($id=="contactus") {
                
                if (isset($_POST["submit"])) {                  

                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $message = $_POST['message'];
                    $human = intval($_POST['human']);
                    $from = 'Contact Form'; 
                    $to = 'enquiry@offordandsons.co.uk';
                    $subject = 'Website Enquiry';
                    $body = "From: $name<br>E-Mail: $email<br><br>$message";

                    $errName = "";
                    $errEmail = "";
                    $errMessage = "";
                    $errHuman = "";
                    $result = "";

                    // Check if name has been entered
                    if (!$name) {
                            $errName = 'Please enter your name';
                    }

                    // Check if email has been entered and is valid
                    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $errEmail = 'Please enter a valid email address';
                    }

                    //Check if message has been entered
                    if (!$message) {
                            $errMessage = 'Please enter your message';
                    }
                    //Check if simple anti-bot test is correct
                    if ($human !== $this->nativesession->get("captcha")) {
                            $errHuman = 'Your anti-spam is incorrect';
                    }
                    
                    // If there are no errors, send the email
                    if ($errName == "" && $errEmail == "" && $errMessage == "" && $errHuman == "") {

                        $this->load->library('email');

                        //configure email settings
                        $config['protocol'] = 'smtp';
                        $config['smtp_host'] = 'ssl://northampton.theukhost.net';
                        $config['smtp_port'] = '465';
                        $config['smtp_user'] = 'enquiry@offordandsons.co.uk';
                        $config['smtp_pass'] = 'Humil1ty8464'; //a490ban'; //'0ff0rd4nd50n5';
                        $config['mailtype'] = 'html';
                        $config['charset'] = 'utf-8';
                        $config['wordwrap'] = TRUE;
                        $config['newline'] = "\r\n"; //use double quotes
                        $this->load->library('email');
                        $this->email->initialize($config);       

                        $this->email->from($email, $name);
                        $this->email->to($to); 
                        $this->email->cc($email);
                        $this->email->reply_to($email, $name);

                        $this->email->subject($subject);
                        $this->email->message($body);	

                        if($this->email->send()) {
                            $result='<div class="alert alert-success">Thank You! I will be in touch</div>';
                            $data['name'] = "";
                            $data['email'] = "";
                            $data['message'] = "";
                            $data['human'] = "";
                            $data['from'] = "";
                            $data['to'] = "";
                            $data['subject'] = "";
                            $data['body'] = "";

                            $data['errName'] = "";
                            $data['errEmail'] = "";
                            $data['errMessage'] = "";
                            $data['errHuman'] = "";
                            $data['result'] = "";
                        } else {
                            $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
                            $data['name'] = $name;
                            $data['email'] = $email;
                            $data['message'] = $message;
                            $data['human'] = $human;
                            $data['from'] = $from;
                            $data['to'] = $to;
                            $data['subject'] = $subject;
                            $data['body'] = $body;

                            $data['errName'] = $errName;
                            $data['errEmail'] = $errEmail;
                            $data['errMessage'] = $errMessage;
                            $data['errHuman'] = $errHuman;
                            $data['result'] = $result;
                        }
                    } else {
                        $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later</div>';
                            $data['name'] = $name;
                            $data['email'] = $email;
                            $data['message'] = $message;
                            $data['human'] = $human;
                            $data['from'] = $from;
                            $data['to'] = $to;
                            $data['subject'] = $subject;
                            $data['body'] = $body;

                            $data['errName'] = $errName;
                            $data['errEmail'] = $errEmail;
                            $data['errMessage'] = $errMessage;
                            $data['errHuman'] = $errHuman;
                            $data['result'] = $result;
                    }

                } else {
                    $data['name'] = "";
                    $data['email'] = "";
                    $data['message'] = "";
                    $data['human'] = "";
                    $data['from'] = "";
                    $data['to'] = "";
                    $data['subject'] = "";
                    $data['body'] = "";

                    $data['errName'] = "";
                    $data['errEmail'] = "";
                    $data['errMessage'] = "";
                    $data['errHuman'] = "";
                    $data['result'] = "";
                    
                }
                
            }
            
            //Set new captcha for when form loads first time or we have an error.
            $captcha1 = rand(1,9);
            $captcha2 = rand(1,9);
            $captcha3 = rand(1,9);
            $this->nativesession->set("captcha", $captcha1 + $captcha2 + $captcha3 );
            $data['captcha'] = $captcha1 . " + " . $captcha2 . " + " . $captcha3 . " ?";
            
            $this->load->module('templates')->page_tpl($data);
        }



    }

}

/* End of file */
