<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MY_controller {
    
    public function index(){
        
        $this->Plantilla1("inicio",array());
        
    }
}