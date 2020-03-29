<?php
    $categoriesInfo = getAllCategories();
    if($categoriesInfo === false) exit;
?>

<h1 class="block-title">Категории</h1>
<div class="categories">
    <?php foreach ($categoriesInfo as $category): ?>
        <div>
            <div class="category-image">
                <a href="/catalog/<?=$category["name"]?>" title="<?=$category["title"]?>">
                    <img src="/uploads/categories/<?=$category["image"]?>">
                </a>
            </div>
            <a class="category-title" href="/catalog/<?=$category["name"]?>" title="<?=$category["title"]?>"><?=$category["title"]?></a>
        </div>
    <?php endforeach; ?>
</div>