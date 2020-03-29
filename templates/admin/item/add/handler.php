<?php
    $data = $_POST;
    $error = "";
    if(!empty($data["submit"])) {
        $imageInfo = @$_FILES["image"];
        dump($imageInfo);
        if(empty($data["title"])) $error = "Введите название товара";
        else if(empty($data["category"])) $error = "Выберите категорию товара";
        else if(empty($data["price"])) $error = "Введите цену для товара";
        else if($imageInfo["error"] != 0) $error = "Ошибка загрузки изображения";
        if(strlen($error) == 0) {
            $fileName = hash("sha256", time()).".".explode(".", $imageInfo["name"])[1];
            move_uploaded_file($imageInfo["tmp_name"], $_SERVER["DOCUMENT_ROOT"]."/uploads/items/".$fileName);
            
            if(empty($data["description"])) {
                $query = "INSERT INTO items VALUES (NULL, %d, '%s', DEFAULT, '%s')";
                $query = sprintf($query, $data["category"], $data["title"], $fileName);
            }
            else {
                $query = "INSERT INTO items VALUES (NULL, %d, '%s', '%s', '%s')";
                $query = sprintf($query, $data["category"], $data["title"], $data["description"], $fileName);
            }
            mysqli_query($dbLink, $query);

            $query = "SELECT LAST_INSERT_ID()";
            $result = mysqli_query($dbLink, $query);
            $itemID = mysqli_fetch_assoc($result)["LAST_INSERT_ID()"];

            if(empty($data["old-price"])) {
                $query = "INSERT INTO item_price VALUES (NULL, %d, %d, DEFAULT, DEFAULT)";
                $query = sprintf($query, $itemID, $data["price"]);
            }
            else {
                $query = "INSERT INTO item_price VALUES (NULL, %d, %d, %d, NOW())";
                $query = sprintf($query, $itemID, $data["price"], $data["old-price"]);
            }
            mysqli_query($dbLink, $query);

            redirect("/item/".$itemID);
        }
    }
?>