<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            color: #000000;
            line-height: 1.6;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(0, 0, 0, 0.94);
        }
        h1 {
            text-align: start;
            margin-bottom: 10px;
            color: #ffffff;
            font-size: 2.5rem;
            position: relative;
        }
        .categories {
            gap: 10px;
            margin-bottom: 30px;
        }
        .category-link {
            padding: 10px 20px;
            background-color: #ffffff;
            color: #000000;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 500;
        }
        img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }
        .products-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .product-image {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background: #f8f9fa;
        }
    </style>
</head>
<body>

<h1>Каталог</h1>
<?php if (isset($childCategories)): ?>
    <div class="categories">
        <?php foreach ($childCategories as $childCategory): ?>
            <?php if ($childCategory['parent_category'] != null): ?>
                <a class="category-link" href="/catalog/<?= $childCategory['slug'] ?>"><?= $childCategory['name'] ?></a>
            <?php endif ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<div class="products-container">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <div>
                <div class="product-image">
                    <img src="/<?= $product['img'] ?>" alt="">
                </div>
                <h4><?= $product['name'] ?></h4>
                <p><?= $product['price'] ?> руб/сутки</p>
                <a href="/products/<?= $product['id'] ?>">Подробнее</a>
                <a href="/applications/<?= $product['id'] ?>/create">Арендовать</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>