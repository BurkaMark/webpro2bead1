<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container_center">
    <h1>Új bejegyzés létrehozása</h1>

    <form action="<?php echo URLROOT; ?>/posts/create" method="POST">
        <div class="form_item">
            <input type="text" name="title" placeholder="Cím...">

            <span class="invalidFeedback">
                <?php echo $data['titleError']; ?>
            </span>
        </div>

        <div class="form-item">
            <textarea name="body" placeholder="Bejegyzés tartalma..."></textarea>

            <span class="invalidFeedback">
                <?php echo $data['bodyError']; ?>
            </span>
        </div>

        <button class="create_post" name="submit" type="submit">Létrehozás</button>
    </form>
</div>
</body>