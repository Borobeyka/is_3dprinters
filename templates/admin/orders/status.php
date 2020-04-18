<?php
    if(!isUserAdmin()) redirect("/");
    $orderID = (int)$param;
    $order = getOrderByID($orderID);
    $title = "Обновление статуса для заказа #".$orderID;
    $data = $_POST;
    $error = "";
    if(!empty($data["submit"])) {
        if(empty($data["status"])) $error = "Введите статус заказа";
        if(strlen($error) == 0) {
            $query = "UPDATE orders SET status = '%s' WHERE id = %d";
            $query = sprintf($query, $data["status"], $orderID);

            mysqli_query($dbLink, $query);
            redirect("/admin");
        }
    }
?>
<h1 class="block-title"><?=$title?></h1>
<div class="add-item-error"><?=@$error?></div>
<form action="" method="POST" class="add-item" enctype="multipart/form-data">
    <div class="column">
        <div>
            <div class="title">
                Введите статус
            </div>
            <div class="field">
                <input type="text" name="status" value="<?=$order["status"]?>">
            </div>
        </div>
    </div>
    <div class="submit">
        <input type="submit" name="submit" value="Обновить статус">
    </div>
</form>
