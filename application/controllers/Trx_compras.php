<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trx_compras extends MY_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("trx_model");
    }
    
    public function index() {
        if (!$this->session->userdata('logueado')) {
            redirect(base_url());
        }else{
            $data['menu'] = $this->menu_cuenta();
            $data['confirmacion'] = $this->confirmacion();
            $this->Plantilla("ordenes", $data);
        } 
    }
    
    
    public function ver_detalle(){
        
        $cadena = '';
        $carrito = $this->cart->contents();
        
        $cadena .='<table class="table table-condense table-over">';
        $cadena .='<tr>';
            $cadena .='<td class="active">Producto</td>';
            $cadena .='<td class="active">Cantidad</td>';
            $cadena .='<td class="active">Valor</td>';
            $cadena .='</tr>';
            
        foreach ($carrito as $row){
            $cadena .='<tr>';
            $cadena .='<td>'.$row['name'].'</td>';
            $cadena .='<td>'.$row['qty'].'</td>';
            $cadena .='<td>'.$row['subtotal'].'</td>';
            $cadena .='</tr>';
            
        }
        
        $cadena .='<tr>';
        $cadena .='<td colspan="2" style="text-align:right">TOTAL</td>';
        $cadena .='<td>'.$this->cart->total().'</td>';
        $cadena .='</tr>';
        $cadena .='</table>';
        $data['respuesta']= $cadena;
        
        echo json_encode($data);
        
        
    } 
    
    function confirmacion(){
        $cadena = '';
        
        $cadena .= '<tr>';
        $cadena .= '<input type="hidden" id="base" value="'.base_url().'">';
        $cadena .= '<td class="active">Fecha compra</td>';
        $cadena .= '<td>'.date('d-m-Y').'</td>';
        $cadena .= '</tr>';
        $cadena .= '<tr>';
        $cadena .= '<td class="active">Estado compra</td>';
        $cadena .= '<td>Pendiente de pago</td>';
        $cadena .= '</tr>';
        $cadena .= '<tr>';
        $cadena .= '<td class="active">Detalle compra</td>';
        $cadena .= '<td><a onclick="ver_detalle()" class="btn">Ver detalle</a></td>';
        $cadena .= '</tr>';
        $cadena .= '<tr>';
        $cadena .= '<td class="active">Total</td>';
        $cadena .= '<td>'.$this->cart->total().'</td>';
        $cadena .= '</tr>';
        $cadena .= '<tr>';
        $cadena .= '<td>&nbsp;</td>';
        $cadena .= '<td><button class="btn btn-primary">Terminar compra</button></td>';
        $cadena .= '</tr>';
        
        return $cadena;
        
    }


    public function menu_cuenta() {
        $cadena = "";

        $cadena .= "<div class='col-lg-12' style='margin-bottom: 50px;margin-top: 20px'>";
        $cadena .= "<ul class='nav nav-tabs nav-justified'>";
        $cadena .= "<li><a  href='" . base_url() . "index.php/informacion-personal'>Datos personales</a></li>";
        $cadena .= "<li><a  href='" . base_url() . "index.php/direccion-despacho'>Direccion despacho</a></li>";
        if($this->session->userdata('pendiente') == true){
            $cadena .= "<li><a  href='" . base_url() . "index.php/estados-de-compras'>Estado de compras <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span></a></li>";
        }else{
            $cadena .= "<li><a  href='" . base_url() . "index.php/estados-de-compras'>Estado de compras</a></li>";
        }
        $cadena .= "<li><a  href='" . base_url() . "index.php/configuracion-cuenta'>Configuracion cuenta</a></li>";
        $cadena .= "</ul>";
        $cadena .="</div>";

        return $cadena;
    }
    
}

