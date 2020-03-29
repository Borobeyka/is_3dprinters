<?php
    if(!isUserLogged()) redirect("/profile/auth");
    $user = getUserInfo() ?? redirect("/");
    //dump($user);
    $title = "ЛК | ".$user["name"]." ".$user["surname"];
    $orders = getHistoryOrdersByUser($user["id"]);
    require_once "handler/form-personal.php";
    require_once "handler/form-password.php";
?>

<h1 class="block-title">Личный кабинет <?=$user["name"]?> <?=$user["surname"]?></h1>
<h2 class="block-subtitle">Персональные данные</h2>
<div class="profile-form-error"><?=$personalError?></div>
<div class="profile-form-success"><?=$personalSuccess?></div>
<form action="" method="POST" class="profile-form">
    <div>
        <div class="row">
            <div class="title">Ваше имя:</div>
            <div class="field">
                <input type="text" name="name" value="<?=$user["name"]?>">
            </div>
        </div>
        <div class="row">
            <div class="title">Ваша фамилия:</div>
            <div class="field">
                <input type="text" name="surname" value="<?=$user["surname"]?>">
            </div>
        </div>
    </div>
    <div>
        <div class="row">
            <div class="title">E-Mail адрес:</div>
            <div class="field">
                <input type="text" name="email" value="<?=$user["email"]?>" id="email">
            </div>
        </div>
        <div class="row">
            <div class="title">Номер телефона:</div>
            <div class="field">
                <input type="text" name="phone" id="phone" value="<?=$user["phone"]?>">
            </div>
        </div>
    </div>
    <div class="submit">
        <input type="submit" name="form-personal" value="Сохранить изменения">
    </div>
</form>

<h2 class="block-subtitle">Смена пароля</h2>
<div class="profile-form-error"><?=$passwordError?></div>
<div class="profile-form-success"><?=$passwordSuccess?></div>
<form action="" method="POST" class="profile-form">
    <div>
        <div class="row">
            <div class="title">Текущий пароль:</div>
            <div class="field">
                <input type="password" name="current">
            </div>
        </div>
    </div>
    <div>
        <div class="row">
            <div class="title">Новый пароль:</div>
            <div class="field">
                <input type="password" name="new">
            </div>
        </div>
        <div class="row">
            <div class="title">Повторите пароль:</div>
            <div class="field">
                <input type="password" name="new_repeat">
            </div>
        </div>
    </div>
    <div class="submit">
        <input type="submit" name="form-password" value="Сохранить изменения">
    </div>
</form>

<h2 class="block-title">История заказов</h2>
<?php if($orders !== false): ?>
    <table class="orders-table">
        <tr>
            <th>Номер заказа</th>
            <th>Сумма заказа</th>
            <th>Позиций</th>
            <th>Дата заказа</th>
            <th>Статус</th>
        </tr>
            <?php foreach($orders as $order): ?>
                <tr>
                    <td>
                        <a href="/order/<?=$order["id"]?>" title="Перейти к заказу">
                            <?=$order["id"]?>
                        </a>
                    </td>
                    <td>
                        <a href="/order/<?=$order["id"]?>" title="Перейти к заказу">
                            <?=$order["summ"]?> руб.
                        </a>
                    </td>
                    <td>
                        <a href="/order/<?=$order["id"]?>" title="Перейти к заказу">
                            <?=$order["count"]?> шт.
                        </a>
                    </td>
                    <td>
                        <a href="/order/<?=$order["id"]?>" title="Перейти к заказу">
                            <?=convertDate($order["date"])?>
                        </a>
                    </td>
                    <td>
                        <a href="/order/<?=$order["id"]?>" title="Перейти к заказу">
                            <?=$order["status"]?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>
<?php else: ?>
    <h2 class="block-subtitle">У вас отсутсвует история заказов</h2>
<?php endif; ?>