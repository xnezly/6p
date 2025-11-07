<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ProductController extends Controller
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $products = ORM::forTable('products')->findArray();
        return $this->renderer->render($response, 'catalog.php', [
            'products' => $products,
            'title' => 'Каталог'
        ]);
    }

    public function categoryPage(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $slug = $args['slug'];
        $category = ORM::forTable('categories')->where('slug', $slug)->findOne();

        $categoryIds = [(int)$category['id']];
        $descendantIds = $this->getDescendantCategoryIds($category['id']);
        $categoryIds = array_merge($categoryIds, $descendantIds);

        $childCategories = ORM::forTable('categories')
            ->where('parent_category', $category['id'])
            ->findArray();

        $products = ORM::forTable('products')
            ->whereIn('category_id', $categoryIds)
            ->findMany();

        return $this->renderer->render($response, 'catalog.php', [
            'childCategories' => $childCategories,
            'products' => $products,
            'categoryId' => $slug
        ]);
    }

    private function getDescendantCategoryIds($parentId)
    {
        $ids = [];

        $children = ORM::forTable('categories')
            ->where('parent_category', $parentId)
            ->findArray();

        foreach ($children as $child) {
            $ids[] = (int)$child['id'];
            $ids = array_merge($ids, $this->getDescendantCategoryIds($child['id']));
        }

        return $ids;
    }
    public function logout(RequestInterface $request, ResponseInterface $response)
    {
        session_unset();
        return $response->withHeader('Location', '/catalog')->withStatus(302);
    }

}