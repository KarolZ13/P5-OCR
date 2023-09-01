<?php

namespace src\controllers;

use Models\User;

class UserController extends MainController {

    public function login() 
    {
        return $this->view('blog.login');
    }

    public function signIn() 
    {
        $user = (new User($this->getDB()))->getByEmail($_POST['email']);
        
        var_dump($user);
    }
}