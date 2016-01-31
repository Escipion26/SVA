<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Account_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function traer_cliente($id_cliente) {

        $this->db->select("cli_rut, cli_nombre, cli_apellido, cli_correo, cli_fono1, cli_fono2 ");
        $this->db->from('tab_clientes');
        $this->db->where('idtab_clientes', $id_cliente);


        $query = $this->db->get();

        if ($query) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function traer_direcciones($id_cliente) {

        $this->db->select(""
                . "td.idtab_direcciones,"
                . "td.dir_nombre,"
                . "td.dir_direccion,"
                . "tr.reg_nombre,"
                . "tp.prov_nombre,"
                . "tc.com_nombre,"
                . "td.tab_region_idtab_region,"
                . "td.tab_provincia_idtab_provincia,"
                . "td.tab_comuna_idtab_comuna");
        $this->db->from("tab_direcciones td, tab_region tr, tab_provincia tp, tab_comuna tc ");
        $this->db->where("td.tab_clientes_idtab_clientes", $id_cliente);
        $this->db->where("td.tab_region_idtab_region = tr.idtab_region");
        $this->db->where("td.tab_provincia_idtab_provincia = tp.idtab_provincia");
        $this->db->where("td.tab_comuna_idtab_comuna = tc.idtab_comuna");

        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function traer_regiones() {

        $this->db->order_by('reg_nombre', 'asc');
        $query = $this->db->get('tab_region');

        return $query->result();
    }

    public function traer_region() {

        $this->db->select("td.tab_region_idtab_region, tr.reg_nombre");
        $this->db->from("tab_direcciones td, tab_region tr");
        $this->db->where('td.tab_region_idtab_region = tr.idtab_region');
        $this->db->where('tab_clientes_idtab_clientes', $this->session->userdata('id_cliente'));
        $query = $this->db->get();

        if ($query) {
            return $query->row();
        }  else {
            return FALSE;
        }
    }

    public function traer_comuna() {
        $this->db->select("td.tab_comuna_idtab_comuna, tr.com_nombre");
        $this->db->from("tab_direcciones td, tab_comuna tr");
        $this->db->where('td.tab_comuna_idtab_comuna = tr.idtab_comuna');
        $this->db->where('tab_clientes_idtab_clientes', $this->session->userdata('id_cliente'));
        $query = $this->db->get();

        if ($query) {
            return $query->row();
        }  else {
            return FALSE;
        }
    }

    public function traer_direccion($id_direccion) {

        $this->db->select("idtab_direcciones, dir_nombre, dir_direccion");
        $this->db->from("tab_direcciones");
        $this->db->where("idtab_direcciones", $id_direccion);

        $query = $this->db->get();

        if ($query) {
            return $query->row();
        }
    }

    public function devolver_provincias($idpro) {
        $sql = $this->db->select("idtab_provincia, prov_nombre")
                ->where("tab_region_idtab_region", $idpro)
                ->get("tab_provincia");

        if ($sql) {
            return $sql->result();
        }
    }

    public function devolver_comunas($idpro) {
        $sql = $this->db->select("idtab_comuna, com_nombre")
                ->where("tab_provincia_idtab_provincia", $idpro)
                ->get("tab_comuna");

        if ($sql) {
            return $sql->result();
        }
    }

    public function traer_provincia() {

        $this->db->select("td.tab_provincia_idtab_provincia, tr.prov_nombre");
        $this->db->from("tab_direcciones td, tab_provincia tr");
        $this->db->where('td.tab_provincia_idtab_provincia = tr.idtab_provincia');
        $this->db->where('tab_clientes_idtab_clientes', $this->session->userdata('id_cliente'));
        $query = $this->db->get();

        if ($query) {
            return $query->row();
        }  else {
            return FALSE;
        }
    }

    public function select_provincias($id_region) {

        $this->db->where('tab_region_idtab_region', $id_region);
        $this->db->order_by('prov_nombre', 'asc');
        $query = $this->db->get('tab_provincia');

        return $query->result();
    }

    public function select_comunas($id_provincia) {
        $this->db->where('tab_provincia_idtab_provincia', $id_provincia);
        $this->db->order_by('com_nombre', 'asc');
        $query = $this->db->get('tab_comuna');

        return $query->result();
    }
    
    public function ActualizarDatos($id_cliente,$rut,$nombre,$apellido,$contacto1,$contacto2){
        
        $arr = array(
            'cli_nombre' => $nombre,
            'cli_rut'   => $rut,
            'cli_apellido' => $apellido,
            'cli_fono1' => $contacto1,
            'cli_fono2' => $contacto2
        );
        
        $ok = $this->db->update('tab_clientes', $arr,array('idtab_clientes' => $id_cliente));
        
        if($ok){
            return TRUE;
        }else{
            return FALSE;
        }
        
    }

}
