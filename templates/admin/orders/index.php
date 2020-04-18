<?php
    if(!isUserAdmin()) redirect("/");
    $orders = getAllOrdersShort();
?>
<h1 class="block-title"><?=$title?></h1>
<h1 class="block-subtitle">Выберите заказ из списка</h1>

<table class="search-table">
    <tr>
        <th>ID заказа</th>
        <th>Дата заказа</th>
        <th>Сумма заказа</th>
        <th>Позиций</th>
        <th>Заказчик</th>
        <th>Статус</th>
        <th>Действие</th>
    </tr>
    <?php foreach($orders as $order): ?>
        <tr>
            <td>
                <?=$order["id"]?>
            </td>
            <td>
                <?=convertDate($order["date"])?>
            </td>
            <td>
                <?=$order["summ"]?> руб.
            </td>
            <td>
                <?=$order["count"]?> поз.
            </td>
            <td>
                <?=$order["surname"]?> <?=$order["name"]?>
            </td>
            <td>
                <?=$order["status"]?>
            </td>
            <td>
                <a title="Изменить товар" href="/order/<?=$order["id"]?>">
                    Детали заказа
                </a><br>
                <a title="Изменить товар" href="/admin/orders/status/<?=$order["id"]?>">
                    Обновить статус
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>