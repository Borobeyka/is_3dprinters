<?php
    if(isUserLogged()) redirect("/profile");
    require_once "handler/form-auth.php";
?>


<h1 class="block-title">Авторизация</h1>
<form class="auth-form" action="" method="POST">
    <div class="auth-form-error"><?=$error?></div>
    <div class="auth-form-row">
        <div class="label">
            Введите E-Mail:
        </div>
        <input type="text" name="email" class="field">
    </div>
    <div class="auth-form-row">
        <div class="label">
            Введите пароль:
        </div>
        <input type="password" name="password" class="field">
    </div>
    <div class="auth-form-row">
        <input type="submit" name="submit" class="submit" value="Войти">
    </div>
    <br>
    Нет аккаунта?
    <a class="auth-form-row forgot" href="/profile/register">
        Зарегистрироваться
    </a>
</form>