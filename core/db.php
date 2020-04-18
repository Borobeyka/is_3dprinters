<?php
    $dbLink = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if(!$dbLink) exit();
    mysqli_query($dbLink, "SET NAMES UTF8");

    function getItemsBySearch($input) {
        global $dbLink;
        $items = [];
        $query = "SELECT * FROM items as it, item_price as ip WHERE (it.title LIKE '%%%s%%' OR 
            it.description LIKE '%%%s%%') AND it.id = ip.item_id";
        $query = sprintf($query, $input, $input);
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result)) {
            while($row = mysqli_fetch_assoc($result))
                array_push($items, $row);
            return $items;
        }
        else return false;  
    }

    function getAllOrdersShort() {
        global $dbLink;
        $orders = [];
        $query = "SELECT o.*, u.name, u.surname FROM orders as o, users as u WHERE o.user_id = u.id ORDER BY o.date DESC";
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result)) {
            while($row = mysqli_fetch_assoc($result))
                array_push($orders, $row);
            return $orders;
        }
        else return false; 
    }

    function getItemsBySales() {
        global $dbLink;
        $items = [];
        $query = "SELECT * FROM item_price as ip, items as it WHERE it.id = ip.item_id AND ip.old_price <> 0 
            ORDER BY ip.date_change DESC LIMIT 4";
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result)) {
            while($row = mysqli_fetch_assoc($result))
                array_push($items, $row);
            return $items;
        }
        else return false;  
    }

    function getAllItems() {
        global $dbLink;
        $items = [];
        $query = "SELECT * FROM item_price as ip, items as it WHERE it.id = ip.item_id ORDER BY it.id";
        $query = sprintf($query);
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result)) {
            while($row = mysqli_fetch_assoc($result))
                array_push($items, $row);
            return $items;
        }
        else return false; 
    }

    function getItemsByNewest() {
        global $dbLink;
        $items = [];
        $query = "SELECT * FROM item_price as ip, items as it WHERE it.id = ip.item_id ORDER BY it.id 
            DESC LIMIT 4";
        $query = sprintf($query);
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result)) {
            while($row = mysqli_fetch_assoc($result))
                array_push($items, $row);
            return $items;
        }
        else return false;  
    }

    function getAllCategories() {
        global $dbLink;
        $result;
        $arr = [];
        $query = sprintf("SELECT * FROM categories");
        $result = mysqli_query($dbLink, $query);
        while($row = mysqli_fetch_assoc($result))
            array_push($arr, $row);
        return $arr;
    }

    function getCategoryByName($name = "") {
        global $dbLink;
        $query = sprintf("SELECT * FROM categories WHERE name = '%s'", $name);
        return mysqli_fetch_assoc(mysqli_query($dbLink, $query));
    }

    function getCountItemsInCategoryID($category_id) {
        global $dbLink;
        $items = [];
        $query = "SELECT * FROM items WHERE category_id = %d";
        $query = sprintf($query, $category_id);
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result) > 0)
            return mysqli_num_rows($result);
        else return false;
    }

    function getItemsByCategoryID($category_id, $start = 0, $order_by = "id", $order_type = "DESC") {
        global $dbLink;
        $items = [];
        $query = "SELECT * FROM items WHERE category_id = %d ORDER BY %s %s LIMIT %d, %d";
        $query = sprintf($query, $category_id, $order_by, $order_type, $start, ITEMS_PER_PAGE);
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result)) {
            while($row = mysqli_fetch_assoc($result)) {
                $query = sprintf("SELECT * FROM item_price WHERE item_id = %d", $row["id"]);
                $result2 = mysqli_query($dbLink, $query);
                while($row2 = mysqli_fetch_assoc($result2)) array_push($items, $row + $row2);
            }
            return $items;
        }
        else return false;
    }

    function getItemByID($item_id) {
        global $dbLink;
        $item = [];
        $query = sprintf("SELECT * FROM items WHERE id = '%d'", $item_id);
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result)) {
            while($row = mysqli_fetch_assoc($result)) {
                $query = sprintf("SELECT * FROM item_price WHERE item_id = '%d'", $item_id);
                $result2 = mysqli_query($dbLink, $query);
                while($row2 = mysqli_fetch_assoc($result2)) array_push($item, $row + $row2);
            }
            return $item[0];
        }
        else return false;
    }

    function isUserRegistered($email, $password) {
        global $dbLink;
        $query = "SELECT id FROM users WHERE BINARY email = '%s' AND BINARY password = '%s'";
        $query = sprintf($query, $email, $password);
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result)) return true;
        else return false;
    }

    function setUserHash($hash, $email, $password) {
        global $dbLink;
        $ip = getUserIP();
        $query = "UPDATE users SET hash = '%s', ip = '%s' WHERE email = '%s' AND password = '%s'";
        $query = sprintf($query, $hash, $ip, $email, $password);
        mysqli_query($dbLink, $query);
        setcookie("hash", $hash, time() + AUTH_SESSION_TIME, "/");
    }

    function getUserIP(){
        $value = "";
        if (!empty($_SERVER["HTTP_CLIENT_IP"]))
            $value = $_SERVER["HTTP_CLIENT_IP"];
        else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
            $value = $_SERVER["HTTP_X_FORWARDED_FOR"];
        elseif (!empty($_SERVER["REMOTE_ADDR"]))
            $value = $_SERVER["REMOTE_ADDR"];
        return $value;
    }

    function getUserHash() {
        if(isset($_COOKIE["hash"])) return $_COOKIE["hash"];
        else return false;
    }

    function isUserLogged() {
        global $dbLink;
        $query = "SELECT * FROM users WHERE hash = '%s' AND ip = '%s'";
        $query = sprintf($query, getUserHash(), getUserIP());
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result) != 0 && isset($_COOKIE["hash"]))
            return true;
        else return false;
    }

    function redirect($route) {
        header("Location: ".$route);
        exit;
    }

    function isUserAdmin() {
        if(getUserInfo() !== false && getUserInfo()["isAdmin"] == 1) return true;
        else return false;
    }

    function getUserInfo() {
        if(isUserLogged()) {
            global $dbLink;
            $user = [];
            $query = "SELECT * FROM users WHERE id = %d";
            $query = sprintf($query, getUserID());
            $result = mysqli_query($dbLink, $query);
            return mysqli_fetch_assoc($result);
        }
        else return false;
    }

    function getHistoryOrdersByUser($userID) {
        global $dbLink;
        $user = [];
        $query = "SELECT * FROM orders WHERE user_id ='%d' ORDER BY date DESC";
        $query = sprintf($query, $userID);
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result)) {
            while($row = mysqli_fetch_assoc($result))
                array_push($user, $row);
            return $user;
        }
        else return false;
    }

    function getUserCartShort() {
        global $dbLink;
        $query = "SELECT DISTINCT c.id, c.summ, (SELECT COUNT(*) FROM cart_details WHERE cart_id = c.id) 
            as count FROM carts as c WHERE c.user_id = %d";
        $query = sprintf($query, getUserID());
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result))
            return mysqli_fetch_assoc($result);
        else return false;
    }

    function getUserCart() {
        global $dbLink;
        $query = "SELECT DISTINCT c.id, c.summ, c.count, (SELECT COUNT(*) FROM cart_details WHERE cart_id = c.id) 
            as stock FROM carts as c WHERE c.user_id = %d";
        $query = sprintf($query, getUserID());
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result))
            return mysqli_fetch_assoc($result);
        else return false;
    }
    
    function getUserCartID() {
        global $dbLink;
        $query = "SELECT id FROM carts WHERE user_id = %d";
        $query = sprintf($query, getUserID());
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result) > 0) return mysqli_fetch_assoc($result)["id"];
        else return false;
    }

    function getUserCartPositions() {
        global $dbLink;
        $cart = [];
        $query = "SELECT DISTINCT cd.item_id, cd.count, it.title, it.image, ip.price, ip.old_price FROM 
            cart_details as cd, carts as c, items as it, item_price as ip WHERE cd.cart_id = (SELECT id FROM carts WHERE user_id = %d) AND 
            it.id = cd.item_id AND ip.item_id = cd.item_id ORDER BY ip.price DESC";
        $query = sprintf($query, getUserID());
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result)) {
            while($row = mysqli_fetch_assoc($result))
                array_push($cart, $row);
            return $cart;
        }
        else return false;
    }

    function isUserHaveCart() {
        if(isUserLogged()) {
            global $dbLink;
            $query = "SELECT * FROM carts WHERE user_id = %d AND summ <> 0";
            $query = sprintf($query, getUserID());
            $result = mysqli_query($dbLink, $query);
            if(mysqli_num_rows($result) > 0) return true;
            else return false;
        }
        else return false;
    }

    function getUserProfileShort() {
        global $dbLink;
        $query = "SELECT name FROM users WHERE id = %d";
        $query = sprintf($query, getUserID());
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result))
            return mysqli_fetch_assoc($result);
        else return false;
    }

    function getOrderByID($orderID) {
        if(isUserLogged()) {
            global $dbLink;
            $query = "SELECT o.*, u.name, u.surname FROM orders as o, users as u WHERE o.id = %d AND o.user_id = u.id";
            $query = sprintf($query, $orderID);
            $result = mysqli_query($dbLink, $query);
            if(mysqli_num_rows($result))
                return mysqli_fetch_assoc($result);
            else return false;
        }
        else return false;
    }

    function getUserID() {
        global $dbLink;
        $query = "SELECT id FROM users WHERE hash = '%s' and ip = '%s'";
        $query = sprintf($query, getUserHash(), getUserIP());
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result))
            return mysqli_fetch_assoc($result)["id"];
        else return false;        
    }

    function getOrderDetailsByID($orderID) {
        global $dbLink;
        $order = [];
        $query = "SELECT * FROM order_details WHERE order_id = '%d'";
        $query = sprintf($query, $orderID);
        $result = mysqli_query($dbLink, $query);
        if(mysqli_num_rows($result)) {
            while($row = mysqli_fetch_assoc($result))
                array_push($order, $row);
            return $order;
        }
        else return false;        
    }
    
    function convertDate($date) {
        return date("d.m.Y H:i", strtotime($date));
    }

?>