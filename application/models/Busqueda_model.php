<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Busqueda_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function traer_productos($categoria, $subcategoria) {
        $this->db->select('tp.prod_precio_venta as precio_venta, tp.prod_descripcion as descripcion, tp.idtab_productos as id_producto, ti.img_ruta as ruta');
        $this->db->from('tab_productos tp, tab_imagen ti');
        $this->db->where('tp.idtab_productos = ti.tab_productos_idtab_productos');
        $this->db->where('tab_categorias_idtab_categorias', $categoria);
        $this->db->where('tab_sub_categorias_idtab_sub_categorias', $subcategoria);

        $query = $this->db->get();

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    public function nombre_categoria($id) {
        
        $this->db->where('idtab_categorias',$id);
        $query = $this->db->get('tab_categorias');
        
        return $query->row();
        
    }
    
    
    public function ver_producto($id_producto){
        $this->db->select('tp.prod_sku,tp.prod_stock,tp.prod_precio_venta, tp.prod_nombre, tp.idtab_productos, ti.img_ruta');
        $this->db->from('tab_productos tp, tab_imagen ti');
        $this->db->where('tp.idtab_productos',$id_producto);
        $this->db->where('tp.idtab_productos = tab_productos_idtab_productos');
        $query = $this->db->get();
        
        if($query){
            return $query->row();
        }else{
            return FALSE;
        }
        
        
    }

}
