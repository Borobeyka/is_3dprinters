<?php
    return [
        [
            "path" => "/^(\/)?$/",
            "template" => "index",
            "action" => "index",
            "title" => "Интернет-магазин комплектующих для 3D принтеров | 3dp-comp.ru"
        ],
        [
            "path" => "/^catalog(\/)?$/",
            "template" => "catalog",
            "action" => "index",
            "title" => "Каталог"
        ],
        [
            "path" => "/^catalog\/[a-z]{1,32}(\?[a-z0-9=]{1,32})?(\/)?$/",
            "template" => "catalog",
            "action" => "show_category",
            "title" => ""
        ],
        [
            "path" => "/^profile(\/)?$/",
            "template" => "profile",
            "action" => "index",
            "title" => ""
        ],
        [
            "path" => "/^profile\/auth(\/)?$/",
            "template" => "profile",
            "action" => "authorization",
            "title" => "Авторизация"
        ],
        [
            "path" => "/^profile\/register(\/)?$/",
            "template" => "profile",
            "action" => "register",
            "title" => "Регистрация"
        ],
        [
            "path" => "/^profile\/logout(\/)?$/",
            "template" => "profile",
            "action" => "logout",
            "title" => "Выход из личного кабинета"
        ],
        [
            "path" => "/^cart(\/)?$/",
            "template" => "cart",
            "action" => "index",
            "title" => "Корзина"
        ],
        [
            "path" => "/^cart\/checkout(\/)?$/",
            "template" => "cart",
            "action" => "checkout",
            "title" => "Оформление заказа"
        ],
        [
            "path" => "/^item\/[0-9]{1,32}(\/)?$/",
            "template" => "item",
            "action" => "index",
            "title" => ""
        ],
        [
            "path" => "/^order\/[0-9]{1,16}(\/)?$/",
            "template" => "order",
            "action" => "index",
            "title" => ""
        ],
        [
            "path" => "/^delivery(\/)?$/",
            "template" => "delivery",
            "action" => "index",
            "title" => "Доставка"
        ],
        [
            "path" => "/^contacts(\/)?$/",
            "template" => "contacts",
            "action" => "index",
            "title" => "Контакты"
        ],
        [
            "path" => "/^shops(\/)?$/",
            "template" => "shops",
            "action" => "index",
            "title" => "Магазины"
        ],
        [
            "path" => "/^search(\/)?$/",
            "template" => "search",
            "action" => "index",
            "title" => "Результаты поиска"
        ],
        [
            "path" => "/^admin(\?[a-z0-9=]{1,32})?(\/)?$/",
            "template" => "admin",
            "action" => "index",
            "title" => "Панель администратора"
        ],
        [
            "path" => "/^admin\/item\/add(\/)?$/",
            "template" => "admin/item/add",
            "action" => "index",
            "title" => "Добавление товара"
        ],
        [
            "path" => "/^admin\/item\/edit(\/)?$/",
            "template" => "admin/item/edit",
            "action" => "index",
            "title" => "Редактирование товаров"
        ],
        [
            "path" => "/^admin\/item\/edit\/[0-9]{1,32}(\/)?$/",
            "template" => "admin/item/edit",
            "action" => "edit",
            "title" => ""
        ],
    ];
?>