<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Actividades_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($idactividad = null)
    {
        if (!is_null($idactividad)) {
            $query = $this->db->select('*')->from('actividades')->where('idactividad', $idactividad)->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }

        $query = $this->db->select('*')->from('actividades')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return null;
    }

    public function save($descripcion)
    {
        $this->db->set($this->_setActividades($descripcion))->insert('actividades');

        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }

        return null;
    }


    public function delete($idactividad)
    {
        $this->db->where('idactividad', $idactividad)->delete('actividades');

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    private function _setActividades($descripcion)
    {
        return array(
            'descripcion' => $descripcion,
        );
    }
}
