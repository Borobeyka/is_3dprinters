<?php
    if(!isUserAdmin()) redirect("/");
    $itemID = (int)$param;
    $item = getItemByID($itemID);
    $categories = getAllCategories();
    $title = sprintf("Редактирование товара \"%s\"", $item["title"]);
    require_once "handler.php";
    //dump($item);
?>

<h1 class="block-title"><?=$title?></h1>

<div class="add-item-error"><?=@$error?></div>
<form action="" method="POST" class="add-item">
    <div class="column">
        <div>
            <div class="title">
                Название товара:
            </div>
            <div class="field">
                <input type="text" name="title" value="<?=$item["title"]?>">
            </div>
        </div>
        <div>
            <div class="title">
                Выберите категорию:
            </div>
            <div class="field">
                <select size="1" name="category">
                    <option disabled>Выберите категорию</option>
                    <?php foreach($categories as $category): ?>
                    <option value="<?=$category["id"]?>" <?php if($item["category_id"] == $category["id"]): ?> selected <?php endif; ?>><?=$category["title"]?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="column">
        <div>
            <div class="title">
                Цена товара (руб.):
            </div>
            <div class="field">
                <input type="text" name="price" value="<?=$item["price"]?>">
            </div>
        </div>
        <div>
            <div class="title">
                Старая цена (руб.):
            </div>
            <div class="field">
                <input type="text" name="old-price" placeholder="Поле может быть пустым"  value="<?=$item["old_price"]?>">
            </div>
        </div>
        <div>
            <div class="title">
                Описание:
            </div>
            <div class="field">
                <textarea name="description" rows="5" placeholder="Поле может быть пустым"><?=$item["description"]?></textarea>
            </div>
        </div>
    </div>
    <div class="submit">
        <input type="submit" name="submit" value="Применить изменения">
    </div>
</form>