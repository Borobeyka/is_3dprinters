<?php
    $data = $_POST;
    $error = "";
    if(!empty($data["submit"])) {
        if(empty($data["title"])) $error = "Введите название товара";
        else if(empty($data["category"])) $error = "Выберите категорию товара";
        else if(empty($data["price"])) $error = "Введите цену для товара";
        if(strlen($error) == 0) {
            $query = sprintf("UPDATE items SET category_id = %d, title = '%s', description = '%s' 
                WHERE id = %d", (int)$data["category"], $data["title"], $data["description"], $itemID);
            mysqli_query($dbLink, $query);
            $query = sprintf("UPDATE item_price SET price = %d, old_price = %d, date_change = NOW() 
                WHERE item_id = %d", (int)$data["price"], (int)$data["old-price"], $itemID);
            mysqli_query($dbLink, $query);
            redirect("/item/".$itemID);
        }
    }
?>