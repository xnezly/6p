<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Категории</title>
    <style>
        body {
            color: #ffffff;
            line-height: 1.6;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(0, 0, 0, 0.94);
        }
        img{
            width: 50px;
        }
        table {
            width: 100%;
            border: none;
            margin-bottom: 20px;
            border-collapse: separate;
        }
        table thead th {
            font-weight: bold;
            text-align: left;
            border: none;
            color: #000000;
            padding: 10px 15px;
            background: #ffffff;
            font-size: 14px;
            border-top: 1px solid #ddd;
        }
        td{
            background: white;
            color: black;
        }
        table tbody td {
            text-align: left;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            vertical-align: top;
        }
        table tbody tr:nth-child(even) {
            background: #F8F8F8;
        }
    </style>
</head>
<body>

<h1>Продукты</h1>
<a href="/products/create">Добавить</a>

<table>
    <thead>
    <tr>
        <th>Название</th>
        <th>Цена</th>
        <th>Фото</th>
        <th>Характеристика</th>
        <th>Категория</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['name'] ?></td>
            <td><?= $product['price'] ?></td>
            <td><img src="/<?= $product['img'] ?>" alt=""></td>
            <td><?= $product['characteristic'] ?></td>
            <td><?= $product['category_name'] ?></td>
            <td><a href="/products/<?= $product['id'] ?>/edit">Редактировать</a></td>
            <td><a href="/products/<?= $product['id'] ?>/delete">Удалить</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>