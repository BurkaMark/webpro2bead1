<nav class="top-nav">
    <ul>
        <li>
            <a href="<?php echo URLROOT; ?>/index">Főoldal</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/posts">Hírek és bejegyzések</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/trails">Tanösvények</a>
        </li>
        <li>
            <a href="<?php echo URLROOT; ?>/mnb">MNB</a>
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