<?php

namespace application\core;

use ReflectionClass;

class Router{
      protected $_splits;
      protected $_controller, $_action, $_params=null;
      protected $_prefix=null;

      public function __construct(){
        $request =  trim(urldecode(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)), '/');
        $this->_splits=explode('/',$request);
        if($this->_splits[0]=='admin'){
            $this->_prefix=$this->_splits[0];
            $this->_controller = !empty($this->_splits[1]) ? ucfirst($this->_splits[1]) . 'Controller' : ucfirst($this->_prefix).'Controller';
            //Action
            $this->_action = !empty($this->_splits[2]) ? $this->_splits[2] . 'Action' : 'indexAction';
            //Есть ли параметры и их значения?
            if (!empty($this->_splits[3])) {
                $keys = $values = [];
                for ($i = 3, $cnt = count($this->_splits); $i < $cnt; $i++) {
                    if ($i % 2 != 0) {
                        //Чётное = ключ (параметр)
                        $keys[] = $this->_splits[$i];
                    } else {
                        //Значение параметра;
                        $values[] = $this->_splits[$i];
                    }
                }
                $this->_params = array_combine($keys, $values);
            }

        }else {
            //Controller
            $this->_controller = !empty($this->_splits[0]) ? ucfirst($this->_splits[0]) . 'Controller' : 'HomeController';

            //Action
            $this->_action = !empty($this->_splits[1]) ? $this->_splits[1] . 'Action' : 'indexAction';
            //Есть ли параметры и их значения?
            if (!empty($this->_splits[2])) {
                $keys = $values = [];
                for ($i = 2, $cnt = count($this->_splits); $i < $cnt; $i++) {
                    if ($i % 2 == 0) {
                        //Чётное = ключ (параметр)
                        $keys[] = $this->_splits[$i];
                    } else {
                        //Значение параметра;
                        $values[] = $this->_splits[$i];
                    }
                }
                $this->_params = array_combine($keys, $values);
            }
        }
      }

      public function route() {
        if(class_exists($this->getController())) {
          $rc = new ReflectionClass($this->getController());
            if($rc->hasMethod($this->getAction())) {
                if($this->_splits[0]=='admin' && empty($this->_splits[1])) {
                    $controller = $rc->newInstance('Admin', $this->getParams());
                }elseif(!empty($this->_splits[0])){
                    $controller = $rc->newInstance($this->_prefix ? $this->_splits[1] : $this->_splits[0], $this->getParams());
                }else{
                    $controller = $rc->newInstance('Home',$this->getParams());
                }
              $method = $rc->getMethod($this->getAction());
              $method->invoke($controller);
            } else {
                echo "Wrong Action";
                include 'application/views/error/404.php';exit;
            }
        } else {
            echo "Wrong Controller";
            include 'application/views/error/404.php';exit;

        }
      }

      public function getParams() {
        return $this->_params;
      }
      public function getController() {
          if($this->_prefix){
              return 'application\controllers\\'.$this->_prefix.'\\' . $this->_controller;
          }else {
              return 'application\controllers\\' . $this->_controller;
          }
      }
      public function getAction() {
        return $this->_action;
      }
}	