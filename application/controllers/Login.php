<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("login_model");
    }

    public function index() {
        if($this->session->userdata('logueado')){
            redirect(base_url()); 
        }else{
        $this->Plantilla("login", array());
        }
    }

    public function inicio_sesion() {

        $usuario = $this->input->post("email");
        $pass = $this->input->post("password");

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
            $this->Plantilla("login", $data);
        } else {

            $data = $this->login_model->existe_sesion($usuario, $pass); //Para consultar si existe registrado

            if ($data) {
                $this->crear_sesion($usuario, $pass);
            } else {
                $mensaje = " Usuario o contraseña incorrectos.";
                $this->session->set_flashdata('login', $mensaje);
                $data['class'] = "alert alert-danger";
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
    
    public function cerrar_sesion(){
        //borrar datos cache
        $this->RemoveCache();
        //para destruir los datos de sesion
        $this->session->sess_destroy();
        redirect(base_url(),'refresh');
    }
    public function RemoveCache(){
        $this->db->cache_delete_all();
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');
    }
    
    public function registro(){
        $nombre = $this->input->post("nombre");
        $email = $this->input->post("email");
        $pass = $this->input->post("password");
        
        
        
        $this->form_validation->set_rules('nombre','nombre','trim|required');
        $this->form_validation->set_rules('email', 'correo', 'trim|required|valid_email|is_unique[tab_clientes.cli_correo]');
        $this->form_validation->set_rules('password', 'pass', 'trim|required|min_length[5]|alpha_numeric');
        
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('valid_email', 'El campo %s es incorrecto');
        $this->form_validation->set_message('is_unique', 'Este email ya existe');
        $this->form_validation->set_message('min_length', 'El campo %s debe tener minimo 5 caracteres');
        $this->form_validation->set_message('alpha_numeric', 'El campo %s solo debe tener letras y/o numeros');
        
        if($this->form_validation->run() ==  FALSE){
            
            $mensaje = validation_errors();
            $this->session->set_flashdata('login', $mensaje);
            $data['class'] = "alert alert-danger";
            $this->Plantilla("login", $data);
            
        }else{
            
            $insert = $this->login_model->insert($nombre,$email,$pass);
            
            if($insert){
                $this->crear_sesion($email, $pass);
            }else{
                $mensaje = " Hubo un error al tratar de registralo. Favor comunicarse con administrador.";
                $this->session->set_flashdata('login', $mensaje);
                $data['class'] = "alert alert-danger";
                $this->Plantilla("login", $data);
            }
            
        }
    }

}
