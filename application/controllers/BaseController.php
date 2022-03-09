<?php

namespace application\controllers;

use application\controllers\RouteController;
use application\models\User;

class BaseController
{
    use Validation;
    protected $model;

    public function __construct(){
        $this->model = new User();

        if(isset($_COOKIE["remember"]) && !empty($_COOKIE["remember"])){


            $data = $this->model->getUser($_COOKIE["remember"]);

            if ($data) $_SESSION['guest'] = $data;
        }
    }



    protected function render($content_view, $template_view, $data = null){

        ob_start();
        include 'application/views/'.$template_view;
        return ob_get_clean();

    }

    protected function isAjax(){
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }



}