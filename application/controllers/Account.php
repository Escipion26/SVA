<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('account_model');
    }

    public function index() {
        if (!$this->session->userdata('logueado')) {
            redirect(base_url());
        } else {
            
            $data['menu'] = $this->menu_cuenta();
            $this->Plantilla("cuenta", $data);
        }
    }

    public function menu_cuenta() {
        $cadena = "";

        $cadena .= "<div class='col-lg-12' style='margin-bottom: 50px;margin-top: 20px'>";
        $cadena .= "<ul class='nav nav-tabs nav-justified'>";
        $cadena .= "<li><a  href='".base_url()."index.php/informacion-personal'>Datos personales</a></li>";
        $cadena .= "<li><a  href='#'>Direccion despacho</a></li>";
        $cadena .= "<li><a  href='#'>Estado pedidos</a></li>";
        $cadena .= "<li><a  href='#'>Configuracion cuenta</a></li>";
        $cadena .= "</ul>";
        $cadena .="</div>";
        
        return $cadena;
    }
    
    public function datos_personales(){
        
        $id_cliente = $this->session->userdata('id_cliente');
        
        $datos = $this->account_model->traer_cliente($id_cliente);
        
        $cadena = "";
        
        if($datos){
            
            $rut = ($datos->cli_rut == null) ? ' ' : $datos->cli_rut;
            $nombre = ($datos->cli_nombre == null) ? ' ' : $datos->cli_nombre;
            $apellido = ($datos->cli_apellido == null) ? ' ' : $datos->cli_apellido;
            $correo = ($datos->cli_correo == null) ? ' ' : $datos->cli_correo;
            $fono1 = ($datos->cli_fono1 == null) ? ' ' : $datos->cli_fono1;
            $fono2 = ($datos->cli_fono2 == null) ? ' ' : $datos->cli_fono2;
            
            $cadena .= "<table class='table table-bordered table-responsive'>";
            $cadena .= "<tr>";
            $cadena .= "<td class='active col-lg-5 col-md-5 col-sm-5 col-xs-5'>Rut</td>";
            $cadena .= "<td>".$rut."</td>";
            $cadena .= "</tr>";
            $cadena .= "<tr>";
            $cadena .= "<td class='active'>Nombre</td>";
            $cadena .= "<td>".$nombre."</td>";
            $cadena .= "</tr>";
            $cadena .= "<tr>";
            $cadena .= "<td class='active'>Apellido</td>";
            $cadena .= "<td>".$apellido."</td>";
            $cadena .= "</tr>";
            $cadena .= "<tr>";
            $cadena .= "<td class='active'>Correo electronico</td>";
            $cadena .= "<td>".$correo."</td>";
            $cadena .= "</tr>";
            $cadena .= "<tr>";
            $cadena .= "<td class='active'>Fono 1</td>";
            $cadena .= "<td>".$fono1."</td>";
            $cadena .= "</tr>";
            $cadena .= "<tr>";
            $cadena .= "<td class='active'>Fono 2</td>";
            $cadena .= "<td>".$fono2."</td>";
            $cadena .= "</tr>";
            $cadena .= "</table>";
            
            $data['menu'] = $this->menu_cuenta();
            $data['datos_personales'] = $cadena;
            
            $this->Plantilla('datos_personales', $data);
            
            
        }else{
           
        }
        
        
    }

}
