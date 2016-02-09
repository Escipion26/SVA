<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Busqueda extends MY_controller {
    public function __construct() {
        parent::__construct();
        $this->load->model("busqueda_model");
    }
    
    public function carga_productos(){
        
        $categoria = $this->input->post('cat');
        $subcategoria = $this->input->post('sub');
        $cadena = "";
        
        $data = $this->busqueda_model->traer_productos($categoria,$subcategoria);
        $query = $this->busqueda_model->nombre_categoria($categoria);
        
        if($data){
            foreach ($data as $row) {
                $cadena .="<div class='col-sm-4'>";
                    $cadena .="<div class = 'product-image-wrapper'>";
                        $cadena .="<div class = 'single-products'>";
                            $cadena .="<div class = 'productinfo text-center'>";
                                $cadena .="<img src = '".$row->ruta."' alt = '' />";
                                $cadena .="<h2>$".$row->precio_venta."</h2>";
                                $cadena .="<p>".$row->descripcion."</p>";
                                $cadena .="<a href = '#' class = 'btn btn-default add-to-cart'><i class = 'fa fa-shopping-cart'></i>Agregar a carrito</a>";
                            $cadena .="</div>";
                        $cadena .="</div>";
                    $cadena .="</div>";
                $cadena .="</div>";
            }
            $cadena .= "</div>";
        }else{
            $cadena .= "";
        }
        $dato['categoria'] = "<h2 class='title text-center'>".$query->cat_nombre_categoria."</h2>";
        $dato['productos'] = $cadena;
        echo json_encode($dato);
        
    }
    
    
    
}