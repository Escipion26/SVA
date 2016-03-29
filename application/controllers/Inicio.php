<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MY_controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->library('recursos');
    }

    public function index() {

        $inicio['slide'] = $this->carga_slide();
        $inicio['recomendado'] = $this->carga_recomendado();
        $inicio['categorias'] = $this->carga_menu_categorias();
        $this->Plantilla("inicio", $inicio);
    }

}
