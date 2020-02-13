<?php

namespace application\core;
class Controller{

    public $view;
    public $params;

    public function __construct($model,$param) {
        $this->view=$this->loadModel($model);
        $this->params=$param;
    }

    public function loadModel($name) {
        $path = 'application\models\\'.ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }


    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
    public function redirect($url) {
        header('location: '.$url);
        exit;
    }
    public function render($content_view, $template_view, $data = null){
        ob_start();
        include 'application/views/layouts/'.$template_view;
        return ob_get_clean();
    }

}