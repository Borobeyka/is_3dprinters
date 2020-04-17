<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
        <title><?=$title?></title>
        <script type="text/javascript" src="/core/libs/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="/core/libs/jquery.maskedinput.js"></script>
        <link rel="stylesheet" href="/templates/.main/style.css">
    </head>
    <body>
        <?=loadModule("user_admin_strip")?>
        <header class="main-window">
            <a class="logotype" href="/">
                <img src="/uploads/system/logotype.png" height="100%">
            </a>
            <div class="search">
                <form action="/search" method="POST">
                    <input type="text" class="search-input" name="search-input" placeholder="Поиск">
                    <input type="image" class="search-submit" src="/uploads/system/search.png">
                </form>
            </div>
            
            <?=loadModule("user_cart")?>

            <?=loadModule("user_profile")?>

            <?=loadModule("user_logout")?>
            
        </header>
        
        <nav>
            <div class="main-window">
                <a href="/">Главная</a>
                <a href="/catalog">Каталог</a>
                <a href="/delivery">Доставка</a>
                <a href="/contacts">Контакты</a>
                <a href="/shops">Магазины</a>
            </div>
        </nav>

        <div class="main-window content">
            <?=$content?>
        </div>

        
        <footer>
            <div class="main-window">
                <div class="upper-row">
                    <div>
                        <div class="image">
                            <img src="/uploads/system/mail.png">
                        </div>
                        <div class="title">E-Mail</div>
                        <a class="content" href="mailto:contact@3dp-comp.ru">contact@3dp-comp.ru</a>
                    </div>
                    <div>
                        <div class="image">
                            <img src="/uploads/system/phone.png">
                        </div>
                        <div class="title">Телефон</div>
                        <a class="content" href="tel:+79164445566">+7(916)444-55-66</a>
                    </div>
                    <div>
                        <div class="image">
                            <img src="/uploads/system/location.png">
                        </div>
                        <div class="title">Адрес</div>
                        <a class="content" target="_blank" href="https://yandex.ru/maps/213/moscow/search/Россия%2C%20г.%20Москва%2C%20ул.%20Правды%2C%20д.78%2C%20к.4/?ll=37.579645%2C55.786951&sll=37.622504%2C55.753215&sspn=1.972046%2C0.638176&utm_source=geoblock_maps_moscow&z=16">Россия, г. Москва, ул. Правды, д.78, к.4</a>
                    </div>
                </div>
                <div class="lower-row">
                    © 2020 "3dp-comp.ru" - Интернет магазин комплектующих для 3D принтеров<br>
                    Сайт носит исключительно ознакомительный характер и является дипломной работой<br>
                </div>
            </div>
        </footer>

        <script>
            $(window).load(function() {
                $("body").removeClass("load");
            });
        </script>
        <script type="text/javascript" src="/core/libs/scripts.js"></script>
    </body>
</html>