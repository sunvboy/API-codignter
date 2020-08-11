<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends REST_Controller {
    //GET API
    public function index_get(){
        if(!empty($_GET['limit'])){
            $object = $this->Autoload_Model->_get_where(array(
                'select' => 'id,title,created,description,viewed',
                'table' => 'article',
                'order_by' => 'id desc',
                'limit' => $_GET['limit'],
                'where' => array('publish' => 0),
            ),TRUE);
        }else{
            $object = $this->Autoload_Model->_get_where(array(
                'select' => 'id,title,created,description,viewed',
                'table' => 'article',
                'order_by' => 'id desc',
                'where' => array('publish' => 0),
            ),TRUE);
        }
        if(count($object) > 0){
            $this->response(array(
                "status" => 00,
                "message" => "Success",
                "data" => $object
            ), REST_Controller::HTTP_OK);
        }else{

            $this->response(array(
                "status" => 01,
                "message" => "Error",
                "data" => $object
            ), REST_Controller::HTTP_NOT_FOUND);
        }

    }




}