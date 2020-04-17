<?php
    require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
    require_once $_SERVER['DOCUMENT_ROOT']."/core/db.php";
    $data = $_POST;
    $response = array();
    if(isUserLogged()) {
        global $dbLink;
        $query = "SELECT * FROM carts WHERE user_id = %d";
        $query = sprintf($query, getUserID());
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result) == 0) {
            $query = "INSERT INTO carts (user_id) VALUES (%d)";
            $query = sprintf($query, getUserID());
            mysqli_query($dbLink, $query);
        }

        $query = "SELECT * FROM cart_details WHERE item_id = %d AND cart_id = %d";
        $query = sprintf($query, $data["itemID"], getUserCartID());
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result)) {
            $query = "UPDATE carts as c, cart_details as cd SET c.count = c.count + 1, c.summ = c.summ + 
                (SELECT price FROM item_price WHERE item_id = %d), cd.count = cd.count + 1 WHERE c.user_id = %d AND
                cd.item_id = %d AND cd.cart_id = %d AND c.id = cd.cart_id";
            $query = sprintf($query, $data["itemID"], getUserID(), $data["itemID"], getUserCartID());
            mysqli_query($dbLink, $query);
        }
        else {
            $query = "SELECT id FROM carts WHERE user_id = %d";
            $query = sprintf($query, getUserID());
            $result = mysqli_query($dbLink, $query);
            $cartID = mysqli_fetch_assoc($result)["id"];
            
            $query = "INSERT INTO cart_details VALUES (NULL, %d, %d, 1)";
            $query = sprintf($query, $cartID, (int)$data["itemID"], getUserID());
            mysqli_query($dbLink, $query);
        }
        $response = compileResponse("success", "Товар добавлен в корзину");
    }
    else $response = compileResponse("error", "Чтобы добавить товар в корзину необходимо авторизироваться");
    echo json_encode($response);

    function compileResponse($status, $message) {
        return array("status" => $status, "message" => $message);
    }
?>