<?php $itemsNewest = getItemsByNewest(); ?>

<h1 class="block-title">Новинки</h1>
<div class="block-items">
    <?php foreach($itemsNewest as $item): ?>
        <div>
            <a href="/item/<?=$item["id"]?>" class="item-image" title="<?=$item["title"]?>">
                <img src="/uploads/items/<?=$item["image"]?>">
            </a>
            <div class="description">
                <a class="item-title limit-length" href="/item/<?=$item["id"]?>" title="<?=$item["title"]?>">
                    <?=$item["title"]?>
                </a>
                <?php if($item["old_price"] != 0): ?>
                    <div class="item-price-old">
                        <?=$item["old_price"]?> руб.
                    </div>
                    <div class="item-price item-price-new">
                        <?=$item["price"]?> руб.
                    </div>
                <?php else: ?>
                    <div class="item-price">
                        <?=$item["price"]?> руб.
                    </div>
                <?php endif; ?>
                
                <a class="item-add" id="add-to-cart" title="Добавить в корзину" data-item-id="<?=$item["id"]?>">
                    <img src="/uploads/system/cart_black.png">
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>