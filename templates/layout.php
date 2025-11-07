<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? '' ?></title>
    <style>
        a{
            padding: 10px 20px;
            background-color: #ffffff;
            color: #000000;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="oper">
    <?php if(empty($_SESSION['user_id'])):?>
        <a href="/login">Войти</a>
        <a href="/register">Зарегистрироваться</a>
        <?php else :?>
        <a href="/logout">Выйти</a>
    <?php endif?>
    <a href="/catalog">Каталог</a>
    <?php foreach ($layoutCategories as $layoutCategory):?>
    <a href="/catalog/<?=$layoutCategory['slug']?>"><?=$layoutCategory['name']?></a>
    <?php endforeach;?>
</div>
<?=$content?>
</body>
</html>