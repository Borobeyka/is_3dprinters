<?php if(!isUserAdmin()) redirect("/"); ?>

<h1 class="block-title"><?=$title?></h1>
<h1 class="block-subtitle">Действия с товаром</h1>
<div class="admin-buttons">
    <div class="column">
        <div>
            <a href="/admin/item/add">Добавить товар</a>
        </div>
    </div>
    <div class="column">
        <div>
            <a href="/admin/item/edit">Редактировать товар</a>
        </div>
    </div>
</div>