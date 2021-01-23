<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Galeria extends REST_Controller
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

        $this->load->model('galeria_model');
    }

    public function find_get($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }
        $datos = $this->galeria_model->get($id);

        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'imagenes no encontrada...'), 200);
        }
    }

    public function index_post()
    {
        $params = json_decode(file_get_contents('php://input')); 

        $idproductor = $params->idproductor;     
        $imagen = $params->imagen;        
        $file = base64_decode($params->file);          

        $id = $this->galeria_model->save($idproductor, $imagen);

        $filePath = $_SERVER['DOCUMENT_ROOT'] . "/archivosProductores/" . $imagen; 
        file_put_contents($filePath, $file); 

        if (!is_null($id)) {
            $this->response(array('response' => $id), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 200);
        }
    }

    public function index_delete($id, $nombre)
    {
        $delete = $this->galeria_model->delete($id);

        $filePath = $_SERVER['DOCUMENT_ROOT'] . "/archivosProductores/" . $nombre;
        unlink($filePath);

        if (!is_null($delete)) {
            $this->response(array('response' => 'done'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 200);
        }
    }
}
