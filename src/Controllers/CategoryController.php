<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class CategoryController extends Controller
{
    // Вывод всех категорий
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $categories = ORM::forTable('categories')
            ->tableAlias('c')
            ->select('c.*')
            ->select('p.name', 'parent_name')
            ->leftOuterJoin('categories', 'p.id = c.parent_category', 'p')
            ->findMany();
        return $this->renderer->render($response, 'categories/index.php', [
            'categories' => $categories
        ]);
    }

    // Форма добавления
    public function create(RequestInterface $request, ResponseInterface $response)
    {
        $categories = ORM::forTable('categories')->findArray();
        return $this->renderer->render($response, "categories/create.php", [
            "categories" => $categories
        ]);
    }

    // Обработка добавления
    public function store(RequestInterface $request, ResponseInterface $response)
    {
        $name = $request->getParsedBody()['name'];
        $parent_category = $request->getParsedBody()['parent_category'] === '' ? null : $request->getParsedBody()['parent_category'];
        $slug = $request->getParsedBody()['slug'] !== '' ? $request->getParsedBody()['slug'] : null;

        $category = ORM::forTable('categories')->create(
            [
                'name' => $name,
                'parent_category' => $parent_category,
                'slug' => $slug
            ]);
        $category->save();
        return $response->withHeader('Location', '/categories')->withStatus(302);
    }

    // Форма редактирование
    public function edit(RequestInterface $request, ResponseInterface $response, array $args)
    {
        // ID категории
        $slug = $args['slug'];
        $category= ORM::forTable('categories')->where('slug', $slug)->findOne();
        $categories = ORM::forTable('categories')->findMany();
        return $this->renderer->render($response, 'categories/edit.php', ['category'=>$category, 'categories'=>$categories]);
    }

    // Обработка редактирование
    public function update(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $slug = $args['slug'];
        $category= \ORM::forTable('categories')->where('slug', $slug)->findOne();
        $name=$request->getParsedBody()['name'];
        $parent_category = $request->getParsedBody()['parent_category'] === '' ? null : $request->getParsedBody()['parent_category'];
        $newSlug = $request->getParsedBody()['slug'] !== '' ? $request->getParsedBody()['slug'] : null;
        $category->set([
            'name' => $name,
            'parent_category' => $parent_category,
            'slug' => $newSlug
        ])->save();
        return $response->withHeader('Location', '/categories')->withStatus(302);
    }

    // Удаление
    public function delete(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $slug = $args['slug'];
        ORM::forTable('categories')->where('slug', $slug)->findOne()->delete();
        return $response->withHeader('Location', '/categories')->withStatus(302);
    }
}