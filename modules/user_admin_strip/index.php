<?php if(isUserAdmin() !== false): ?>
    <div class="admin-strip main-window">
        <div class="title">
            Здравствуйте, <?= getUserInfo()["name"] ?>
        </div>
        <a href="/admin">Панель администратора</a>
        <a href="/admin/item/add">Добавить товар</a>
        <a href="/admin/item/edit">Изменить товар</a>
        <a href="/admin/orders">Заказы</a>
    </div>
<?php endif; ?>