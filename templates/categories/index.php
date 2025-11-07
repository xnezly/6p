<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Категории</title>
    <style>
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
            padding: 10px 15px;
            background: #EDEDED;
            font-size: 14px;
            border-top: 1px solid #ddd;
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

<h1>Категории</h1>
<a href="/categories/create">Добавить</a>

<table>
    <thead>
    <tr>
        <th>Название</th>
        <th>Родительская категория</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($categories as $category): ?>
        <tr>
            <td><?= $category['name'] ?></td>
            <td><?= $category['parent_name'] ?? 'Нет' ?></td>
            <td><a href="/categories/<?= $category['slug'] ?>/edit">Редактировать</a></td>
            <td><a href="/categories/<?= $category['slug'] ?>/delete">Удалить</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>