<?php

namespace application\controllers;

use application\controllers\BaseController;


class UserController extends BaseController
{
    protected $body = 'register_view.php';

    public function registration(){

        if($this->isAjax()){

            $this->postClear();

            $this->model->newUserRegistr($_POST);

            echo json_encode(['refer' => '/']);
            exit;

        }
        $obj = RouteController::getInstance();

        $result = $this->render('register_view.php', 'template_view.php');

        $obj->setBody($result);
    }

    public function logout(){

        if(isset($_SESSION['guest'])){

            unset($_SESSION['guest']);

            setcookie("remember", time() - 3600, '/');
        }


       header("Location:/");

        exit;

    }

    public function login(){

        if($this->isAjax()){

            $this->postClear();

            $this->model->checkLogin($_POST);

            echo json_encode(['refer' => $_SERVER['HTTP_REFERER']]);

            exit;

        }
        $obj = RouteController::getInstance();

        $result = $this->render('login_view.php', 'template_view.php');

        $obj->setBody($result);

    }





}