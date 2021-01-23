<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galeria_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id)
    {
        if (!is_null($id)) {
            $query = $this->db->select('*')->from('galeria_productores')->where('idproductor', $id)->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }

            return null;
        }
    }

    public function save($idproductor, $imagen)
    {
        $this->db->set($this->_setGaleria($idproductor, $imagen))->insert('galeria_productores');

        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }

        return null;
    }

    public function delete($id)
    {
        $this->db->where('idgaleria', $id)->delete('galeria_productores');

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    private function _setGaleria($idproductor, $imagen)
    {
        return array(
            'idproductor' => $idproductor,
            'imagen' => $imagen,
        );
    }
}
