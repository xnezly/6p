<style>
    body {
        color: #ffffff;
        line-height: 1.6;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
        background: rgba(0, 0, 0, 0.94);
    }
    table {
        margin-top: 20px;
        width: 100%;
        border: none;
        margin-bottom: 20px;
        border-collapse: separate;
        color: #000000;
    }
    table thead th {
        font-weight: bold;
        text-align: left;
        border: none;
        color: black;
        padding: 10px 15px;
        background: #ffffff;
        font-size: 14px;
        border-top: 1px solid #ddd;
    }
    td{
        background: white;
    }
    table tbody tr:nth-child(even) {
        background: #F8F8F8;
    }
</style>
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
            <td><?=$application['products_id']?></td>
            <td><?=$application['quantity_days']?></td>
            <td><?=$application['status_id']?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>