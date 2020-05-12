<?php
    $error = "";
    $data = $_POST;
    if(!empty($data["submit"])) {
        $tempPassword = hash("sha256", hash("sha256", $data["password"])); // Двойное шифрование пароля
        if(isUserRegistered($data["email"], $tempPassword)) {
            $hash = hash("sha256", time()); // Генерация ключа из времени
            setUserHash($hash, $data["email"], $tempPassword); // Установление ключа пользователю на данную сессию
            redirect("/"); // Переадресация на главную в случае успешной авторизации
        }
        else $error = "Логин или пароль введен неверно";
    }
?>