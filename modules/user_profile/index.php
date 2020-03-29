<?php $userProfile = getUserProfileShort(); ?>

<a class="profile" href="/profile" title="Личный кабинет">
    <div class="profile-icon">
        <img src="/uploads/system/profile.png">
    </div>
    <div class="profile-block">
        <div class="profile-block-title">
            Личный кабинет
        </div>
        <div class="profile-block-user">
            <?php if($userProfile !== false): ?>
                <?=$userProfile["name"]?>
            <?php endif; ?>
        </div>
    </div>
</a>