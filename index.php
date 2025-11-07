<?php

use DI\Container;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Views\PhpRenderer;
use Src\Controllers\Admin\HomeController;
use Src\Controllers\ApplicationController;
use Src\Controllers\CategoryController;
use Src\Controllers\GoodsController;
use Src\Controllers\LoginController;
use Src\Controllers\ProductController;
use Src\Controllers\RegisterController;
use Src\Controllers\UserController;
use Src\Middleware\AdminMiddleware;
use Src\Middleware\AuthMiddleware;

require __DIR__ . '/vendor/autoload.php';

$container = new Container();
AppFactory::setContainer($container);
$app = AppFactory::create();

session_start();

$container->set(PhpRenderer::class, function () use ($container) {
    return new PhpRenderer(
        __DIR__ . '/templates',
        [
            'layoutCategories' => ORM::forTable('categories')->whereNull('parent_category')->findMany(),
        ]
    );
});

ORM::configure('mysql:host=database;dbname=docker');
ORM::configure('username', 'root');
ORM::configure('password', 'tiger');

$app->get('/login', [LoginController::class, 'loginPage']);
$app->get('/register', [RegisterController::class, 'registerPage']);
$app->post('/auth/login', [LoginController::class, 'login']);
$app->post('/auth/register', [RegisterController::class, 'register']);
$app->get('/logout', [ProductController::class, 'logout']);

$app->get('/catalog', [ProductController::class, 'index']);
$app->get('/catalog/{slug}', [ProductController::class, 'categoryPage']);
$app->get('/applications/{id}/create', [ApplicationController::class, 'create']);
$app->post('/applications/{id}/create', [ApplicationController::class, 'store']);
$app->get('/applications/{id}/edit', [ApplicationController::class, 'edit']);
$app->get('/applications/{id}/update', [ApplicationController::class, 'update']);

$app->group('/', function () use ($app) {
    $app->get('/products', [GoodsController::class, 'index']);
    $app->get('/products/create', [GoodsController::class, 'create']);
    $app->post('/products/create', [GoodsController::class, 'store']);
    $app->get('/products/{id}/edit', [GoodsController::class, 'edit']);
    $app->post('/products/{id}/edit', [GoodsController::class, 'update']);
    $app->get('/products/{id}/delete', [GoodsController::class, 'delete']);
    $app->get('/products/{id}', [GoodsController::class, 'show']);

    $app->get('/categories', [CategoryController::class, 'index']);
    $app->get('/categories/create', [CategoryController::class, 'create']);
    $app->post('/categories/create', [CategoryController::class, 'store']);
    $app->get('/categories/{slug}/edit', [CategoryController::class, 'edit']);
    $app->post('/categories/{slug}/edit', [CategoryController::class, 'update']);
    $app->get('/categories/{slug}/delete', [CategoryController::class, 'delete']);
    $app->get('/profile', [UserController::class, 'profile']);
})->add(new AuthMiddleware($container->get(ResponseFactory::class)));

$app->group('/', function () use ($app) {
    $app->get('/admin', [HomeController::class, 'index']);
})->add(new AdminMiddleware($container->get(ResponseFactory::class)));

$app->run();

// в админке возможность просматривать эти заявки на бронирование и изменять им статус
// добавить характеристики у товара