<?php
/**
 * @file      stage.php
 * @author    Created by Amos Le Coq
 * @version   21.05.2024
 */

ob_start();
$title = "Stage";
?>

<form method="get">
    <input type="button" name="">
<?php foreach ($branchs as $branch) : ?>é

<?php endforeach;?>
    <h3>Recherche de stage</h3>
    <form method="get">
        <input type="text" name="search" placeholder="Recherche">
        <input type="date" name="date">
        <input type="submit">
    </form>

<?php foreach ($stages as $stage) : ?>
    <div class="stage">
        <h2 class="stage-title"><?= $stage['name'] ?></h2>
        <p class="stage-description">Branche : <?= $stage['branchs_id'] ?></p>
        <p class="stage-description">Status : <?= $stage['status_id'] ?></p>
        <p class="stage-description">Enseignant : <?= $stage['teachers_id'] ?></p>
        <p class="stage-description">Description : <?= $stage['description'] ?></p>
        <p class="stage-description">Du <?= $stage['start_date'] ?> au <?= $stage['end_date'] ?></p>
        <p class="stage-description">De <?= $stage['start_time'] ?> à <?= $stage['end_time'] ?></p>
        <p class="stage-description"><?= $stage['number_registrants'] ?>/<?= $stage['max_people'] ?> Personnes</p>
    </div>
    <br>
<?php endforeach;?>




<?php
$content = ob_get_clean();
require "gabarit.php";
?>