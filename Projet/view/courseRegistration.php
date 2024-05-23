<?php
/**
 * @file      courseRegistration.php
 * @author    Created by Amos Le Coq
 * @version   23.05.2024
 */
ob_start();
$title = "Liste des inscriptions";
?>

<h2 class="stage-title">Ajouter un enfant :</h2>
<form method="get">
    <input type="text" name="first_name" placeholder="Prénom" required>
    <input type="text" name="last_name" placeholder="Nom" required>
    <input type="hidden" name="user_mail" value="<?= $_SESSION['mail'] ?>">
    <input type="hidden" name="action" value="parent">
    <input type="submit" value="Ajouter">
</form>

<h2 class="stage-title">Inscription :</h2>
<?php foreach ($courses as $course) : ?>
    <div class="stage">
        <h2 class="stage-title"><?= $course['stage_name'] ?></h2>
        <p class="stage-description">Status : <?= $course['status'] ?></p>
        <p class="stage-description">De <?= $course['start_date'] ?> à <?= $course['end_date'] ?></p>
        <p class="stage-description">De <?= $course['start_time'] ?> à <?= $course['end_time'] ?></p>
        <p class="stage-description">prix : <?= $course['price'] ?></p>
        <p class="stage-description"><?= $course['child_first_name'] ?> <?= $course['child_last_name'] ?></p>
    </div>
    <br>
<?php endforeach;?>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>