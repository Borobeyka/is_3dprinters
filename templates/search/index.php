<?php
    $data = $_POST;
    if(empty($data)) redirect("/");
?>

<?php if(strlen($data["search-input"]) == 0): ?>
    <h1 class="block-title">Задан пустой поисковый запрос</h1>
<?php else: ?>
    <h1 class="block-title">Результаты по запросу - <?=$data["search-input"]?></h1>
    <?php
        $resultSearch = getItemsBySearch($data["search-input"]);
        if($resultSearch !== false): ?>
            <table class="search-table">
                <tr>
                    <th>Изображение</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Цена</th>
                    <th>Действие</th>
                </tr>
                <?php foreach($resultSearch as $item): ?>
                    <tr>
                        <td>
                            <a href="/item/<?=$item["id"]?>">
                                <img src="/uploads/items/<?=$item["image"]?>" alt="">
                            </a>
                        </td>
                        <td>
                            <a href="/item/<?=$item["id"]?>">
                                <?=preg_replace("/".$data["search-input"]."/i", "<b>$0</b>", $item["title"])?>
                            </a>
                        </td>
                        <td width="30%">
                            <a href="/item/<?=$item["id"]?>">
                                <?=preg_replace("/".$data["search-input"]."/i", "<b>$0</b>", $item["description"])?>
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
                            <a id="add-to-cart" title="Добавить в корзину" data-item-id="<?=$item["id"]?>">
                                Добавить в корзину
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
    <?php else: ?>
        <h1 class="block-subtitle">По вашему запросу ничего не найдено</h1>
    <?php endif; ?>
<?php endif; ?>
