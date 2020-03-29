<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/core/db.php";
    $data = $_POST;

    global $dbLink;
    $query = "DELETE FROM cart_details WHERE item_id = %d AND cart_id = %d";
    $query = sprintf($query, $data["itemID"], getUserCartID());
    mysqli_query($dbLink, $query);
?>