<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productores_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id = null)
    {
        if (!is_null($id)) {
            $query = $this->db->select('*')->from('productores')->where('idproductor', $id)->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }

            return null;
        }

        $query = $this->db->select('*')->from('productores')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return null;
    }

    public function save($idcanton, $idcontacto, $idactividad, $nombre, $descripcion, $portada, $fecha_registro, $longitud, $latitud, $direccion)
    {
        $this->db->set($this->_setProductores(0, $idcanton, $idcontacto, $idactividad, $nombre, $descripcion, $portada, $fecha_registro, $longitud, $latitud, $direccion))->insert('productores');

        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }

        return null;
    }

    public function update($idproductor, $idcanton, $idcontacto, $idactividad, $nombre, $descripcion, $portada, $fecha_registro, $longitud, $latitud, $direccion)
    {
        $this->db->set($this->_setProductores($idproductor, $idcanton, $idcontacto, $idactividad, $nombre, $descripcion, $portada, $fecha_registro, $longitud, $latitud, $direccion))->where('idproductor', $idproductor)->update('productores');

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    public function delete($id)
    {
        $this->db->where('idproductor', $id)->delete('productores');

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    private function _setProductores($idproductor, $idcanton, $idcontacto, $idactividad, $nombre, $descripcion, $portada, $fecha_registro, $longitud, $latitud, $direccion)
    {
        return array(
            'idproductor' => $idproductor,
            'idcanton' => $idcanton,
            'idcontacto' => $idcontacto,
            'idactividad' => $idactividad,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'portada' => $portada,
            'fecha_registro' => $fecha_registro,
            'longitud' => $longitud,
            'latitud' => $latitud,
            'direccion' => $direccion
        );
    }
}
