<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_controller {

    public function __construct() {
        parent::__construct();
        
    }

    public function index() {
         if(!$this->session->userdata('logueado')){
            redirect(base_url()); 
        }else{
        $this->Plantilla("cuenta", array());
        }
    }

}
