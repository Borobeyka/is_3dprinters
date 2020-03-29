<?php
    $data = $_POST;
    $registerError = "";
    if(!empty($data["submit"])) {
        if(empty($data["email"])) $registerError = "Необходимо ввести E-Mail адрес";
        else if(empty($data["password"])) $registerError = "Необходимо ввести пароль";
        else if(empty($data["password-repeat"])) $registerError = "Необходимо ввести повторный пароль";
        else if(empty($data["name"])) $registerError = "Необходимо ввести имя";
        else if(empty($data["surname"])) $registerError = "Необходимо ввести фамилию";
        else if(empty($data["phone"])) $registerError = "Необходимо ввести телефон";
        else if(strcmp($data["password"], $data["password-repeat"]) != 0) $registerError = "Введенные пароли не совпадают";
        
        if(strlen($registerError) == 0) {
            $query = "SELECT * FROM users WHERE email = '%s'";
            $query = sprintf($query, $data["email"]);
            $result = mysqli_query($dbLink, $query);
            if(mysqli_num_rows($result) == 0) {
                $hash = hash("sha256", time());
                $tempPassword = hash("sha256", hash("sha256", $data["password"]));
                $query = "INSERT INTO users VALUES(NULL, '%s', '%s', '%s', '%s', '%s', '%s', '%s', DEFAULT)";
                $query = sprintf($query, $data["email"], $tempPassword, $hash, getUserIP(), $data["phone"], ucfirst($data["name"]), ucfirst($data["surname"]));
                mysqli_query($dbLink, $query);
                setUserHash($hash, $data["email"], $tempPassword);
                redirect("/profile");
            }
            else $registerError = "Пользователь с таким E-Mail адресом уже существует";
        }
    
    }

?>


<h2 class="block-title">Регистрация пользователя</h2>
<div class="profile-form-error"><?=$registerError?></div>
<form action="" method="POST" class="profile-form">
    <div>
        <div class="row">
            <div class="title">Введите E-Mail:</div>
            <div class="field">
                <input type="text" name="email">
            </div>
        </div>
        <div class="row">
            <div class="title">Введите пароль:</div>
            <div class="field">
                <input type="text" name="password">
            </div>
        </div>
        <div class="row">
            <div class="title">Повторите пароль:</div>
            <div class="field">
                <input type="text" name="password-repeat">
            </div>
        </div>
    </div>
    <div>
        <div class="row">
            <div class="title">Введите имя:</div>
            <div class="field">
                <input type="text" name="name">
            </div>
        </div>
        <div class="row">
            <div class="title">Введите фамилию:</div>
            <div class="field">
                <input type="text" name="surname">
            </div>
        </div>
        <div class="row">
            <div class="title">Введите телефон:</div>
            <div class="field">
                <input type="text" name="phone" id="phone">
            </div>
        </div>
    </div>
    <div class="submit">
        <input type="submit" name="submit" value="Зарегистрироваться">
    </div>
</form>