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
       
       $query = $this->db->query("select ;");
       
       if($query){
           return $query->result();
       }
   }
}