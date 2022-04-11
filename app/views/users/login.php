<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
        require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container-login">
    <div class="wrapper-login">
        <h2>Sign in</h2>

        <form action="<?php echo URLROOT; ?>/users/login" method ="POST">
            <input type="text" placeholder="Felhasználói név *" name="username">
            <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
            </span>

            <input type="password" placeholder="Jelszó *" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>

            <button id="submit" type="submit" value="submit">Küldés</button>

            <p class="options">Még nem regisztrált? <a href="<?php echo URLROOT; ?>/users/register">Hozzon létre egy felhasználói fiókot!</a></p>
        </form>
    </div>
</div>
</body>