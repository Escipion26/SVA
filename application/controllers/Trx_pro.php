<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trx_pro extends MY_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("trx_model");
    }

    /**
     *  Metodo que recibe id_producto para luego traer detalle de producto desde bd. Luego lo agrega
     *  a carrito de compra
     * */
    public function trx_carro_agr() {
        $id_producto = $this->input->post('id_producto');
        $cantidad = $this->input->post('cantidad');

        $resul = $this->trx_model->traer_producto($id_producto);

        if ($resul) {

            $data = array(
                'id' => $resul->prod_sku,
                'qty' => $cantidad,
                'price' => $resul->prod_precio_venta,
                'name' => $resul->prod_nombre
            );

            $this->cart->insert($data);
            $total_items = $this->cart->total_items();

            $data['total_item'] = $total_items;
            $data['resp'] = TRUE;
            $data['mensaje'] = "Agregado a carrito correctamente";
            echo json_encode($data);
        } else {
            $data['resp'] = FALSE;
            $data['mensaje'] = "Error al agregar a carrito";
            echo json_encode($data);
        }
    }

    /**
     * Metodo que retorna la lista con productos que existen en el carrito de compra
     * en una variable string
     * 
     * */
    
    public function carrito() {

        $cadena = '';
        $carrito = $this->cart->contents();
        $rowid = "";


        foreach ($carrito as $row) {
            
            $rowid = $row['rowid'];
            
            $cadena .= '<tr>';
            $cadena .= '<td class="cart_product">';
            $cadena .= '<a href=""><img src="'.base_url().'assets/images/cart/one.png" alt=""></a>';
            $cadena .= '</td>';
            $cadena .= '<td class="cart_description">';
            $cadena .= '<h4>'.$row['name'].'</h4>';
            $cadena .= '<p>Sku: '.$row['id'].'</p>';
            $cadena .= '</td>';
            $cadena .= '<td class="cart_price">';
            $cadena .= '<p>$'.$row['price'].'</p>';
            $cadena .= '</td>';
            $cadena .= '<td class="cart_quantity">';
            $cadena .= '<div class="cart_quantity_button">';
            $cadena .= '<input type="hidden" id="base" value="'.base_url().'">';
            $cadena .= '<input type="hidden" id="original'.$row['rowid'].'" value="'.$row['qty'].'">';
            $cadena .= '<input class="cart_quantity_input" id="cant'.$row['rowid'].'" onkeypress="return ValidNum(event)" type="text" name="quantity" value="'.$row['qty'].'" autocomplete="off" size="5">';
            $cadena .= '</div>';
            $cadena .= '</td>';
            $cadena .= '<td class="cart_total">';
            $cadena .= '<p  id="total" class="cart_total_price">$'.$row['subtotal'].'</p>';
            $cadena .= '</td>';
            $cadena .= '<td>';
            $cadena .= '<button id="actualiar" onclick="return calculo(\''.$row['rowid'].'\');" class="btn btn-success pull-left" data-placement="top" data-toggle="tooltip" title="ACTUALIZAR CARRO" ><i class="fa fa-refresh"></i></button>';
            $cadena .= '</td>';
            $cadena .= '<td>';
            $cadena .= '<button onclick="return eliminar(\''.$row['rowid'].'\',0);" class="btn btn-danger" data-placement="right" data-toggle="tooltip" title="ELIMINAR DE CARRITO" ><i class="fa fa-trash-o"></i></button>';
            $cadena .= '</td>';
            $cadena .= '</tr>';
            
        }



        $data['detalle'] = $cadena;

        $this->Plantilla('cart', $data);
    }
    
    
    /**
     * Metodo que toma la cantidad y sku (id) para actualizar carrito. Se llama a este metodo desde neg.js
     * funcion actualizar_carro. Actualiza cantidad y total y luego devuelve total producto en un string.
     **/
    
    public function actualizar_carro(){
        
        $id = $this->input->post('id');
        $cantidad = $this->input->post('cantidad');
        
        
        $data = array(
            'rowid' => $id,
            'qty' => $cantidad
        );
        
        $ok = $this->cart->update($data);
        
        if($ok){
           $datos['resp'] = TRUE;
           $datos['mensaje'] = "Carrito actualizado correctamente"; 
        }else{
           $datos['resp'] = FALSE;
           $datos['mensaje'] = "No se pudo actualiar carrito"; 
        }
        
        echo json_encode($datos);
        
    }
    
    

}
