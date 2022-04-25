<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container_login">
    <div class="wrapper_login">
        <h2>Register</h2>

        <form action="<?php echo URLROOT; ?>/users/register" method="POST">
            <input type="text" placeholder="Felhasználói név *" name="username">
            <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
            </span>

            <input type="text" placeholder="E-mail cím *" name="email">
            <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>

            <input type="password" placeholder="Jelszó *" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>

            <input type="password" placeholder="Jelszó konfirmálása *" name="confirmPassword">
            <span class="invalidFeedback">
                <?php echo $data['confirmPasswordError']; ?>
            </span>

            <input type="text" placeholder="Vezetéknév *" name="lastName">
            <span class="invalidFeedback">
                <?php echo $data['lastNameError']; ?>
            </span>

            <input type="text" placeholder="Keresztnév *" name="firstName">
            <span class="invalidFeedback">
                <?php echo $data['firstNameError']; ?>
            </span>

            <button class="submit" type="submit" value="submit">Regisztrálás</button>
        </form>
    </div>
</div>
</body>