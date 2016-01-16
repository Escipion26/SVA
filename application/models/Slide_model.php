<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slide_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
   public function traer_contenido_slide($tipo){
       
       $query = $this->db->query("SELECT dis_titulo, "
               . "dis_descripcion, "
               . "dis_ruta, "
               . "dis_id_producto "
               . "FROM tab_dis_img "
               . "where dis_lugar = '".$tipo."';");
       
       if($query){
           return $query->result();
       }
   }
   
   public function traer_contenido_recomendado($tipo){
       
       $query = $this->db->query('select tp.prod_precio_venta as precio_venta, tp.prod_descripcion as descripcion, tp.idtab_productos as id_producto, ti.dis_ruta as ruta from tab_productos tp join tab_dis_img ti on tp.idtab_productos = ti.dis_id_producto where ti.dis_lugar = "'.$tipo.'"');
       
       if($query){
           return $query->result();
       }
   }
   
   public function traer_categorias($valor){
       $query;
       
       if($valor == 1){
           $query = $this->db->get('tab_categorias');
       }elseif($valor == 2){
           $query = $this->db->get('tab_sub_categorias');
       }
       
       if($query){
           return $query->result();
       }
       
   }
}