<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function existe_sesion($usuario, $pass) { //cambiar

        $this->db->select(['*']);
        $this->db->from("tab_login tl, tab_clientes tc");
        $this->db->where("tc.cli_correo", $usuario);
        $this->db->where("tl.log_pass", $pass);
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return false;
        }
    }
    
    public function traer_usuario($usuario,$pass){
        $this->db->select([
            'tc.idtab_clientes',
            'tc.cli_rut',
            'tc.cli_nombre',
            'tc.cli_apellido',
            'tc.cli_correo',
            'tl.log_pass'
        ]);
        $this->db->from("tab_login tl, tab_clientes tc");
        $this->db->where('tc.idtab_clientes = tl.tab_clientes_idtab_clientes');
        $this->db->where("tl.log_pass", $pass);
        $this->db->where("tc.cli_correo", $usuario);
       
        $query = $this->db->get();  
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
        
    }
    
    public function insert($nombre,$email,$pass){
        
        $data = array(
            'cli_nombre' => $nombre,
            'cli_correo'  => $email
        );
        
        $query = $this->db->insert('tab_clientes', $data);
        
        if($query){ //Si se inserta en clientes, se inserta en login
            
            $id = $this->db->insert_id();
            
            $datos = array(
                'log_pass' => $pass,
                'tab_clientes_idtab_clientes'  => $id
            );
            
            $insert = $this->db->insert('tab_login', $datos);
            
            if($insert){
                return TRUE;
            }else{
                return FALSE;
            }
            
        }else{
            return FALSE;
        }
    }

}
