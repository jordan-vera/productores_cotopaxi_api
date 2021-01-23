<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Administrador extends REST_Controller
{
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }

        $this->load->model('administrador_model');
    }

    public function login_get($user, $clave)
    {
        $datos = $this->administrador_model->login($user, $clave);

        if (!is_null($datos)) {
            $this->response(array('response' => 'done', 'idadmin' => $datos['idadmin']), 200);
        } else {
            $this->response(array('error' => 'No hay usuarios en la base de datos...'), 200);
        }
    }

    public function find_get($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }
        $datos = $this->administrador_model->get($id);

        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'Usuario no encontrado...'), 200);
        }
    }




}
