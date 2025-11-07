<?php

namespace Src\Middleware;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AdminMiddleware
{
    public function __construct(protected ResponseFactoryInterface $responseFactory)
    {

    }
    public function __invoke(
        RequestInterface $request,
        RequestHandlerInterface $handler
    )
    {   $response = $this->responseFactory->createResponse();
        if (isset($_SESSION['user_id'])) {

            $user = ORM::forTable('users')->findOne($_SESSION['user_id']);
            if(!$user['is_admin']){
                return $response->withHeader('Location', '/catalog')->withStatus( 302);
            }
            return $handler->handle($request);
        }
        return $response->withHeader('Location', '/login')->withStatus( 302);
    }

}