<?php

defined('BASEPATH') OR exit('No direct script access allowed');

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
        $cadena .= "<li><a  href='" . base_url() . "index.php/informacion-personal'>Datos personales</a></li>";
        $cadena .= "<li><a  href='" . base_url() . "index.php/direccion-despacho'>Direccion despacho</a></li>";
        $cadena .= "<li><a  href='#'>Estado pedidos</a></li>";
        $cadena .= "<li><a  href='#'>Configuracion cuenta</a></li>";
        $cadena .= "</ul>";
        $cadena .="</div>";

        return $cadena;
    }

    public function datos_personales() {

        $id_cliente = $this->session->userdata('id_cliente');

        $datos = $this->account_model->traer_cliente($id_cliente);

        $cadena = "";

        if ($datos) {

            $rut = ($datos->cli_rut == null) ? ' ' : $datos->cli_rut;
            $nombre = ($datos->cli_nombre == null) ? ' ' : $datos->cli_nombre;
            $apellido = ($datos->cli_apellido == null) ? ' ' : $datos->cli_apellido;
            $correo = ($datos->cli_correo == null) ? ' ' : $datos->cli_correo;
            $fono1 = ($datos->cli_fono1 == null) ? ' ' : $datos->cli_fono1;
            $fono2 = ($datos->cli_fono2 == null) ? ' ' : $datos->cli_fono2;

            $cadena .= "<table class='table table-bordered table-responsive'>";
            $cadena .= "<tr>";
            $cadena .= "<td class='active col-lg-5 col-md-5 col-sm-5 col-xs-5'>Rut</td>";
            $cadena .= "<td>" . $rut . "</td>";
            $cadena .= "</tr>";
            $cadena .= "<tr>";
            $cadena .= "<td class='active'>Nombre</td>";
            $cadena .= "<td>" . $nombre . "</td>";
            $cadena .= "</tr>";
            $cadena .= "<tr>";
            $cadena .= "<td class='active'>Apellido</td>";
            $cadena .= "<td>" . $apellido . "</td>";
            $cadena .= "</tr>";
            $cadena .= "<tr>";
            $cadena .= "<td class='active'>Correo electronico</td>";
            $cadena .= "<td>" . $correo . "</td>";
            $cadena .= "</tr>";
            $cadena .= "<tr>";
            $cadena .= "<td class='active'>Fono 1</td>";
            $cadena .= "<td>" . $fono1 . "</td>";
            $cadena .= "</tr>";
            $cadena .= "<tr>";
            $cadena .= "<td class='active'>Fono 2</td>";
            $cadena .= "<td>" . $fono2 . "</td>";
            $cadena .= "</tr>";
            $cadena .= "</table>";
            $cadena .= "<button type='button' data-target='#DatosModal' onclick='ObtieneDatos(".$id_cliente.")' data-toggle='modal' class='btn btn-primary pull-right'>Modificar</button>";
            $data['menu'] = $this->menu_cuenta();
            $data['datos_personales'] = $cadena;

            $this->Plantilla('datos_personales', $data);
        } else {
            
        }
    }
    
   

    public function direcciones() {

        $id_cliente = $this->session->userdata('id_cliente');

        $datos = $this->account_model->traer_direcciones($id_cliente);

        if ($datos) {

            $cadena = "";

            $cadena .= "<table class='table table-striped table-hover'>";
            $cadena .= "<tr>";
            $cadena .= "<td class='active'>Nombre</td>";
            $cadena .= "<td class='active'>Direccion</td>";
            $cadena .= "<td class='active'>Region</td>";
            $cadena .= "<td class='active'>Provincia</td>";
            $cadena .= "<td class='active'>Comuna</td>";
            $cadena .= "<td class='text-center' colspan='2'>Accion</td>";
            $cadena .= "</tr>";

            foreach ($datos as $row) {
                $cadena .= "<tr>";
                $cadena .= "<td>" . $row->dir_nombre . "</td>";
                $cadena .= "<td>" . $row->dir_direccion . "</td>";
                $cadena .= "<td>" . $row->reg_nombre . "</td>";
                $cadena .= "<td>" . $row->prov_nombre . "</td>";
                $cadena .= "<td>" . $row->com_nombre . "</td>";
                $cadena .= "<input type='hidden' id='id_provincia' value=''>";
                $cadena .= "<td><button type='button' data-target='#EditarModal' onclick='ObtieneDireccion(" . $row->idtab_direcciones . ")' data-toggle='modal' class='btn btn-success pull-right'>Modificar</button></td>";
                $cadena .= "<td><button type='button' onclick='EliminarDireccion(" . $row->idtab_direcciones . ")' class='btn btn-danger pull-left' id='eliminar'>Eliminar</button></td>";
                $cadena .= "</tr>";
            }

            $cadena .= "</table>";

            $data['direcciones'] = $cadena;
            $data['menu'] = $this->menu_cuenta();
            $data['regiones'] = $this->traer_regiones();
            $data['provincias'] = $this->traer_provincias();
            $data['comunas'] = $this->traer_comunas();
            $this->Plantilla('direcciones', $data);
        }
    }

    public function traer_direccion() { //llena campos del modal
        $id_direccion = $this->input->post('id_direccion');

        $data = $this->account_model->traer_direccion($id_direccion);

        $arr = array(
            'nombre' => $data->dir_nombre,
            'direccion' => $data->dir_direccion,
            'id_direccion' => $data->idtab_direcciones
        );

        echo json_encode($arr);
    }
    
    public function traer_datos(){
        
        $idcliente = $this->input->post('id_cliente');
        
        $datos = $this->account_model->traer_cliente($idcliente);
        
        if($datos){

            $rut = ($datos->cli_rut == null) ? ' ' : $datos->cli_rut;
            $nombre = ($datos->cli_nombre == null) ? ' ' : $datos->cli_nombre;
            $apellido = ($datos->cli_apellido == null) ? ' ' : $datos->cli_apellido;
            $correo = ($datos->cli_correo == null) ? ' ' : $datos->cli_correo;
            $fono1 = ($datos->cli_fono1 == null) ? ' ' : $datos->cli_fono1;
            $fono2 = ($datos->cli_fono2 == null) ? ' ' : $datos->cli_fono2;
            
            $arr = array(
                'rut' => $rut,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'correo' => $correo,
                'fono1' => $fono1,
                'fono2' => $fono2    
            );
            
        }
        
        echo json_encode($arr); 
        
    }
    
     public function traer_regiones() { //carga select del modal
        $dato = $this->account_model->traer_regiones();
        $data = $this->account_model->traer_region();

        $cadena = "";
        $cadena .="<select name='regiones' id='regiones' class='form-control'>";

        foreach ($dato as $row) {

            if ($data->tab_region_idtab_region == $row->idtab_region) {
                $cadena .="<option selected value='" . $data->tab_region_idtab_region . "'>" . $data->reg_nombre . "</option>";
                $this->session->set_userdata('id_region', $data->tab_region_idtab_region);
                //guardo id de la region en sesion para traer provincias de esa region y cargar un select inicial
            } else {
                $cadena .="<option value='" . $row->idtab_region . "'>" . $row->reg_nombre . "</option>";
            }
        }
        $cadena .="</select>";

        return $cadena;
    }

    public function traer_provincias() {

        $id_region = $this->session->userdata('id_region');
        $this->session->unset_userdata('id_region'); //elimino sesion id region

        $dato = $this->account_model->select_provincias($id_region);
        $data = $this->account_model->traer_provincia();

        $cadena = "";
        $cadena .="<select name='provincia' id='provincia' class='form-control'>";
        foreach ($dato as $row) {

            if ($data->tab_provincia_idtab_provincia == $row->idtab_provincia) {
                $cadena .="<option selected value='" . $data->tab_provincia_idtab_provincia . "'>" . $data->prov_nombre . "</option>";
                $this->session->set_userdata('id_provincia', $data->tab_provincia_idtab_provincia);
                //guardo id de la region en sesion para traer provincias de esa region y cargar un select inicial
            } else {
                $cadena .="<option value='" . $row->idtab_provincia . "'>" . $row->prov_nombre . "</option>";
            }
        }
        $cadena .="</select>";

        return $cadena;
    }
    
    public function traer_comunas() {
        $id_provincia = $this->session->userdata('id_provincia');
        $this->session->unset_userdata('id_provincia'); //elimino sesion id region

        $dato = $this->account_model->select_comunas($id_provincia);
        $data = $this->account_model->traer_comuna();

        $cadena = "";
        $cadena .="<select name='comuna' id='comuna' class='form-control'>";
        $cadena .= "<option value='0'>------Seleccione comuna------</option>";
        foreach ($dato as $row) {

            if ($data->tab_comuna_idtab_comuna == $row->idtab_comuna) {
                $cadena .="<option selected value='" . $data->tab_comuna_idtab_comuna . "'>" . $data->com_nombre . "</option>";
                //guardo id de la region en sesion para traer provincias de esa region y cargar un select inicial
            } else {
                $cadena .="<option value='" . $row->idtab_comuna . "'>" . $row->com_nombre . "</option>";
            }
        }
        $cadena .="</select>";

        return $cadena;
    }

    public function llenar_provincias() {

        $cadena = "";
        $idreg = $this->input->post('idregion');
        $data = $this->account_model->devolver_provincias($idreg);
        $dato = $this->account_model->traer_provincia();

        foreach ($data as $row) {
            if ($dato->tab_provincia_idtab_provincia == $row->idtab_provincia) {
                $cadena .= "<option selected value='" . $dato->tab_provincia_idtab_provincia . "'>" . $dato->prov_nombre . "</option>";
            } else {
                $cadena .= "<option value='" . $row->idtab_provincia . "'>" . $row->prov_nombre . "</option>";
            }
        }
        $arr = array(
            'respuesta' => $cadena
        );

        echo json_encode($arr);
    }

    public function llenar_comunas() {


        $cadena = "";
        $idpro = $this->input->post('idpro');
        $data = $this->account_model->devolver_comunas($idpro);
        $dato = $this->account_model->traer_comuna();
        foreach ($data as $row) {
            if ($dato->tab_comuna_idtab_comuna == $row->idtab_comuna) {
                $cadena .= "<option selected value='" . $dato->tab_comuna_idtab_comuna . "'>" . $dato->com_nombre . "</option>";
            } else {
                $cadena .= "<option value='" . $row->idtab_comuna . "'>" . $row->com_nombre . "</option>";
            }
        }
        $arr = array(
            'respuesta' => $cadena
        );

        echo json_encode($arr);
    }

}
