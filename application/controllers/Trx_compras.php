<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trx_compras extends MY_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("trx_model");
        $this->load->library("recursos");
    }

    public function index() {
        if (!$this->session->userdata('logueado')) {
            redirect(base_url());
        } else {
            $data['menu'] = $this->menu_cuenta();
            $data['confirmacion'] = $this->confirmacion();
            $data['transacciones'] = $this->transacciones();
            $this->Plantilla("ordenes", $data);
        }
    }
    
    function transacciones(){
        
        $cadena = '';
        $id_cliente = $this->session->userdata('id_cliente');
        $data = $this->trx_model->traer_transacciones($id_cliente);
        
        foreach ($data as $row){
            $cadena .= '<tr>';
            $cadena .= '<td>'.$row->cot_numero_cotizacion.'</td>';
            $cadena .= '<td>'.  $this->recursos->FormatoFecha($row->cot_fecha).'</td>';
            $cadena .= '<td>$'.$this->recursos->Formato1($row->cot_total).'</td>';
            $cadena .= '<td>'.$row->es_descripcion.'</td>';
            $cadena .= '<td><button class="btn btn-primary">Ver detalle</button></td>';
            $cadena .= '</tr>';
            
        }
        
        return $cadena;
        
        
    }

    public function ver_detalle() {

        $cadena = '';
        $carrito = $this->cart->contents();

        $cadena .='<table class="table table-condense table-over text-center">';
        $cadena .='<tr>';
        $cadena .='<td class="active">Producto</td>';
        $cadena .='<td class="active">Cantidad</td>';
        $cadena .='<td class="active">Valor</td>';
        $cadena .='</tr>';

        foreach ($carrito as $row) {
            $cadena .='<tr>';
            $cadena .='<td>' . $row['name'] . '</td>';
            $cadena .='<td>' . $row['qty'] . '</td>';
            $cadena .='<td>' . $this->recursos->Formato1($row['subtotal']) . '</td>';
            $cadena .='</tr>';
        }

        $cadena .='<tr>';
        $cadena .='<td colspan="2" style="text-align:right">TOTAL</td>';
        $cadena .='<td>' . $this->recursos->Formato1($this->cart->total()) . '</td>';
        $cadena .='</tr>';
        $cadena .='</table>';
        $data['respuesta'] = $cadena;

        echo json_encode($data);
    }

    function confirmacion() {
        $cadena = '';

        $cadena .= '<tr>';
        $cadena .= '<input type="hidden" id="base" value="' . base_url() . '">';
        $cadena .= '<td class="active">Fecha compra</td>';
        $cadena .= '<td>' . date('d-m-Y') . '</td>';
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
        $cadena .= '<td>' . $this->recursos->Formato1($this->cart->total()) . '</td>';
        $cadena .= '<tr>';
        $cadena .= '<td class="active">Selecicone dirección de despacho</td>';
        $cadena .= '<td>';
        $cadena .= '<select id="direccion">';
        $cadena .= $this->traer_direcciones();
        $cadena .= '</select>';
        $cadena .= '</td>';
        $cadena .= '</tr>';
        $cadena .= '</tr>';
        $cadena .= '<tr>';
        $cadena .= '<td>&nbsp;</td>';
        if ($this->session->userdata('datos_personales') == true) {
            $cadena .= '<td><button onclick="TerminarCompra(1)" class="btn btn-primary">Terminar compra</button></td>'; //Falta coompletar datos personales
        } else {
            $cadena .= '<td><button onclick="TerminarCompra(2)" class="btn btn-primary">Terminar compra</button></td>';
        }

        $cadena .= '</tr>';

        return $cadena;
    }

    function traer_direcciones() {

        $id_cliente = $this->session->userdata("id_cliente");
        $cadena = '';
        $data = $this->trx_model->traer_direcciones($id_cliente);

        foreach ($data as $row) {
            $cadena .='<option value="' . $row->idtab_direcciones . '">' . $row->dir_direccion . ', ' . $row->com_nombre . ', ' . $row->reg_nombre . '</option>';
        }

        return $cadena;
    }

    public function menu_cuenta() {
        $cadena = "";

        $cadena .= "<div class='col-lg-12' style='margin-bottom: 50px;margin-top: 20px'>";
        $cadena .= "<ul class='nav nav-tabs nav-justified'>";
        if ($this->session->userdata('datos_personales') == true) { //Datos personales completos?
            $cadena .= "<li><a  href='" . base_url() . "index.php/informacion-personal'>Datos personales <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span></a></li>";
        } else {
            $cadena .= "<li><a  href='" . base_url() . "index.php/informacion-personal'>Datos personales</a></li>";
        }
        $cadena .= "<li><a  href='" . base_url() . "index.php/direccion-despacho'>Direccion despacho</a></li>";
        if ($this->session->userdata('pendiente') == true) { //venta pendiente?
            $cadena .= "<li><a  href='" . base_url() . "index.php/estados-de-compras'>Estado de compras <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span></a></li>";
        } else {
            $cadena .= "<li><a  href='" . base_url() . "index.php/estados-de-compras'>Estado de compras</a></li>";
        }
        $cadena .= "<li><a  href='" . base_url() . "index.php/configuracion-cuenta'>Configuracion cuenta</a></li>";
        $cadena .= "</ul>";
        $cadena .="</div>";

        return $cadena;
    }

    /**
     * Recibe desde neg.js->terminar compra un numero de orden de compra
     */
    public function terminar_compra() {

        $numero_orden = $this->input->post('numero_orden');
        $id_direccion = $this->input->post('id_direccion');

        $ok = $this->trx_model->terminar_compra($numero_orden, $id_direccion);

        if ($ok) {
            $data['resp'] = TRUE;
            $data['mensaje'] = "Orden realizada exitosamente";
            
            $this->session->set_userdata('pendiente',FALSE);
            $this->cart->destroy(); //Borro datos de carrito
            
        } else {
            $data['resp'] = FALSE;
            $data['mensaje'] = "Orden no pudo ser realizada";
            
        }
        
        echo json_encode($data);
    }

}
