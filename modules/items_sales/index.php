<?php $itemsSales = getItemsBySales(); ?>

<h1 class="block-title">Снижена цена</h1>
<div class="block-items">
    <?php foreach($itemsSales as $item): ?>
        <div>
            <a href="/item/<?=$item["id"]?>" class="item-image" title="<?=$item["title"]?>">
                <img src="/uploads/items/<?=$item["image"]?>">
            </a>
            <div class="description">
                <a class="item-title limit-length" href="/item/<?=$item["id"]?>" title="<?=$item["title"]?>">
                    <?=$item["title"]?>
                </a>
                <div class="item-price-old">
                    <?=$item["old_price"]?> руб.
                </div>
                <div class="item-price item-price-new">
                    <?=$item["price"]?> руб.
                </div>
                <a class="item-add" id="add-to-cart" title="Добавить в корзину" data-item-id="<?=$item["id"]?>">
                    <img src="/uploads/system/cart_black.png">
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>