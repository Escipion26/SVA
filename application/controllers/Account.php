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
        $cadena .= "<li><a  href='".base_url()."index.php/direccion-despacho'>Direccion despacho</a></li>";
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
    
    public function direcciones() {
        
        $id_cliente = $this->session->userdata('id_cliente');
        
        $datos = $this->account_model->traer_direcciones($id_cliente);
        
        if($datos){
            
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
            
            foreach ($datos as $row){
                $cadena .= "<tr>";
                $cadena .= "<td>".$row->dir_nombre."</td>";
                $cadena .= "<td>".$row->dir_direccion."</td>";
                $cadena .= "<td>".$row->reg_nombre."</td>";
                $cadena .= "<td>".$row->prov_nombre."</td>";
                $cadena .= "<td>".$row->com_nombre."</td>";
                $cadena .= "<input type='hidden' id='id_provincia' value=''>";
                $cadena .= "<td><button type='button' data-target='#EditarModal' onclick='ObtieneDireccion(".$row->idtab_direcciones.")' data-toggle='modal' class='btn btn-success pull-right'>Modificar</button></td>";
                $cadena .= "<td><button type='button' onclick='EliminarDireccion(".$row->idtab_direcciones.")' class='btn btn-danger pull-left' id='eliminar'>Eliminar</button></td>";
                $cadena .= "</tr>";
            }
            
            $cadena .= "</table>";
            
            //$data['regiones'] =  $this->account_model->traer_regiones();
            
            $data['direcciones'] = $cadena;
            $data['menu'] = $this->menu_cuenta();
            $data['regiones'] = $this->traer_regiones();
            $this->Plantilla('direcciones', $data);
            
            
            
        }
    }
    
    public function traer_regiones(){
        $dato = $this->account_model->traer_regiones();
        $data = $this->account_model->traer_region();
        
        $cadena = "";
        $cadena .="<select name='regiones' class='form-control'>";
        
        foreach ($dato as $row){
            
            if($data->tab_region_idtab_region == $row->idtab_region){
                $cadena .="<option selected value='".$data->tab_region_idtab_region."'>".$data->reg_nombre."</option>";
            }else{
                $cadena .="<option value='".$row->idtab_region."'>".$row->reg_nombre."</option>";
            }
            
        }
        $cadena .="</select>";
        
        return $cadena;
        
    }
    
    public function traer_direccion() {
        
        $id_direccion = $this->input->post('id_direccion');
        
        $data = $this->account_model->traer_direccion($id_direccion);
        
        $arr = array(
            'nombre' => $data->dir_nombre,
            'direccion' => $data->dir_direccion,
            'id_direccion' => $data->idtab_direcciones
        );
        
         echo json_encode($arr); 
    }
    
    public function llenar_provincias(){
       
        $idpro = $this->input->get('region');        
        $this->account_model->devolver_provincias($idpro); 
        
    }
    
    public function llenar_comuna($idprovincia){
        
        
        $data = $this->account_model->llenar_comuna($idprovincia);
        
        if($data){
            $cadena ="";
            
            foreach($data as $row){
                $cadena .="<option value='".$row->idtab_comuna."'>'".$row->com_nombre."'</option>";
            }
        }
        
        return $cadena;
        
    }
    

}
