<?php
    if(!isUserAdmin()) redirect("/");
    $items = getAllItems();
?>
<h1 class="block-title"><?=$title?></h1>
<h1 class="block-subtitle">Выберите товар из списка для редактирования</h1>

<table class="search-table">
    <tr>
        <th>ID</th>
        <th>Изображение</th>
        <th>Название</th>
        <th>Цена</th>
        <th>Действие</th>
    </tr>
    <?php foreach($items as $item): ?>
        <tr>
            <td>
                <a href="/item/<?=$item["id"]?>">
                    <?=$item["id"]?>
                </a>
            </td>
            <td>
                <a href="/item/<?=$item["id"]?>">
                    <img src="/uploads/items/<?=$item["image"]?>" alt="">
                </a>
            </td>
            <td>
                <a href="/item/<?=$item["id"]?>">
                    <?= $item["title"] ?>
                </a>
            </td>
            <td>
                <a href="/item/<?=$item["id"]?>">
                    <?php if($item["old_price"] != 0): ?>
                        <div class="old-price"><?=$item["old_price"]?> руб.</div>
                        <?=$item["price"]?> руб.
                    <?php else: ?>
                        <?=$item["price"]?> руб.
                    <?php endif; ?>
                </a>
            </td>
            <td>
                <a title="Изменить товар" href="/admin/item/edit/<?=$item["id"]?>">
                    Изменить товар
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>