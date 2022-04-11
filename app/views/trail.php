<?php
    require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
        require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container">
    <h1>Tanösvények keresése</h1>

    <h3>Keresés tanösvény neve alapján:</h3>
    <form action="<?php echo URLROOT; ?>/trails/getTrailByName" method ="POST">
        <input type="text" placeholder="Tanösvény neve" name="name">
        <span class="invalidFeedback">
            <?php echo $data['nameError']; ?>
        </span>
        <button id="submit" type="submit" value="submit">Keresés</button>
    </form>

    <h3>Keresés település neve alapján:</h3>
    <form action="<?php echo URLROOT; ?>/trails/getTrailBySettlement" method ="POST">
        <input type="text" placeholder="A település neve" name="settlement">
        <span class="invalidFeedback">
            <?php echo $data['nameError']; ?>
        </span>
        <button id="submit" type="submit" value="submit">Keresés</button>
    </form>

    <h3>Keresés nemzeti park neve alapján:</h3>
    <form action="<?php echo URLROOT; ?>/trails/getTrailByNationalPark" method ="POST">
        <input type="text" placeholder="A nemzeti park neve" name="nat_park">
        <span class="invalidFeedback">
            <?php echo $data['nameError']; ?>
        </span>
        <button id="submit" type="submit" value="submit">Kersés</button>
    </form>

    <span class="invalidFeedback">
        <?php echo $data['trailError']; ?>
    </span>
    <span class="invalidFeedback">
        <?php echo $data['setlmError']; ?>
    </span>
    <span class="invalidFeedback">
        <?php echo $data['npError']; ?>
    </span>

    <?php foreach($data['trail'] as $trail): ?>
        <div class="container-item">
            <p>
                Tanösvény neve: <?php echo $trail->name; ?><br>
                Hossza: <?php echo $trail->length; ?><br>
                Állomások száma: <?php echo $trail->stops; ?><br>
                A tanösvény bejárásához szükséges idő: <?php echo $trail->time; ?><br>
                Van idegenvezetés? <?php if($trail->guide == 0): ?>Igen<?php else: ?>Nem<?php endif; ?><br>
                A település neve, amelyhez a tanösvény tartozik: <?php echo $trail->setlement; ?><br>
                A nemzeti park, amelyhez a tanösvény tartozik: <?php echo $trail->np; ?><br>
            </p>
        </div>
    <?php endforeach; ?>
</div>
</body>