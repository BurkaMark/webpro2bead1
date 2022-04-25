<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container_center">
    <h1>Bejegyzés módosítása</h1>

    <form action="<?php echo URLROOT; ?>/posts/update/<?php echo $data['post']->id ?>" method="POST">
        <div class="form_item">
            <input type="text" name="title" value="<?php echo $data['post']->cim ?>">

            <span class="invalidFeedback">
                <?php echo $data['titleError']; ?>
            </span>
        </div>

        <div class="form-item">
            <textarea name="body" placeholder="Bejegyzés tartalma..."> <?php echo $data['post']->tartalom ?></textarea>

            <span class="invalidFeedback">
                <?php echo $data['bodyError']; ?>
            </span>
        </div>

        <button class="create" name="submit" type="submit">Módosítás</button>
    </form>
</div>
</body>