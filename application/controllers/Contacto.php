<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Contacto extends REST_Controller
{
    public function __construct($config = 'rest')
    {
        parent::__construct($config);
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }

        $this->load->model('contacto_model');
    }

    public function find_get($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }
        $datos = $this->contacto_model->get($id);

        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'Tipo no encontrado...'), 404);
        }
    }

    public function index_post()
    {
        $params = json_decode(file_get_contents('php://input'));

        $telefono = $params->telefono;
        $celular = $params->celular;
        $email = $params->email;

        $id = $this->contacto_model->save($telefono, $celular, $email);

        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function index_delete($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }

        $delete = $this->contacto_model->delete($id);

        if (!is_null($delete)) {
            $this->response(array('response' => 'done'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    public function index_put()
    {
        $idcontacto = $this->post('idcontacto');
        $telefono = $this->post('telefono');
        $celular = $this->post('celular');
        $email = $this->post('email');

        if (!$idcontacto) {
            $this->response(null, 400);
        }

        $update = $this->contacto_model->update($idcontacto, $telefono, $celular, $email);

        if (!is_null($update)) {
            $this->response(array('response' => 'tipo actualizado!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}
