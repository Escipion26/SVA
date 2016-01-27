<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function existe_sesion($usuario, $pass) { //cambiar
        $this->db->select('tc.idtab_clientes');
        $this->db->from("tab_login tl, tab_clientes tc");
        $this->db->where("tc.cli_correo", $usuario);
        $this->db->where('tc.idtab_clientes = tl.tab_clientes_idtab_clientes');
        $this->db->where("tl.log_pass", $pass);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return false;
        }
    }

    public function regiones() {

        $this->db->order_by('reg_nombre', 'asc');
        $query = $this->db->get('tab_region');
        
        return $query->result();
    }
    
    public function provincias() {

        $this->db->order_by('prov_nombre', 'asc');
        $query = $this->db->get('tab_provincia');
        
        return $query->result();
    }
    
    public function comunas() {

        $this->db->order_by('com_nombre', 'asc');
        $query = $this->db->get('tab_comuna');
        
        return $query->result();
    }
    
    public function devolver_provincias($idreg){
        $sql = $this->db->select("idtab_provincia, prov_nombre")
                ->where("tab_region_idtab_region", $idreg)
                ->get("tab_provincia");

        if ($sql) {
            return $sql->result();
        }
    }
    public function devolver_comunas($idpro){
        $sql = $this->db->select("idtab_comuna, com_nombre")
                ->where("tab_provincia_idtab_provincia", $idpro)
                ->get("tab_comuna");

        if ($sql) {
            return $sql->result();
        }
    }

    public function traer_usuario($usuario, $pass) {
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

    public function insert($nombre, $email,$direccion, $pass, $region, $provincia,$comuna) {

        //array para insertar en tab_clientes
        $data = array( 
            'cli_nombre' => $nombre,
            'cli_correo' => $email
        );

        $query = $this->db->insert('tab_clientes', $data);

        if ($query) { //Si se inserta en clientes, se inserta en login
            
            $id = $this->db->insert_id();
            
            //array para insertar en tab_login
            $datos = array(
                'log_pass' => $pass,
                'tab_clientes_idtab_clientes' => $id
            );
            
            $registro = array(
                'tab_clientes_idtab_clientes' => $id,
                'dir_direccion' => $direccion,
                'tab_region_idtab_region' => $region,
                'tab_provincia_idtab_provincia' => $provincia,
                'tab_comuna_idtab_comuna' => $comuna
            );
            
                        
            $insertlogin = $this->db->insert('tab_login', $datos);

            if ($insertlogin) {
                
                $insertdireccion = $this->db->insert('tab_direcciones', $registro);
                if($insertdireccion){
                    return TRUE;
                }  else {
                    return FALSE;
                }
            } else { //si no inserta en tab_login
                return FALSE;
            }
        } else { //si no inserta en clientes
            return FALSE;
        }
    }

}
