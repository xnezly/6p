<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GoodsController extends Controller
{

    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $products = ORM::forTable('products')
            ->select('products.*')
            ->select('categories.name', 'category_name')
            ->leftOuterJoin('categories', 'products.category_id = categories.id')
            ->findArray();
        return $this->renderer->render($response, '/products/index.php', [
            'products' => $products
        ]);
    }
    public function create(RequestInterface $request, ResponseInterface $response)
    {
        $categories = ORM::forTable('categories')->findArray();
        $products = ORM::forTable('products')->findArray();
        return $this->renderer->render($response, "products/create.php", [
            "products" => $products,
            "categories" => $categories
        ]);
    }
    public function store(RequestInterface $request, ResponseInterface $response)
    {
        $uploadedFiles = $request->getUploadedFiles();
        $name = $request->getParsedBody()['name'];
        $price = $request->getParsedBody()['price'];

        $img = $uploadedFiles['img'] ?? null;
        $imgPath = null;

        if ($img && $img->getError() === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../uploads';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $filename = uniqid() . '_' . $img->getClientFilename();
            $imgPath = 'uploads/' . $filename;
            $img->moveTo($uploadDir . '/' . $filename);
        }

        $category_id = $request->getParsedBody()['category_id'] === '' ? null : $request->getParsedBody()['category_id'];

        $products = ORM::forTable('products')->create(
            [
                'name' => $name,
                'price' => $price,
                'img' => $imgPath,
                'category_id' => $category_id
            ]);
        $products->save();
        return $response->withHeader('Location', '/products')->withStatus(302);
    }

    public function edit(RequestInterface $request, ResponseInterface $response, array $args)
    {
        // ID категории
        $id = $args['id'];
        $product= ORM::forTable('products')->findOne($id);
        $categories = ORM::forTable('categories')->findMany();

        $productArray = $product->asArray();
        $categoriesArray = [];
        foreach ($categories as $category) {
            $categoriesArray[] = $category->asArray();
        }
        return $this->renderer->render($response, 'products/edit.php', [
            'product' => $productArray,
            'categories' => $categoriesArray
        ]);
    }

    public function update(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];
        $product= ORM::forTable('products')->findOne($id);

        $name=$request->getParsedBody()['name'];
        $price=$request->getParsedBody()['price'];

        $uploadedFiles = $request->getUploadedFiles();
        $img = $uploadedFiles['img'] ?? null;
        $imgPath = null;

        if ($img && $img->getError() === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../uploads';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $filename = uniqid() . '_' . $img->getClientFilename();
            $imgPath = 'uploads/' . $filename;
            $img->moveTo($uploadDir . '/' . $filename);
        }

        $category_id = $request->getParsedBody()['category_id'] === '' ? null : $request->getParsedBody()['category_id'];
        $product->set([
            'name' => $name,
            'price' => $price,
            'img' => $imgPath,
            'category_id' => $category_id
        ])->save();
        return $response->withHeader('Location', '/products')->withStatus(302);
    }


    public function delete(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];
        ORM::forTable('products')->findOne($id)->delete();
        return $response->withHeader('Location', '/products')->withStatus(302);
    }

    public function show(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];
        $product = ORM::forTable('products')->findOne($id);
        return $this->renderer->render($response, 'products/show.php', [
            'product' => $product
        ]);
    }
}