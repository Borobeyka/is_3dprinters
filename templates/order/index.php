<?php
    $order = getOrderByID((int)$param);
    if(getUserID() != $order["user_id"]) redirect("/");
    $orderDetails = getOrderDetailsByID($order["id"]);
    if($orderDetails == false) redirect("/");
    $title = "Детали заказа #".$order["id"];
?>
<?php if($order !== false): ?>
    
    <h1 class="block-title">Детали заказа #<?=$order["id"]?></h1>
    <table class="orders-table">
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Количество</th>
            <th>Цена</th>
            <th>Сумма</th>
        </tr>
            <?php $counter = 1; foreach($orderDetails as $itemDetails): ?>
                <tr>
                    <td>
                        <a href="/item/<?=$itemDetails["item_id"]?>" title="<?=$itemDetails["title"]?>">
                            <?=$counter++?>
                        </a>
                    </td>
                    <td width="60%">
                        <a href="/item/<?=$itemDetails["item_id"]?>" title="<?=$itemDetails["title"]?>">
                            <?=$itemDetails["title"]?>
                        </a>
                    </td>
                    <td>
                        <a href="/item/<?=$itemDetails["item_id"]?>" title="<?=$itemDetails["title"]?>">
                            <?=$itemDetails["count"]?> шт.
                        </a>
                    </td>
                    <td>
                        <a href="/item/<?=$itemDetails["item_id"]?>" title="<?=$itemDetails["title"]?>">
                            <?=$itemDetails["price"]?> руб.
                        </a>
                    </td>
                    <td>
                        <a href="/item/<?=$itemDetails["item_id"]?>" title="<?=$itemDetails["title"]?>">
                            <?=$itemDetails["count"] * $itemDetails["price"]?> руб.
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>
    <h2 class="block-subtitle">Итоговая сумма заказа: <?=$order["summ"]?> руб.</h2>
    <h2 class="block-subtitle">Статус заказа: <?=mb_strtolower($order["status"])?></h2>
<?php else: ?>
    <?php redirect("/"); ?>
<?php endif; ?>