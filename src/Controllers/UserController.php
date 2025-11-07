<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class UserController extends Controller
{
    public function profile(RequestInterface $request, ResponseInterface $response)
    {
        $applications = ORM::forTable('applications')
            ->select('applications.*')
            ->select('products.name', 'products_name')
            ->select('status.name', 'status_name')
            ->leftOuterJoin('products', 'products.id=applications.products_id')
            ->leftOuterJoin('status', 'status.id=applications.status_id')
            ->where('user_id', $_SESSION['user_id'])
            ->findArray();
        return $this->renderer->render($response, 'profile.php', [
            'applications' => $applications
        ]);
}
}