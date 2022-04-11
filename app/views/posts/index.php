<?php
   require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
       require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container">
    <h1>Hírek és bejegyzések</h1>

    <?php if(isLoggedIn()): ?>
        <a class="btn green" href="<?php echo URLROOT; ?>/posts/create">Új bejegyzés</a>
    <?php endif; ?>

    <?php foreach($data['posts'] as $post): ?>
        <div class="container-item">
            <?php if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post->user_id): ?>
                <a class="btn orange" href="<?php echo URLROOT . "/posts/update/" . $post->id ?>">Módosítás</a>

                <form action="<?php echo URLROOT . "/posts/delete/" . $post->id ?>" method="POST">
                    <input type="submit" name="delete" value="Delete" class="btn red">
                </form>
            <?php endif; ?>

            <h2>
                <?php echo $post->cim; ?>
            </h2>

            <h3>
                <?php echo $post->letrehozva; ?>
            </h3>

            <p>
                <?php echo $post->tartalom ?>
            </p>
        </div>
    <?php endforeach; ?>
</div>
</body>