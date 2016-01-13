<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends MY_controller {
    
    public function index(){
        
        $this->vista("producto",array());
        
    }
}
