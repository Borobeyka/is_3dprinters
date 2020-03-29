<?php
    $passwordError = "";
    $passwordSuccess = "";
    $data = $_POST;
    if(isset($data["form-password"])) {
        if(!empty($data["current"]) && !empty($data["new"]) && !empty($data["new_repeat"])) {
            if(strcmp($data["new"], $data["new_repeat"]) === 0) {
                $tempPassword = hash("sha256", hash("sha256", $data["new"]));
                if(strcmp(hash("sha256", hash("sha256", $data["current"])), $user["password"]) === 0) {
                    if(strcmp($tempPassword, $user["password"]) !== 0) {
                        $query = "UPDATE users SET password = '%s' WHERE hash = '%s' and ip = '%s'";
                        $query = sprintf($query, $tempPassword, getUserHash(), getUserIP());
                        mysqli_query($dbLink, $query);
                        $passwordSuccess = "Пароль успешно изменен";
                    }
                    else $passwordError = "Новый пароль совпадает со старым";
                }
                else $passwordError = "Неверно введен текущий пароль";                
            }
            else $passwordError = "Пароли не совпадают";
        }
        else $passwordError = "Заполните все поля смены пароля";
    }
?>