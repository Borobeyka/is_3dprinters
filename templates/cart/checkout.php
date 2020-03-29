<?php
    if(!isUserHaveCart()) redirect("/");
    $user = getUserInfo();
    $userCart = getUserCart();
    $userCartPositions = getUserCartPositions();
    $counter = 1;

    $data = $_POST;
    $customerError = "";
    if(!empty($data["submit"])) {
        if(empty($data["name"])) $customerError = "Необходимо ввести имя получателя";
        else if(empty($data["surname"])) $customerError = "Необходимо ввести фамилию получателя";
        else if(empty($data["email"])) $customerError = "Необходимо ввести E-Mail адрес получателя";
        else if(empty($data["phone"])) $customerError = "Необходимо ввести телефон получателя";
        if(strlen($customerError) == 0) {
            global $dbLink;
            $query = "INSERT INTO orders VALUES(NULL, %d, %d, %d, NOW(), DEFAULT)";
            $query = sprintf($query, getUserID(), $userCart["summ"], $userCart["stock"]);
            mysqli_query($dbLink, $query);

            $query = "SELECT LAST_INSERT_ID()";
            $result = mysqli_query($dbLink, $query);
            $orderID = mysqli_fetch_assoc($result)["LAST_INSERT_ID()"];

            foreach($userCartPositions as $position) {
                $query = "INSERT INTO order_details VALUES(NULL, %d, %d, %d, '%s', %d)";
                $query = sprintf($query, $orderID, $position["item_id"], $position["count"], $position["title"], $position["price"]);
                mysqli_query($dbLink, $query);

                $query = "DELETE FROM cart_details WHERE item_id = %d AND cart_id = %d";
                $query = sprintf($query, $position["item_id"], getUserCartID());
                mysqli_query($dbLink, $query);
            }
            redirect("/order/".$orderID);
        }
    }

?>

<h1 class="block-title">Оформление заказа</h1>

<form action="" method="POST" class="order-checkout">
    <h1 class="block-subtitle">Данные получателя</h1>
    <div class="customer-data-error"><?=$customerError?></div>
    <div class="customer-data">
        <div>
            <div class="row">
                <div class="title">Имя:</div>
                <div class="field">
                    <input type="text" name="name" value="<?=$user["name"]?>">
                </div>
            </div>
            <div class="row">
                <div class="title">Фамилия:</div>
                <div class="field">
                    <input type="text" name="surname" value="<?=$user["surname"]?>">
                </div>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="title">E-Mail:</div>
                <div class="field">
                    <input type="text" name="email" value="<?=$user["email"]?>">
                </div>
            </div>
            <div class="row">
                <div class="title">Телефон:</div>
                <div class="field">
                    <input type="text" name="phone" value="<?=$user["phone"]?>" id="phone">
                </div>
            </div>
        </div>
    </div>

    <h1 class="block-subtitle">Детали заказа</h1>
    <table class="cart-table">
        <tr>
            <th># п/п</th>
            <th>Изображение</th>
            <th>Название</th>
            <th>Цена</th>
            <th>Количество</th>
            <th>Стоимость</th>
        </tr>
        <?php foreach($userCartPositions as $position): ?>
            <tr>
                <td>
                    <?=$counter++?>
                </td>
                <td>
                    <img src="/uploads/items/<?=$position["image"]?>">
                </td>
                <td>
                    <?=$position["title"]?>
                </td>
                <td>
                    <?php if($position["old_price"] != 0): ?>
                        <div class="old-price">
                            <?=$position["old_price"]?> руб.
                        </div>
                    <?php endif;?>
                        <?=$position["price"]?> руб.
                </td>
                <td>
                    <?=$position["count"]?> шт.
                </td>
                <td>
                    <?=$position["price"] * $position["count"]?> руб.
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <h1 class="block-subtitle">Позиций в заказе <?=$userCart["stock"]?>, на сумму <?=$userCart["summ"]?> руб.</h1>

    <input type="submit" name="submit" class="checkout-button" value="Оформить заказ">
</form>