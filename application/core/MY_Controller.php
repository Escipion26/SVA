<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * 
 */
class MY_controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('account_model');
        $this->load->model("slide_model");
        $this->load->library('recursos');
    }

    public function Plantilla($view, $data = array()) {


        $this->load->view("plantilla/header");
        $this->load->view($view, $data);
        $this->load->view("plantilla/footer");
    }
    
    public function carga_slide() { //funcion que trae imagenes para carrusel principal
        $slide = "";
        $menu = $this->slide_model->traer_contenido_slide(1);
        $cont = 0;
        if ($menu) {

            foreach ($menu as $foto) {
                if ($cont == 0) {
                    $slide .="<div class='item active'>";
                    $slide .="<div class='col-sm-6'>";
                    $slide .="<h1><span>E</span>-SHOPPER</h1>";
                    $slide .="<h2>" . $foto->dis_titulo . "</h2>";
                    $slide .="<p>$foto->dis_descripcion</p>";
                    $slide .="</div>";
                    $slide .="<div class='col-sm-6'>";
                    $slide .="<img src='".base_url()."$foto->dis_ruta' class='girl img-responsive' alt='' />";
                    $slide .="</div>";
                    $slide .="</div>";
                    $cont = 1;
                } elseif ($cont == 1) {
                    $slide .="<div class='item'>";
                    $slide .="<div class='col-sm-6'>";
                    $slide .="<h1><span>E</span>-SHOPPER</h1>";
                    $slide .="<h2>" . $foto->dis_titulo . "</h2>";
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

    public function carga_recomendado() { //funcion que trae rutas de imagenes para recomendados inicio
        $cadena = "";
        $menu = $this->slide_model->traer_contenido_recomendado(2);

        if ($menu) {
            foreach ($menu as $foto) {
                $cadena .="<div class='col-lg-3 col-md-3 col-sm-4 col-xs-12'>";
                $cadena .="<div class = 'product-image-wrapper'>";
                $cadena .="<div class = 'single-products'>";
                $cadena .="<div class = 'productinfo text-center'>";
                $cadena .="<img src = '".base_url(). $foto->ruta . "' alt = '' />";
                $cadena .="<h2>$" . $this->recursos->Formato1($foto->precio_venta) . "</h2>";
                $cadena .="<p>" . $foto->descripcion . "</p>";
                $cadena .="<button onclick='DetalleProducto(".$foto->id_producto.")' data-toggle='modal' data-target='#detalle'  class = 'btn btn-success add-to'><i class = 'fa fa-shopping-cart'></i> Ver producto</button>";
                $cadena .="</div>";
                $cadena .="</div>";
                $cadena .="</div>";
                $cadena .="</div>";
            }
            $cadena .= "</div>";
        }

        return $cadena;
    }

    public function carga_menu_categorias() {

        $categorias = $this->slide_model->traer_categorias(1);
        $subcategorias = $this->slide_model->traer_categorias(2);
        $menu = "";
        if ($categorias && $subcategorias) {

            foreach ($categorias as $row) {
                $menu .="<div class = 'panel panel-defaul'>";
                $menu .="<div class = 'panel-heading'>";
                $menu .="<h4 class = 'panel-title'>";
                $menu .="<a data-toggle = 'collapse' data-parent = '#accordian' href = '#" . $row->cat_nombre_categoria . "'>";
                $menu .="<span class = 'badge pull-right'><i class = 'fa fa-plus'></i></span>";
                $menu .=$row->cat_nombre_categoria;
                $menu .="</a>";
                $menu .="</h4>";
                $menu .="</div>";
                $menu .="<div id = '" . $row->cat_nombre_categoria . "' class = 'panel-collapse collapse'>";
                $menu .="<div class ='panel-body'>";
                $menu .="<ul>";

                foreach ($subcategorias as $value) {
                    if ($row->idtab_categorias == $value->tab_categorias_idtab_categorias) {
                        $menu .="<li><a class='btn' onclick='sub(" . $row->idtab_categorias . "," . $value->idtab_sub_categorias . ");'>" . $value->sub_nombre . "</a></li>";
                    }
                }

                $menu .="</ul>";
                $menu .="</div>";
                $menu .="</div>";
                $menu .="</div>";
            }
        }

        return $menu;
    }
    

   

}
