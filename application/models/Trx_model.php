<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trx_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function traer_producto($id_producto) {

        $this->db->where('idtab_productos', $id_producto);

        $query = $this->db->get('tab_productos');

        return $query->row();
    }

    public function traer_direcciones($id_cliente) {
        $this->db->select(""
                . "td.idtab_direcciones,"
                . "td.dir_nombre,"
                . "td.dir_direccion,"
                . "tr.reg_nombre,"
                . "tp.prov_nombre,"
                . "tc.com_nombre");
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
    
    public function traer_transacciones($id_cliente){
        
        
        
        $this->db->select('tc.cot_numero_cotizacion, tc.cot_fecha, cot_total, tec.es_descripcion');
        $this->db->from('tab_cotizacion tc, tab_estado_cotizacion tec');
        $this->db->where('tab_clientes_idtab_clientes',$id_cliente);
        $this->db->where('tc.tab_estado_cotizacion_idtab_estado_cotizacion = idtab_estado_cotizacion');
        $data = $this->db->get();
        
        return $data->result();
        
        
    }

    public function terminar_compra($numero_orden, $id_direccion) {

        $carrito = $this->cart->contents();

        $arr = array(
            'cot_numero_cotizacion' => $numero_orden,
            'cot_fecha' => date('Y-m-d'),
            'cot_total' => $this->cart->total(),
            'tab_estado_cotizacion_idtab_estado_cotizacion' => 1,
            'tab_clientes_idtab_clientes' => $this->session->userdata('id_cliente'),
            'tab_direcciones_idtab_direcciones' => $id_direccion
        );

        $query = $this->db->insert('tab_cotizacion', $arr);

        if ($query) {

            foreach ($carrito as $row) {

                $datos = array(
                    'tab_numero_cotizacion' => $numero_orden,
                    'tab_id_producto' => $row['options'],
                    'tab_cantidad_compra' => $row['qty'],
                    'tab_precio_compra' => $row['subtotal']
                );

                $this->db->insert('tab_detalle_cotizacion', $datos);
            }
            
            return TRUE;
        }else{
            return FALSE;
        }
    }

}
