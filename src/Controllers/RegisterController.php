<?php

namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RegisterController extends Controller
{
    public function setLayout():void
    {

    }
    public function registerPage(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderer->render($response, 'auth/register.php');
    }
    public  function register(RequestInterface $request, ResponseInterface $response)
    {
        $login = $request->getParsedBody()['login'];
        $password = $request->getParsedBody()['password'];

        $user = \ORM::forTable('users')->where('login', $login)->findOne(); //

        if($user) {
            return $response->withStatus(302)->withHeader('Location', '/register');
        }

        $user = \ORM::forTable('users')->create();
        $user->login = $login;
        $user->password = $password;
        $user->save();
        echo 1;
        exit();

    }
}