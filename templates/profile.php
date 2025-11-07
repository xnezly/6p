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
    table tbody tr:nth-child(even) {
        background: #F8F8F8;
    }
</style>
<h1>Заявки</h1>
<table>
    <thead>
    <tr>
        <th>Инструменты</th>
        <th>Количество дней</th>
        <th>Статус</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($applications as $application): ?>
    <tr>
        <td><?=$application['products_name']?></td>
        <td><?=$application['quantity_days']?></td>
        <td><?=$application['status_name']?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>