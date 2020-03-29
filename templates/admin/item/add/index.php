<?php
    if(!isUserAdmin()) redirect("/");
    $categories = getAllCategories();
    require_once "handler.php";
?>

<h1 class="block-title"><?=$title?></h1>

<div class="add-item-error"><?=@$error?></div>
<form action="" method="POST" class="add-item" enctype="multipart/form-data">
    <div class="column">
        <div>
            <div class="title">
                Название товара:
            </div>
            <div class="field">
                <input type="text" name="title">
            </div>
        </div>
        <div>
            <div class="title">
                Выберите категорию:
            </div>
            <div class="field">
                <select size="1" name="category">
                    <option disabled selected>Выберите категорию</option>
                    <?php foreach($categories as $category): ?>
                        <option value="<?=$category["id"]?>"><?=$category["title"]?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div>
            <div class="title">
                Изображение:
            </div>
            <div class="field">
                <input type="file" name="image" id="image">
            </div>
        </div>
    </div>
    <div class="column">
        <div>
            <div class="title">
                Цена товара (руб.):
            </div>
            <div class="field">
                <input type="text" name="price">
            </div>
        </div>
        <div>
            <div class="title">
                Старая цена (руб.):
            </div>
            <div class="field">
                <input type="text" name="old-price" placeholder="Поле может быть пустым">
            </div>
        </div>
        <div>
            <div class="title">
                Описание:
            </div>
            <div class="field">
                <textarea name="description" rows="5" placeholder="Поле может быть пустым"></textarea>
            </div>
        </div>
    </div>
    <div class="submit">
        <input type="submit" name="submit" value="Добавить товар">
    </div>
</form>
