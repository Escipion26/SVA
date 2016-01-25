<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

Class Account_model extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function traer_cliente($id_cliente){
        
        $this->db->select("cli_rut, cli_nombre, cli_apellido, cli_correo, cli_fono1, cli_fono2 ");
        $this->db->from('tab_clientes');
        $this->db->where('idtab_clientes',$id_cliente);
        
        
        $query = $this->db->get();
        
        if($query){
            return $query->row();
        }else{
            return FALSE;
        }
        
        
        
    }
    
    
}