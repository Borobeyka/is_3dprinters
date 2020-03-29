<?php
    $personalError = "";
    $personalSuccess = "";
    $data = $_POST;
    if(isset($data["form-personal"])) {
        if(strcmp($data["name"], $user["name"]) !== 0 || 
           strcmp($data["surname"], $user["surname"]) !== 0 || 
           strcmp($data["email"], $user["email"]) !== 0 || 
           strcmp($data["phone"], $user["phone"]) !== 0
        ) {
            $query = "UPDATE users SET name = '%s', surname = '%s', email = '%s', phone = '%s' WHERE hash = '%s' and ip = '%s'";
            $query = sprintf($query, $data["name"], $data["surname"], $data["email"], $data["phone"], getUserHash(), getUserIP());
            $result = mysqli_query($dbLink, $query);
            $personalSuccess = "Персональные данные обновлены";
        }
        else $personalError = "Нет изменений для сохранения";
    }
?>