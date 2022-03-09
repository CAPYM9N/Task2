<?php

namespace application\models;

class User
{
    public function newUserRegistr($data){
        $users = $this->getUsers();
        $users[] = $data;

        file_put_contents('users.json', json_encode($users, JSON_FORCE_OBJECT));

        $_SESSION['result']['success'] = 'Вы успешно зарегистрировались';
        $_SESSION['guest'] = $data['login'];

        return true;
    }
    public function getUsers(){

        return json_decode(file_get_contents('users.json'), true) ?: [];
    }

    public function checkUser($item, $field){

        if(file_exists('users.json')){

            $users = $this->getUsers();

            foreach ($users  as $key => $data){
                if($data[$field] === $item) return true;
            }

            return false;
        }
    }

    public function checkLogin($data){

        $users = $this->getUsers();
        foreach ($users as $key => &$value){

            if($data['aut_login'] === $value['login']){

                if($data['aut_password'] === $value['password']){

                    if($data['remember']){

                        $value['remember']=md5($value['email'].'uF4ryDp2');

                        setcookie("remember", $value['remember'], time() + (1000 * 60 * 60 * 24 * 30));

                        file_put_contents('users.json', json_encode($users, JSON_FORCE_OBJECT));

                        $_SESSION['result']['success'] = 'Вы успешно авторизовались';
                        $_SESSION['guest'] = $value['login'];
                        return true;

                    }

                    $_SESSION['result']['success'] = 'Вы успешно авторизовались';
                    $_SESSION['guest'] = $value['login'];
                    return true;

                }else{

                    $_SESSION['result']['warning']['aut_password'] = 'Неправильный пароль';

                    return false;

                }

            }

        }

        $_SESSION['result']['warning']['aut_login'] = 'Такого логина не существует';

        return false;

    }

    public function getUser($cookie){

        $users = $this->getUsers();
            if($users) {
                foreach ($users as $key => $value) {

                    if ($value['remember'] === $cookie) {

                        return $value['login'];

                    }
                }
            }
        return false;
    }

}