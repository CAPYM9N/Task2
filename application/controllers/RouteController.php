<?php

namespace application\controllers;

use application\controllers\IndexController;
use application\controllers\UserController;

class RouteController
{
    protected $split;
    protected $_controller;
    protected $_method;
    protected $_body;
    protected  static $_instance;

    public static function getInstance() {
        if(!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    private function __construct(){
        $request = $_SERVER['REQUEST_URI'];

        $this->split = explode('/',trim($request, '/'));

        $this->_controller = !empty($this->split[0]) ? ucfirst($this->split[0]).'Controller':'IndexController';

        $this->_method = !empty($this->split[1]) ? $this->split[1] : 'indexAction';
    }

    public function route(){


            $object = new \ReflectionClass($this->getController());

            if($object->hasMethod($this->getMethods())){

                if(!empty($this->split[0])){

                    $class_name = $this->getController();

                    $controller = $object->newInstance(new $class_name);

                }else{

                    $controller = $object->newInstance(new IndexController());
                }

                $method = $object->getMethod($this->getMethods());

                $method->invoke($controller);

            }else{
                throw new \Exception("doesn`t exist metod");
            }

    }

    public function getController(){
        return "application\controllers\\".$this->_controller;
    }
    public function getMethods(){
        return $this->_method;
    }
    public function setBody($body){
        $this->_body=$body;
    }
    public function getBody(){
       return $this->_body;
    }



}