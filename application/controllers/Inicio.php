<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MY_controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->model("slide_model");
    }
    public function index() {

        $inicio['slide'] = $this->carga_slide();
        $this->Plantilla("inicio", $inicio);
    }

    public function carga_slide() { //funcion que trae imagenes para carrusel principal

        $slide = "";
        $menu = $this->slide_model->traer_contenido_slide(1);
        $cont = 0;
        if ($menu) {

            foreach ($menu as $foto) {
                if($cont==0){
                    $slide .="<div class='item active'>";
                    $slide .="<div class='col-sm-6'>";
                    $slide .="<h1><span>E</span>-SHOPPER</h1>";
                    $slide .="<h2>'".$foto->dis_titulo."'</h2>";
                    $slide .="<p>$foto->dis_descripcion</p>";
                    $slide .="</div>";
                    $slide .="<div class='col-sm-6'>";
                    $slide .="<img src='" . base_url() . "$foto->dis_ruta' class='girl img-responsive' alt='' />";
                    $slide .="</div>";
                    $slide .="</div>";
                    $cont = 1;
                }elseif($cont==1){
                    $slide .="<div class='item'>";
                    $slide .="<div class='col-sm-6'>";
                    $slide .="<h1><span>E</span>-SHOPPER</h1>";
                    $slide .="<h2>'".$foto->dis_titulo."'</h2>";
                    $slide .="<p>$foto->dis_descripcion</p>";
                    $slide .="</div>";
                    $slide .="<div class='col-sm-6'>";
                    $slide .="<img src='" . base_url() . "$foto->dis_ruta' class='girl img-responsive' alt='' />";
                    $slide .="</div>";
                    $slide .="</div>";
                }
                
            }
            
        }

        return $slide;
    }
    
    
    public function carga_recomendado(){ //funcion que rutas de imagenes para recomendados
        
        $recomendado1_inicio = "";
        $recomendado1_final = "";
        $recomendado2 = "";
        $recomendado_final = "";
        $menu = $this->slide_model->traer_contenido_recomendado(2);
        $cont = 0;
        
        if($menu){
            foreach ($menu as $foto) {
                
                
                
                
            }
        }
        
        
    }

}
