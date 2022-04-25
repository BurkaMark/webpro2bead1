<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container_center">
    <h1>Hírek és bejegyzések</h1>

    <?php if(isLoggedIn()): ?>
        <a class="create_post" href="<?php echo URLROOT; ?>/posts/create">Új bejegyzés</a>
    <?php endif; ?>

    <?php foreach($data['posts'] as $post): ?>
        <div id="posts_container">
            <h2>
                <?php echo $post->cim; ?>
            </h2>

            <h3>
                <?php echo 'Létrehozva: ' . $post->letrehozva; ?>
            </h3>

            <?php if($post->modositva > "0000-00-00 00:00:00"): ?>
                <h3>
                    <?php echo 'Módosítva: ' . $post->modositva; ?>
                </h3>
            <?php endif; ?>

            <p>
                <?php echo $post->tartalom ?>
            </p>
        </div>

        <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post->userid): ?>
            <a class="change" href="<?php echo URLROOT . "/posts/update/" . $post->id ?>">Módosítás</a>

            <form action="<?php echo URLROOT . "/posts/delete/" . $post->id ?>" method="POST">
                <input type="submit" name="delete" value="Delete" class="delete">
            </form>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
</body>