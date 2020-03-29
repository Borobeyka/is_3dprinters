<?php $userCart = getUserCartShort(); ?>

<a class="cart" href="/cart" title="Корзина">
    <div class="cart-icon">
        <img src="/uploads/system/cart.png">
    </div>
    <div class="cart-block">
        <div class="cart-block-title">
            Корзина
        </div>
        <?php if($userCart !== false && $userCart["count"] > 0): ?>
            <div class="cart-block-items">
                <?=$userCart["count"]?> поз. на <?=$userCart["summ"]?> руб.
            </div>
        <?php else: ?>
            <div class="cart-block-items">
                Корзина пуста
            </div>
        <?php endif; ?>
    </div>
</a>
