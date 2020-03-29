<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/core/db.php";
    $data = $_POST;

    global $dbLink;
    $query = "UPDATE cart_details as cd, carts as c SET cd.count = cd.count + 1, c.count = c.count + 1, 
        c.summ = c.summ + (SELECT price FROM item_price WHERE item_id = cd.item_id) WHERE cd.item_id = %d 
        AND cd.cart_id = %d AND c.user_id = %d";
    $query = sprintf($query, $data["itemID"], getUserCartID(), getUserID());
    mysqli_query($dbLink, $query);

?>