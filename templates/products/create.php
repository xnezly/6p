<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавить категорию</title>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
    <h1>Добавить категорию</h1>
    <input type="text" name="name" placeholder="Название">
    <input type="text" name="price" placeholder="Цена">
    <input type="text" name="characteristic" placeholder="Характеристика">
    <input type="file" name="img" placeholder="Фото">
    <select name="category_id" id="">
        <option value="">Выберите категорию</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?=$category['id']?>"><?=$category['name']?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Создать">
</form>

</body>
</html>