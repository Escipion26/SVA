<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends MY_controller {

    
    public function __construct() {
        parent::__construct();
        $this->load->model("slide_model");
    }
    public function index() {

        $inicio['slide'] = $this->carga_slide();
        $inicio['recomendado'] = $this->carga_recomendado();
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
    
    
    public function carga_recomendado(){ //funcion que trae rutas de imagenes para recomendados inicio
        
        $recomendado1_inicio = "<div class='item active'>";
        $recomendado2_inicio = "<div class='item'>";
        $tag_final = "</div>";
        $cadena ="";
        
        $menu = $this->slide_model->traer_contenido_recomendado(2);
        $cont = 0;
        
        if($menu){
            foreach ($menu as $foto) {
                if($cont==0){ //las primeras 3 fotos con class active para que funcione
                    $cadena .= $recomendado1_inicio;
                }elseif($cont == 3){ // pas proximas sin class active
                    $cadena .= $tag_final;
                    $cadena .= $recomendado2_inicio;
                }
                $cadena .="<div class = 'col-sm-4'>";
                    $cadena .="<div class = 'product-image-wrapper'>";
                        $cadena .="<div class = 'single-products'>";
                            $cadena .="<div class = 'productinfo text-center'>";
                                $cadena .="<img src = '".$foto->ruta."' alt = '' />";
                                $cadena .="<h2>'$".$foto->precio_venta."'</h2>";
                                $cadena .="<p>'".$foto->descripcion."'</p>";
                                $cadena .="<a href = '#' class = 'btn btn-default add-to-cart'><i class = 'fa fa-shopping-cart'></i>Agregar a carrito</a>";
                            $cadena .="</div>";
                        $cadena .="</div>";
                    $cadena .="</div>";
                $cadena .="</div>";
                $cont = $cont + 1;
            }
            $cadena .= $tag_final;
        }
        
        return $cadena;
    }

}
