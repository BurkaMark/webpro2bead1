<?php
    require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
        require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="container_data">
    <h1>Tanösvények keresése</h1>

    <div class="wrapper_data">
        <h3>Keresés tanösvény neve alapján:</h3>
        <form action="<?php echo URLROOT; ?>/trails/getTrailByName" method ="POST">
            <input type="text" placeholder="Tanösvény neve" name="name">
            <button id="submit" type="submit" value="submit">Keresés</button>
            <span class="invalidFeedback">
                <?php echo $data['nameError']; ?>
            </span>
        </form>
        <span class="invalidFeedback">
            <?php echo $data['trailError']; ?>
        </span>

        <h3>Keresés település neve alapján:</h3>
        <form action="<?php echo URLROOT; ?>/trails/getTrailBySettlement" method ="POST">
            <input type="text" placeholder="A település neve" name="settlement">
            <button id="submit" type="submit" value="submit">Keresés</button>
            <span class="invalidFeedback">
                <?php echo $data['nameError']; ?>
            </span>
        </form>
        <span class="invalidFeedback">
            <?php echo $data['setlmError']; ?>
        </span>

        <h3>Keresés nemzeti park neve alapján:</h3>
        <form action="<?php echo URLROOT; ?>/trails/getTrailByNationalPark" method ="POST">
            <input type="text" placeholder="A nemzeti park neve" name="nat_park">
            <button id="submit" type="submit" value="submit">Kersés</button>
            <span class="invalidFeedback">
                <?php echo $data['nameError']; ?>
            </span>
        </form>
        <span class="invalidFeedback">
            <?php echo $data['npError']; ?>
        </span>
    </div>
    
    <?php if(!empty($data['trail'])): ?>
        <div id="trail_item">
            <table>
                <tr>
                    <td>Tanösvény neve:</td>
                    <td><?php echo $data['trail']['name']; ?></td>
                </tr>
                <tr>
                    <td>Hossza:</td>
                    <td><?php echo $data['trail']['length']; ?></td>
                </tr>
                <tr>
                    <td>Állomások száma:</td>
                    <td><?php echo $data['trail']['stops']; ?></td>
                </tr>
                <tr>
                    <td>A tanösvény bejárásához szükséges idő:</td>
                    <td><?php echo $data['trail']['time']; ?></td>
                </tr>
                <tr>
                    <td>Van idegenvezetés?</td>
                    <td><?php if($data['trail']['guide'] == 0): ?>Igen<?php else: ?>Nem<?php endif; ?></td>
                </tr>
                <tr>
                    <td>A település neve, amelyhez a tanösvény tartozik:</td>
                    <td><?php echo $data['trail']['setlement']; ?></td>
                </tr>
                <tr>
                    <td>A nemzeti park, amelyhez a tanösvény tartozik:</td>
                    <td><?php echo $data['trail']['np']; ?></td>
                </tr>
            </table>
        </div>
    <?php endif; ?>
</div>
</body>