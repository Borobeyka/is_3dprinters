<?php
    $error = "";
    $data = $_POST;
    if(!empty($data["submit"])) {
        $tempPassword = hash("sha256", hash("sha256", $data["password"]));
        if(isUserRegistered($data["email"], $tempPassword)) {
            $hash = hash("sha256", time());
            setUserHash($hash, $data["email"], $tempPassword);
            redirect("/");
            exit;
        }
        else $error = "Логин или пароль введен неверно";
    }
?>