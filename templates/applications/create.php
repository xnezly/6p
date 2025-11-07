<form action="/applications/<?= $product_id?>/create" method="post">
    <h1>Добавить заявку</h1>
    <input type="text" name="quantity_days" placeholder="Количество дней">
    <input type="tel" name="phone_number" placeholder="номер телефона">
    <input type="submit" value="Создать">
</form>