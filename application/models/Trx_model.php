<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Trx_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        
    }
    
    
    public function traer_producto($id_producto) {
        
        $this->db->where('idtab_productos',$id_producto);
        
        $query = $this->db->get('tab_productos');
        
        return $query->row();
        
        
    }
    
    
    

}
