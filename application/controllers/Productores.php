<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

class Productores extends REST_Controller
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

        $this->load->model('productores_model');
    }

    public function index_get()
    {
        $datos = $this->productores_model->get();

        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'No hay productores en la base de datos...'), 404);
        }
    }

    public function find_get($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }
        $datos = $this->productores_model->get($id);

        if (!is_null($datos)) {
            $this->response(array('response' => $datos), 200);
        } else {
            $this->response(array('error' => 'productor no encontrado...'), 404);
        }
    }

    public function index_post()
    {
        $params = json_decode(file_get_contents('php://input'));

        $idcanton = $params->idcanton;
        $idcontacto = $params->idcontacto;
        $idactividad = $params->idactividad;
        $nombre = $params->nombre;
        $descripcion = $params->descripcion;
        $portada = $params->portada;
        $fecha_registro = $params->fecha_registro;
        $longitud = $params->longitud;
        $latitud = $params->latitud;
        $direccion = $params->direccion;

        $file = base64_decode($params->file);

        $id = $this->productores_model->save($idcanton, $idcontacto, $idactividad, $nombre, $descripcion, $portada, $fecha_registro, $longitud, $latitud, $direccion);

        $filePath = $_SERVER['DOCUMENT_ROOT'] . "/archivosProductores/" . $portada;
        file_put_contents($filePath, $file);

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

        $delete = $this->productores_model->delete($id);

        if (!is_null($delete)) {
            $this->response(array('response' => 'done'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }

    //Update
    public function index_put($anterior)
    {
        $params = json_decode(file_get_contents('php://input'));

        $idproductor = $params->idproductor;
        $idcanton = $params->idcanton;
        $idcontacto = $params->idcontacto;
        $idactividad = $params->idactividad;
        $nombre = $params->nombre;
        $descripcion = $params->descripcion;
        $portada = $params->portada;
        $fecha_registro = $params->fecha_registro;
        $longitud = $params->longitud;
        $latitud = $params->latitud;
        $direccion = $params->direccion;

        $file = urldecode($params->file);
        if ($file == 'vacio') {
            $update = $this->productores_model->update($idproductor, $idcanton, $idcontacto, $idactividad, $nombre, $descripcion, $portada, $fecha_registro, $longitud, $latitud, $direccion);
        } else {
            $anterior = $params->anterior;
            $update = $this->productores_model->update($idproductor, $idcanton, $idcontacto, $idactividad, $nombre, $descripcion, $portada, $fecha_registro, $longitud, $latitud, $direccion);
            $filePath = $_SERVER['DOCUMENT_ROOT'] . "/archivosProductores/" . $portada;
            file_put_contents($filePath, $file);

            $filePath2 = $_SERVER['DOCUMENT_ROOT'] . "/archivosProductores/" . urldecode($anterior);
            unlink($filePath2);
        }

        if (!is_null($update)) {
            $this->response(array('response' => 'hotel actualizado!'), 200);
        } else {
            $this->response(array('error', 'Algo se ha roto en el servidor...'), 400);
        }
    }
}
