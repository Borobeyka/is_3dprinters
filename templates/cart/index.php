<?php
    $userCart = getUserCart();
    $userCartPositions = getUserCartPositions();
    $counter = 1;
?>

<h1 class="block-title">Корзина</h1>

<?php if($userCart !== false && $userCartPositions !== false): ?>
    <table class="cart-table">
        <tr>
            <th># п/п</th>
            <th>Изображение</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Стоимость</th>
            <th>Действие</th>
        </tr>
        <?php foreach($userCartPositions as $position): ?>
            <tr>
                <td>
                    <a href="/item/<?=$position["item_id"]?>" title="<?=$position["title"]?>">
                        <?=$counter++?>
                    </a>
                </td>
                <td>
                    <a href="/item/<?=$position["item_id"]?>" title="<?=$position["title"]?>">
                        <img src="/uploads/items/<?=$position["image"]?>">
                    </a>
                </td>
                <td width="20%">
                    <a href="/item/<?=$position["item_id"]?>" title="<?=$position["title"]?>">
                        <?=$position["title"]?>
                    </a>
                </td>
                <td>
                    <a href="/item/<?=$position["item_id"]?>" title="<?=$position["title"]?>">
                        <?php if($position["old_price"] != 0): ?>
                            <div class="old-price">
                                <?=$position["old_price"]?> руб.
                            </div>
                        <?php endif;?>
                            <?=$position["price"]?> руб.
                    </a>
                </td>
                <td>
                    <div class="count">
                        <img src="/uploads/system/minus.png" title="Убрать 1 шт." id="sub-count-cart" data-item-id="<?=$position["item_id"]?>">
                        <?=$position["count"]?> шт.
                        <img src="/uploads/system/plus.png" title="Добавить 1 шт." id="add-count-cart" data-item-id="<?=$position["item_id"]?>">
                    </div>
                </td>
                <td>
                    <a href="/item/<?=$position["item_id"]?>" title="<?=$position["title"]?>">
                        <?=$position["price"] * $position["count"]?> руб.
                    </a>
                </td>
                <td>
                    <div class="delete delete-item-from-cart" data-item-id="<?=$position["item_id"]?>">
                        Удалить
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h1 class="block-subtitle">Позиций в корзине <?=$userCart["stock"]?>, на сумму <?=$userCart["summ"]?> руб.</h1>
    <div class="checkout-button">
        <a href="/cart/checkout" title="Оформить заказ">
            Оформить заказ
        </a>
    </div>
<?php else: ?>
    <h1 class="block-subtitle">Ваша корзина пуста</h1>
<?php endif; ?>