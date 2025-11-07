<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ApplicationController extends Controller
{
    public function setLayout():void
    {

    }
    public function create(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];
        return $this->renderer->render($response, 'applications/create.php',[
            'product_id' => $id
        ]);

    }

    public function store(RequestInterface $request, ResponseInterface $response, array $args)
    {
    $quantity_days = $request->getParsedBody()['quantity_days'];
    $phone_number = $request->getParsedBody()['phone_number'];
    if(!empty($_SESSION['user_id']))
    {
        $applications = ORM::forTable('applications')->create(
            [
                'user_id' => $_SESSION['user_id'],
                'products_id' => $args['id'],
                'quantity_days' => $quantity_days,
                'phone_number' => $phone_number
            ]);
        $applications->save();
        return $response->withHeader('Location', '/catalog')->withStatus(302);
    }
        return $response->withHeader('Location', '/login')->withStatus(302);
    }

    public function edit(RequestInterface $request, ResponseInterface $response, array $args)
    {

    }

    public function update(RequestInterface $request, ResponseInterface $response, array $args)
    {

    }

}