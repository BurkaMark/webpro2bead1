<nav class="top-nav">
    <ul>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/index">Főoldal</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/about">Rólunk</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/news">Hírek</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/trails">Tanösvények</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/mnb">MNB</a>
        </li>
        <li class="btn_login">
            <?php if(isset($_SESSION['user_id'])) : ?>
                <a href="<?php echo URLROOT; ?>/users/logout">Kijelentkezés</a>
            <?php else : ?>
                <a href="<?php echo URLROOT; ?>/users/login">Bejelentkezés</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>