<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Изменить категорию</title>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
    <h1>Изменить категорию <?=$product['name']?></h1>
    <input type="text" name="name" placeholder="Название" value="<?=$product['name']?>">
    <input type="text" name="price" placeholder="Цена" value="<?= $product['price'] ?>">
    <input type="file" name="img" placeholder="Фото">
    <select name="category_id" id="">
        <option value="">Выберите категорию</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?=$category['id']?>"><?=$category['name']?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Изменить">
</form>

</body>
</html>