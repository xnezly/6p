<?php

namespace Src\Controllers\Admin;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Src\Controllers\Controller;

class HomeController extends Controller
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $applications = ORM::forTable('applications')->findMany();
        return $this->renderer->render($response, 'admin/index.php', [
            'applications' => $applications
        ]);
    }
}