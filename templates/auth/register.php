<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/auth/register" method="post">
    <div class="form-container">
        <div class="form-header">
            <h1>Регистрация</h1>
        </div>

        <form action="/auth/register" method="post">
            <div class="form-group">
                <input type="text" name="login" placeholder="Логин" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Пароль" required>
            </div>

            <button type="submit" class="submit-btn">Зарегистрироваться</button>
        </form>

        <a href="/login" class="form-link">Войти в существующий аккаунт</a>
    </div>
</form>
</body>
</html>