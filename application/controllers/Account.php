<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('account_model');
        $this->load->library('recursos');
    }

    public function index() {
        if (!$this->session->userdata('logueado')) {
            redirect(base_url());
        } else {

            $data['menu'] = $this->menu_cuenta();
            $this->Plantilla("cuenta", $data);
        }
    }
    
    public function configuracion() {
        
        $data['menu'] = $this->menu_cuenta();
        $this->Plantilla('configuracion', $data);
    }

    public function menu_cuenta() {
        $cadena = "";

        $cadena .= "<div class='col-lg-12' style='margin-bottom: 50px;margin-top: 20px'>";
        $cadena .= "<ul class='nav nav-tabs nav-justified'>";
        if($this->session->userdata('datos_personales') == true){
            $cadena .= "<li><a  href='" . base_url() . "index.php/informacion-personal'>Datos personales <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span></a></li>";
        }else{
            $cadena .= "<li><a  href='" . base_url() . "index.php/informacion-personal'>Datos personales</a></li>";
        }
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

    public function ActualizaDatos() { //Actualiza datos personales. Datos enviados de modal
        $id_cliente = $this->input->post('id_cliente');
        $rut = $this->input->post('rut');
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $contacto1 = $this->input->post('contacto1');
        $contacto2 = $this->input->post('contacto2');


        $this->form_validation->set_rules('rut', 'Rut', 'trim|required|callback_validaRut_check|max_length[10]');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'trim|required');
        $this->form_validation->set_rules('contacto1', 'Contacto 1', 'trim|required|numeric|min_length[8]|max_length[9]');
        $this->form_validation->set_rules('contacto2', 'Contacto 2', 'trim|numeric|min_length[8]|max_length[9]');

        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('numeric', 'El campo %s debe contener solo numeros');
        $this->form_validation->set_message('xss_clean', 'El campo %s contiene caracteres invalidos');
        $this->form_validation->set_message('min_length', 'El campo %s debe tener minimo 9 caracteres');
        $this->form_validation->set_message('max_length', 'El campo %s no debe tener mas de 9 caracteres');

        if ($this->form_validation->run() == FALSE) {
            $data['resp'] = FALSE;
            $data['mensaje'] = validation_errors();
            echo json_encode($data);
        } else {

            $datos = $this->account_model->ActualizarDatos(
                    $id_cliente, $this->recursos->FormatoRut($rut), $nombre, $apellido, $contacto1, $contacto2
            );

            if ($datos) {
                $data['resp'] = TRUE;
                $data['mensaje'] = "Su datos fueron actualizados correctamente";
                echo json_encode($data);
            } else {
                $data['resp'] = FALSE;
                $data['mensaje'] = "Error al actualizar los datos";
                echo json_encode($data);
            }
        }
    }

    public function datos_personales() { //url informacion-personal
        $id_cliente = $this->session->userdata('id_cliente');

        $datos = $this->account_model->traer_cliente($id_cliente);

        $cadena = "";

        if ($datos) {

            $rut = ($datos->cli_rut == null) ? ' ' : $this->recursos->DevuelveRut($datos->cli_rut);
            $nombre = ($datos->cli_nombre == null) ? ' ' : $datos->cli_nombre;
            $apellido = ($datos->cli_apellido == null) ? ' ' : $datos->cli_apellido;
            $fono1 = ($datos->cli_fono1 == null) ? ' ' : $datos->cli_fono1;
            $fono2 = ($datos->cli_fono2 == null) ? ' ' : $datos->cli_fono2;
            
            //Para averiguar si debe completar datos personales
            if($rut == ' ' || $apellido == ' '){
                $this->session->set_userdata('datos_personales', TRUE);
            }else{
                $this->session->set_userdata('datos_personales', FALSE);
            }

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
            $cadena .= "<td class='active'>Fono 1</td>";
            $cadena .= "<td>" . $fono1 . "</td>";
            $cadena .= "</tr>";
            $cadena .= "<tr>";
            $cadena .= "<td class='active'>Fono 2</td>";
            $cadena .= "<td>" . $fono2 . "</td>";
            $cadena .= "</tr>";
            $cadena .= "</table>";
            $cadena .= "<button type='button' data-target='#DatosModal' onclick='ObtieneDatos(" . $id_cliente . ")' data-toggle='modal' class='btn btn-primary pull-right'>Modificar</button>";
            
            $data['menu'] = $this->menu_cuenta();
            $data['datos_personales'] = $cadena;

            $this->Plantilla('datos_personales', $data);
        } else {
            
        }
    }

    public function direcciones() { // url direccion-despacho
        $id_cliente = $this->session->userdata('id_cliente');

        $datos = $this->account_model->traer_direcciones($id_cliente);
        $cuenta = $this->account_model->cuenta_direcciones($id_cliente);

        if ($datos) {

            $cadena = "";

            $cadena .= "<table class='table table-responsive table-bordered table-hover text-center'>";
            $cadena .= "<tr>";
            $cadena .= "<td colspan='7'><button type='button'data-target='#InsertarModal' onclick='insertdireccion()' data-toggle='modal' class='btn btn-outline btn-primary pull-left'>Agregar direccion</td>";
            $cadena .= "</tr>";
            $cadena .= "<tr>";
            $cadena .= "<td class='active'>Nombre</td>";
            $cadena .= "<td class='active'>Direccion</td>";
            $cadena .= "<td class='active'>Region</td>";
            $cadena .= "<td class='active'>Provincia</td>";
            $cadena .= "<td class='active'>Comuna</td>";
            $cadena .= "<td class='text-center active' colspan='2'>Opciones</td>";
            $cadena .= "</tr>";

            foreach ($datos as $row) {
                $cadena .= "<tr>";
                $cadena .= "<td>" . $row->dir_nombre . "</td>";
                $cadena .= "<td>" . $row->dir_direccion . "</td>";
                $cadena .= "<td>" . $row->reg_nombre . "</td>";
                $cadena .= "<td>" . $row->prov_nombre . "</td>";
                $cadena .= "<td>" . $row->com_nombre . "</td>";
                $cadena .= "<input type='hidden' id='id_provincia' value=''>";
                $cadena .= "<td><button type='button' data-target='#EditarModal' onclick='ObtieneDireccion(" . $row->idtab_direcciones . ")' data-toggle='modal' class='btn btn-success'>Modificar</button></td>";
                if ($cuenta > 1) {
                    $cadena .= "<td><button type='button' onclick='EliminarDireccion(" . $row->idtab_direcciones . ")' class='btn btn-danger pull-left' id='eliminar'>Eliminar</button></td>";
                }

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

    public function regiones_insert() { //para llenar select al insertar nueva direccion
        $cadena = '';
        $dato = $this->account_model->traer_regiones();

        foreach ($dato as $row) {
            $cadena .="<option value='" . $row->idtab_region . "'>" . $row->reg_nombre . "</option>";
        }


        $data['regiones'] = $cadena;

        echo json_encode($data);
    }

    public function traer_datos() { //llena datos personales en modal (primer menu)
        $idcliente = $this->input->post('id_cliente');

        $datos = $this->account_model->traer_cliente($idcliente);

        if ($datos) {

            $rut = ($datos->cli_rut == null) ? ' ' : $this->recursos->DevuelveRut($datos->cli_rut);
            $nombre = ($datos->cli_nombre == null) ? ' ' : $datos->cli_nombre;
            $apellido = ($datos->cli_apellido == null) ? ' ' : $datos->cli_apellido;
            $correo = ($datos->cli_correo == null) ? ' ' : $datos->cli_correo;
            $fono1 = ($datos->cli_fono1 == null) ? ' ' : $datos->cli_fono1;
            $fono2 = ($datos->cli_fono2 == null) ? ' ' : $datos->cli_fono2;

            $arr = array(
                'rut' => $rut,
                'nombre' => $nombre,
                'apellido' => $apellido,
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
        $this->session->unset_userdata('id_provincia'); //elimino sesion id provincia

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

    public function llenar_provincias() {  //llena select con provincias en modal modificar direcciones
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

    public function llenar_comunas() { //llena select con comunas en modal modificar direcciones
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

    function validaRut_check($rut) {
        $suma = 0;
        if (strpos($rut, "-") == false) {
            $RUT[0] = substr($rut, 0, -1);
            $RUT[1] = substr($rut, -1);
        } else {
            $RUT = explode("-", trim($rut));
        }
        $elRut = str_replace(".", "", trim($RUT[0]));
        $factor = 2;
        for ($i = strlen($elRut) - 1; $i >= 0; $i--):
            $factor = $factor > 7 ? 2 : $factor;
            $suma += $elRut{$i} * $factor++;
        endfor;
        $resto = $suma % 11;
        $dv = 11 - $resto;
        if ($dv == 11) {
            $dv = 0;
        } else if ($dv == 10) {
            $dv = "k";
        } else {
            $dv = $dv;
        }
        if ($dv == trim(strtolower($RUT[1]))) {
            return true;
        } else {
            $this->form_validation->set_message('validaRut_check', '%s invalido');
            return false;
        }
    }

    public function InsertarDireccion() { //funcion para insertar nueva direccion
        $id_cliente = $this->session->userdata('id_cliente');
        $nombre_direccion = $this->input->post('nombre_direccion');
        $direccion = $this->input->post('direccion');
        $region = $this->input->post('region');
        $provincia = $this->input->post('provincia');
        $comuna = $this->input->post('comuna');

        $this->form_validation->set_rules('nombre_direccion', 'Nombre direccion', 'trim|required');
        $this->form_validation->set_rules('direccion', 'Direccion', 'trim|required');
        $this->form_validation->set_rules('region', 'Region', 'required|callback_region_check');
        $this->form_validation->set_rules('provincia', 'Provincia', 'callback_provincia_check');
        $this->form_validation->set_rules('comuna', 'Comuna', 'callback_comuna_check');

        $this->form_validation->set_message('required', 'El campo %s es obligatorio');

        if ($this->form_validation->run() == FALSE) {
            $data['resp'] = FALSE;
            $data['mensaje'] = validation_errors();
            echo json_encode($data);
        } else {

            $dato = $this->account_model->Insertar_direccion($id_cliente, $nombre_direccion, $direccion, $region, $provincia, $comuna);

            if ($dato) {
                $data['resp'] = TRUE;
                $data['mensaje'] = 'Dirección guardada correctamente';
                echo json_encode($data);
            } else {
                $data['resp'] = FALSE;
                $data['mensaje'] = 'Error al guardar dirección';
                echo json_encode($data);
            }
        }
    }

    function region_check($region) { //funcion para validacion del campo monto_boleta. FORM VALIDATION
        if ($region > 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('region_check', 'Seleccione %s');
            return false;
        }
    }

    function provincia_check($region) { //funcion para validacion del campo monto_boleta. FORM VALIDATION
        if ($region > 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('provincia_check', 'Seleccione %s');
            return false;
        }
    }

    function comuna_check($region) { //funcion para validacion del campo monto_boleta. FORM VALIDATION
        if ($region > 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('comuna_check', 'Seleccione %s');
            return false;
        }
    }

    public function ActualizarDireccion() {

        $id_cliente = $this->session->userdata('id_cliente');
        $id_direccion = $this->input->post('id_direccion');
        $nombre = $this->input->post('nombre_direccion');
        $direccion = $this->input->post('direccion');
        $region = $this->input->post('region');
        $provincia = $this->input->post('provincia');
        $comuna = $this->input->post('comuna');

        $this->form_validation->set_rules('nombre_direccion', 'Nombre direccion', 'trim|required');
        $this->form_validation->set_rules('direccion', 'Direccion', 'trim|required');
        $this->form_validation->set_rules('region', 'Region', 'required|callback_region_check');
        $this->form_validation->set_rules('provincia', 'Provincia', 'callback_provincia_check');
        $this->form_validation->set_rules('comuna', 'Comuna', 'callback_comuna_check');

        $this->form_validation->set_message('required', 'El campo %s es obligatorio');

        if ($this->form_validation->run() == FALSE) {
            $data['resp'] = FALSE;
            $data['mensaje'] = validation_errors();
            echo json_encode($data);
        } else {
            $dato = $this->account_model->ActualizarDireccion($id_cliente, $id_direccion, $nombre, $direccion, $region, $provincia, $comuna);

            if ($dato) {
                $data['resp'] = TRUE;
                $data['mensaje'] = 'Dirección actualizada correctamente';
                echo json_encode($data);
            } else {
                $data['resp'] = FALSE;
                $data['mensaje'] = 'Error al actualizar dirección';
                echo json_encode($data);
            }
        }
    }

    public function ActualizarCorreo() {

        $email = $this->input->post('email');
        $pass = sha1(md5($this->input->post('pass')));

        $this->form_validation->set_rules('email', 'Correo electronico', 'trim|required|valid_email|is_unique[tab_clientes.cli_correo]');
        $this->form_validation->set_rules('pass', 'Contraseña', 'trim|required|min_length[5]|alpha_numeric');

        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('valid_email', 'El campo %s es incorrecto');
        $this->form_validation->set_message('is_unique', 'Este email ya esta siendo usado');
        $this->form_validation->set_message('min_length', 'El campo %s debe tener minimo 5 caracteres');
        $this->form_validation->set_message('alpha_numeric', 'El campo %s solo debe tener letras y/o numeros');

        if ($this->form_validation->run() == FALSE) {
            $data['resp'] = FALSE;
            $data['mensaje'] = validation_errors();
            echo json_encode($data);
        } else {

            if ($pass == $this->session->userdata('password')) { //si la contraseña original es correcta
                $id = $this->session->userdata('id_cliente');
                $query = $this->account_model->ActualizarCorreo($email, $id);

                if ($query) {
                    $data['resp'] = True;
                    $data['mensaje'] = 'Correo actualizado correctamente';
                    $this->session->set_userdata('correo', $email);
                    echo json_encode($data);
                } else {
                    $data['resp'] = FALSE;
                    $data['mensaje'] = 'Correo NO pudo ser actualizado';
                    echo json_encode($data);
                }
            } else { //si la contraseña no es correcta
                $data['resp'] = FALSE;
                $data['mensaje'] = 'Contraseña incorrecta';
                echo json_encode($data);
            }
        }
    }

    public function ActualizarContra() {
        $pass1 = $this->input->post('pass1'); //password original
        $pass2 = $this->input->post('pass2');
        $pass3 = $this->input->post('pass3');

        $this->form_validation->set_rules('pass1', 'Contraseña actual', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('pass2', 'Nueva contraseña', 'trim|required|min_length[5]|alpha_numeric|matches[pass3]');
        $this->form_validation->set_rules('pass3', 'Reingresar contraseña', 'trim|required|min_length[5]|alpha_numeric');

        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('min_length', 'El campo %s debe tener minimo 5 caracteres');
        $this->form_validation->set_message('alpha_numeric', 'El campo %s solo debe tener letras y/o numeros');
        $this->form_validation->set_message('matches', 'Los campos de su nueva contraseña deben coincidir');

        if ($this->form_validation->run() == FALSE) {
            $data['resp'] = FALSE;
            $data['mensaje'] = validation_errors();
            echo json_encode($data);
        } else {
            if (sha1(md5($pass1)) == $this->session->userdata('password')) { //si la contraseña original es correcta
                $id = $this->session->userdata('id_cliente');
                $query = $this->account_model->ActualizarContraseña(sha1(md5($pass2)), $id);

                if ($query) {
                    $data['resp'] = True;
                    $data['mensaje'] = 'Contraseña actualizada correctamente';
                    $this->session->set_userdata('contraseña', $pass2);
                    echo json_encode($data);
                } else {
                    $data['resp'] = FALSE;
                    $data['mensaje'] = 'Contraseña NO pudo ser actualizada';
                    echo json_encode($data);
                }
            } else { //si la contraseña no es correcta
                $data['resp'] = FALSE;
                $data['mensaje'] = 'Contraseña incorrecta';
                echo json_encode($data);
            }
        }
    }

    public function EliminarDireccion() {

        $id_cliente = $this->session->userdata('id_cliente');
        $idd = $this->input->post('idd');

        $query = $this->account_model->EliminaDireccion($id_cliente, $idd);

        if ($query) {
            $data['resp'] = True;
            $data['mensaje'] = 'Dirección eliminada correctamente';
            echo json_encode($data);
        } else {
            $data['resp'] = FALSE;
            $data['mensaje'] = 'No se pudo eliminar dirección';
            echo json_encode($data);
        }
    }

}
