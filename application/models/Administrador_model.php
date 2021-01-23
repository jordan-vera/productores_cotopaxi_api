<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrador_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id)
    {
        if (!is_null($id)) {
            $query = $this->db->select('*')->from('administrador')->where('idadmin', $id)->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            }

            return null;
        }
    }

    public function login($usuario, $clave)
    {
        $array = array('user' => urldecode($usuario), 'clave' => $clave);
        $query = $this->db->select('*')->from('administrador')->where($array)->get();
        if ($query->num_rows() === 1) {
            return $query->row_array();
        }

        return null;
    }
}
