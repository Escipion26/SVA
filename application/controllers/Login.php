<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("login_model");
        $this->load->library('bcrypt');
    }

    public function index() {
        if ($this->session->userdata('logueado')) {
            redirect(base_url());
        } else {

            $data['regiones'] = $this->traer_regiones();
            $data['provincias'] = $this->traer_provincias();
            $data['comunas'] = $this->traer_comunas();
            $this->Plantilla("login", $data);
        }
    }

    public function inicio_sesion() {

        $usuario = $this->input->post("email");
        $pass = sha1(md5($this->input->post("password")));

        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'contraseña', 'trim|required|min_length[5]|alpha_numeric');

        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('valid_email', 'El campo %s es incorrecto');
        $this->form_validation->set_message('xss_clean', 'El campo %s contiene caracteres invalidos');
        $this->form_validation->set_message('min_length', 'El campo %s debe tener minimo 5 caracteres');
        $this->form_validation->set_message('alpha_numeric', 'El campo %s contiene caracteres invalidos');

        if ($this->form_validation->run() == FALSE) {
            $mensaje = validation_errors();
            $this->session->set_flashdata('login', $mensaje);
            $data['class'] = "alert alert-danger";
            $data['regiones'] = $this->traer_regiones();
            $data['provincias'] = $this->traer_provincias();
            $data['comunas'] = $this->traer_comunas();
            $this->Plantilla("login", $data);
        } else {

            $data = $this->login_model->existe_sesion($usuario, $pass); //Para consultar si esta registrado

            if ($data) {
                $this->crear_sesion($usuario, $pass);
            } else {
                $mensaje = " Usuario o contraseña incorrectos.";
                $this->session->set_flashdata('login', $mensaje);
                $data['class'] = "alert alert-danger";
                $data['regiones'] = $this->traer_regiones();
                $data['provincias'] = $this->traer_provincias();
                $data['comunas'] = $this->traer_comunas();
                $this->Plantilla("login", $data);
            }
        }
    }

    public function crear_sesion($usuario, $pass) {
        $datos = $this->login_model->traer_usuario($usuario, $pass); //cambiar

        $sesion = array(
            'logueado' => true,
            'id_cliente' => $datos->idtab_clientes,
            'nombre' => $datos->cli_nombre,
            'correo' => $datos->cli_correo,
            'password' => $datos->log_pass
        );
        
        
        $this->session->set_userdata($sesion); //Cargo los datos de sesion
        redirect(base_url());
    }

    public function cerrar_sesion() {
        //borrar datos cache
        $this->RemoveCache();
        //para destruir los datos de sesion
        $this->session->sess_destroy();
        redirect(base_url(), 'refresh');
    }

    public function RemoveCache() {
        $this->db->cache_delete_all();
        $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
        $this->output->set_header('Pragma: no-cache');
    }

    public function registro() {

        $nombre = $this->input->post("nombre");
        $email = $this->input->post("correo");
        $direccion = $this->input->post("direccion");
        $pass = sha1(md5($this->input->post("password")));
        $region = $this->input->post("reg");
        
        $provincia = $this->input->post("pro");
        $comuna = $this->input->post("com");
        $contraseña2 = $this->input->post("password2");


        $this->form_validation->set_rules('nombre', 'nombre', 'trim|required');
        $this->form_validation->set_rules('correo', 'correo', 'trim|required|valid_email|is_unique[tab_clientes.cli_correo]');
        $this->form_validation->set_rules('direccion', 'direccion', 'trim|required');
        $this->form_validation->set_rules('password', 'contraseña', 'trim|required|min_length[5]|alpha_numeric|matches[password2]');
        $this->form_validation->set_rules('password2', 'reingresar contraseña', 'trim|required|min_length[5]|alpha_numeric');
        $this->form_validation->set_rules('reg', 'region', 'callback_region_check');
        $this->form_validation->set_rules('pro', 'provincia', 'callback_provincia_check');
        $this->form_validation->set_rules('com', 'comuna', 'callback_comuna_check');

        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('valid_email', 'El campo %s es incorrecto');
        $this->form_validation->set_message('is_unique', 'Este email ya existe');
        $this->form_validation->set_message('min_length', 'El campo %s debe tener minimo 5 caracteres');
        $this->form_validation->set_message('alpha_numeric', 'El campo %s solo debe tener letras y/o numeros');
        $this->form_validation->set_message('matches', 'Los campos de contraseña deben coincidir');


        if ($this->form_validation->run() == FALSE) {

            $mensaje = validation_errors();
            $this->session->set_flashdata('login', $mensaje);
            $data['class'] = "alert alert-danger";
            $data['regiones'] = $this->traer_regiones();
            $data['provincias'] = $this->traer_provincias();
            $data['comunas'] = $this->traer_comunas();
            $this->Plantilla("login", $data);
        } else {




            $insert = $this->login_model->insert($nombre, $email, $direccion, $pass, $region, $provincia, $comuna);

            if ($insert) {
                $this->crear_sesion($email, $pass);
            } else {
                $mensaje = " Hubo un error al tratar de registralo. Favor comunicarse con administrador.";
                $this->session->set_flashdata('login', $mensaje);
                $data['class'] = "alert alert-danger";
                $data['regiones'] = $this->traer_regiones();
                $data['provincias'] = $this->traer_provincias();
                $data['comunas'] = $this->traer_comunas();
                $this->Plantilla("login", $data);
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

    public function traer_regiones() { //carga select del modal
        $dato = $this->login_model->regiones();

        $cadena = "";
        $cadena .="<select name='reg' id='reg' class='form-control'>";
        $cadena .= "<option value='0'>------Seleccione region------</option>";

        foreach ($dato as $row) {
            $cadena .="<option value='" . $row->idtab_region . "'>" . $row->reg_nombre . "</option>";
        }
        $cadena .="</select>";

        return $cadena;
    }

    public function traer_provincias() {

        $dato = $this->login_model->provincias();

        $cadena = "";
        $cadena .="<select name='pro' id='pro' class='form-control'>";
        $cadena .= "<option value='0'>------Seleccione provincia------</option>";
        foreach ($dato as $row) {
            $cadena .="<option value='" . $row->idtab_provincia . "'>" . $row->prov_nombre . "</option>";
        }
        $cadena .="</select>";

        return $cadena;
    }

    public function llenar_provincias() {

        $cadena = "";
        $idreg = $this->input->post('idregion');
        $data = $this->login_model->devolver_provincias($idreg);
        $cadena .= "<option value='0'>------Seleccione provincia------</option>";
        foreach ($data as $row) {
            $cadena .= "<option value='" . $row->idtab_provincia . "'>" . $row->prov_nombre . "</option>";
        }
        $arr = array(
            'respuesta' => $cadena
        );

        echo json_encode($arr);
    }

    public function llenar_comunas() {

        $cadena = "";
        $idpro = $this->input->post('idpro');
        $data = $this->login_model->devolver_comunas($idpro);
        $cadena .= "<option value='0'>------Seleccione comuna------</option>";
        foreach ($data as $row) {
            $cadena .= "<option value='" . $row->idtab_comuna . "'>" . $row->com_nombre . "</option>";
        }
        $arr = array(
            'respuesta' => $cadena
        );

        echo json_encode($arr);
    }

    public function traer_comunas() {
        $dato = $this->login_model->comunas();

        $cadena = "";
        $cadena .="<select name='com' id='com' class='form-control'>";
        $cadena .= "<option value='0'>------Seleccione comuna------</option>";
        foreach ($dato as $row) {
            $cadena .="<option value='" . $row->idtab_comuna . "'>" . $row->com_nombre . "</option>";
        }
        $cadena .="</select>";

        return $cadena;
    }

}
