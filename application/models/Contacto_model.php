<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contacto_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($idcontacto)
    {
        if (!is_null($idcontacto)) {
            $query = $this->db->select('*')->from('contacto_productores')->where('idcontacto', $idcontacto)->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }

    public function save($telefono, $celular, $email)
    {
        $this->db->set($this->_setContacto(0, $telefono, $celular, $email))->insert('contacto_productores');

        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }

        return null;
    }

    public function update($idcontacto, $telefono, $celular, $email)
    {
        $this->db->set($this->_setContacto($idcontacto, $telefono, $celular, $email))->where('idcontacto', $idcontacto)->update('contacto_productores');

        if ($this->db->affected_rows() === 1) {
            return true;
        }
        return null;
    }

    public function delete($id)
    {
        $this->db->where('idcontacto', $id)->delete('contacto_productores');

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    private function _setContacto($idcontacto, $telefono, $celular, $email)
    {
        return array(
            'idcontacto' => $idcontacto,
            'telefono' => $telefono,
            'celular' => $celular,
            'email' => $email
        );
    }
}
