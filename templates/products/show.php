<style>
    body {
        color: #ffffff;
        line-height: 1.6;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
        background: rgba(0, 0, 0, 0.94);
    }
    .opachki{
        display: flex;
        justify-content: center;
    }
    img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }
    .product-card {
        margin-top: 20px;
        background: white;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 500px;
    }
    .product-image {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        background: #f8f9fa;
    }
    h4 {
        color: black;
    }
    p{
        color: black;
    }
</style>
<div class="opachki">
<div class="product-card">
    <div class="product-image">
        <img src="/<?= $product['img'] ?>" alt="">
    </div>
    <h4><?= $product['name'] ?></h4>
    <p>Характеристика: <?= $product['characteristic'] ?> </p>
    <p>Цена: <?= $product['price'] ?> руб/сутки</p>
</div>
</div>