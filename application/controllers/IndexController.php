<?php

namespace application\controllers;

use application\controllers\BaseController;

class IndexController extends BaseController
{


    public function indexAction(){

        $obj = RouteController::getInstance();

        $result = $this->render('index_view.php', 'template_view.php');

        $obj->setBody($result);
    }


}