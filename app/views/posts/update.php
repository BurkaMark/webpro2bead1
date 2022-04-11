<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar dark">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container center">
    <h1>Bejegyzés módosítása</h1>

    <form action="<?php echo URLROOT; ?>/posts/update/<?php echo $data['post']->id ?>" method="POST">
        <div class="form-item">
            <input type="text" name="title" value="<?php echo $data['post']->title ?>">

            <span class="invalidFeedback">
                <?php echo $data['titleError']; ?>
            </span>
        </div>

        <div class="form-item">
            <textarea name="body" placeholder="Bejegyzés tartalma..."> <?php echo $data['post']->body ?></textarea>

            <span class="invalidFeedback">
                <?php echo $data['bodyError']; ?>
            </span>
        </div>

        <button class="btn green" name="submit" type="submit">Küldés</button>
    </form>
</div>
</body>