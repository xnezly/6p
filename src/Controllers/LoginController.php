<?php

namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class LoginController extends Controller
{
    public function setLayout(): void
    {

    }
    public function loginPage(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderer->render($response, '/auth/login.php');
    }

    public  function login(RequestInterface $request, ResponseInterface $response)
    {
        $login = $request->getParsedBody()['login'];
        $password = $request->getParsedBody()['password'];

        $user = \ORM::forTable('users')->where('login', $login)->findOne();

        if (!$user) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        if ($user['password'] !== $password) {
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        $_SESSION ['user_id'] = $user['id'];

        return $response
            ->withHeader('Location', '/catalog')
            ->withStatus(302);
    }
}