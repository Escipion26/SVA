<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Busqueda extends MY_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("busqueda_model");
    }

    /**
      Funcion que trae productos segun categoria y subcategorias para luego cargarlos en div en view inicio
     * */
    public function carga_productos() {

        $categoria = $this->input->post('cat');
        $subcategoria = $this->input->post('sub');
        $cadena = "";

        $data = $this->busqueda_model->traer_productos($categoria, $subcategoria);
        $query = $this->busqueda_model->nombre_categoria($categoria);

        if ($data) {
            foreach ($data as $row) {
                $cadena .="<div class='col-sm-4'>";
                $cadena .="<div class = 'product-image-wrapper'>";
                $cadena .="<div class = 'single-products'>";
                $cadena .="<div class = 'productinfo text-center'>";
                $cadena .="<img src = '" . $row->ruta . "' alt = '' />";
                $cadena .="<h2>$" . $row->precio_venta . "</h2>";
                $cadena .="<p>" . $row->descripcion . "</p>";
                $cadena .="<button  onclick='DetalleProducto(".$row->id_producto.")' data-toggle='modal' data-target='#detalle' class = 'btn btn-success add-to'><i class = 'fa fa-shopping-cart'></i>Ver producto</button>";
                $cadena .="</div>";
                $cadena .="</div>";
                $cadena .="</div>";
                $cadena .="</div>";
            }
            $cadena .= "</div>";
        } else {
            $cadena .= "";
        }
        $dato['categoria'] = "<h2 class='title text-center'>" . $query->cat_nombre_categoria . "</h2>";
        $dato['productos'] = $cadena;
        echo json_encode($dato);
    }

    /**
      Funcion que carga modal con el detalle del producto junto con la opcion para agregarlo al carrito de compras.
     * El modal se activa al seleccionar ver producto. Devuelve una variable string con html
     * */
    public function detalle_producto() {

        $id_producto = $this->input->post('id_producto');
        $cadena = "";
        $producto = $this->busqueda_model->ver_producto($id_producto);

        if ($producto) {
           
//                $cadena .= "<div class='container'>";
                $cadena .= "<div class='product-details'>";
                $cadena .= "<div class='col-lg-5 col-xs-5 col-md-5 col-sm-5'>";
//                $cadena .= "<div class='view-product'>";
                $cadena .= "<img class='img-responsive' src='" . base_url() . "$producto->img_ruta' />";
                $cadena .= "</div>";
//                $cadena .= "</div>";
                $cadena .= "<div class='col-lg-7 col-xs-5 col-md-7 col-sm-7'>";
                $cadena .= "<h2>" . $producto->prod_nombre . "</h2>";
                $cadena .= "<p>SKU: " . $producto->prod_sku . "</p>";
                $cadena .= "<span>";
                $cadena .= "<span>Precio $".$producto->prod_precio_venta."</span>";
                if ($producto->prod_stock > 0) { //SI NO HAY STOCK ESCONDE EL BOTON AGREGAR A CARRITO
                    $cadena .= "</br></br><label>Cantidad: </label>";
                    $cadena .= "<input type='text' size='4' class=''>";
                    $cadena .= "</br></br><button type='button' class='btn btn-success'>";
                    $cadena .= "<i class='fa fa-shopping-cart'></i>";
                    $cadena .= "Agregar a carrito";
                    $cadena .= "</button>";
                    $cadena .= "</span>";
                    $cadena .= "</br><p><b>Disponibilidad:</b> En stock</p>";
                } else {
                    $cadena .= "</br><p><b>Disponibilidad:</b> No disponible</p>";
                }
                $cadena .= "</div>";
                $cadena .= "</div>";
//                $cadena .= "</div>";
                
            }else{
                $cadena .= "No existe producto";
                
                
            }
            $data['detalle'] = $cadena;

            echo json_encode($data);
        }
    

}
