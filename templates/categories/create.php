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

<form action="" method="post">
    <h1>Добавить категорию</h1>
    <input type="text" name="name" placeholder="Название">
    <select name="parent_category" id="">
        <option value="">Выберите категорию</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?=$category['id']?>"><?=$category['name']?></option>
        <?php endforeach; ?>
    </select>
    <input type="text" name="slug" placeholder="swag">
    <input type="submit" value="Создать">
</form>

</body>
</html>