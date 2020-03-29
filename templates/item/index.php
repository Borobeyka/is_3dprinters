<?php
    $item = getItemByID($param);
    $title = $item["title"];
    //dump($item);
?>

<h1 class="block-title"><?=$item["title"]?></h1>

<div class="item">
    <div class="image">
        <img src="/uploads/items/<?=$item["image"]?>" alt="">
    </div>
    <div class="description-title">Описание</div>
    <div class="description">
        <pre><?=$item["description"]?></pre>
    </div>
    <div class="price">
        Цена: 
        <?php if($item["old_price"] != 0): ?>
            <span class="old-price"><?=$item["old_price"]?></span>
            <span class="new-price"><?=$item["price"]?></span> руб.
        <?php else: ?>
            <span><?=$item["price"]?> руб.</span>
        <?php endif; ?>
        
    </div>
    <a class="add-to-cart" id="add-to-cart" data-item-id="<?=$item["id"]?>"  title="Добавить в корзину">
        Добавить в корзину
        <img src="/uploads/system/cart_black.png">
    </div>
</div>