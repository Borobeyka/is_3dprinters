<?php
    $data = $_GET;
    $categoryInfo = getCategoryByName($param);
    $title = "Каталог - ".$categoryInfo["title"];
    $items = getItemsByCategoryID($categoryInfo["id"], @$data["page"] * ITEMS_PER_PAGE);
    $pages = ceil(getCountItemsInCategoryID($categoryInfo["id"]) / ITEMS_PER_PAGE);
    if(!empty($items)):?>
        <h1 class="block-title"><?=$categoryInfo["title"]?></h1>
        <h1 class="block-subtitle">Страница <?=@$data["page"]+1?></h1>
        <div class="block-items">
            <?php foreach($items as $item): ?>
                <div>
                    <a href="/item/<?=$item["id"]?>" class="item-image">
                        <img src="/uploads/items/<?=$item["image"]?>">
                    </a>
                    <div class="description">
                        <a class="item-title limit-length" href="/item/<?=$item["id"]?>" title="<?=$item["title"]?>">
                            <?=$item["title"]?>
                        </a>
                        <?php if($item["old_price"] != 0):?>
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
                        
                        <a class="item-add" id="add-to-cart" data-item-id="<?=$item["id"]?>" title="Добавить в корзину">
                            <img src="/uploads/system/cart_black.png">
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="items-pagination">
            <?php for($i = 1; $i < $pages + 1; $i++): ?>
                <a href="?page=<?=$i-1?>" id="loadMoreItems" title="Перейти к странице <?=$i?>" data-page-id="<?=$i?>">
                    <?=preg_replace("/".(@$data["page"] + 1)."/i", "<b>$0</b>", $i)?>
                </a>
            <?php endfor; ?>
        </div>
    <?php else: ?>
        <h1 class="block-title">Товары в категории "<?=$categoryInfo["title"]?>" не найдены</h1>
        <div class="link-back">
            <a href="/catalog" class="link-back">Назад</a>
        </div>
    <?php endif; ?>