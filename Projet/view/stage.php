<?php
/**
 * @file      stage.php
 * @author    Created by Amos Le Coq
 * @version   21.05.2024
 */

ob_start();
$title = "Stage";
?>

<h3>Recherche de stage</h3>
<form method="get">
    <input type="submit" name="filter" value="">
    <?php foreach ($branchs as $branch) : ?>
        <input type="hidden" name="action" value="stage">
        <input type="submit" name="filter" value="<?= $branch['name'] ?>">
    <?php endforeach;?>
    <br><br>
    <input type="number" name="year" placeholder="Année">
    <input type="submit" value="Filtrer">

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
        <p class="stage-description">Prix : <?= $stage['price'] ?> CHF</p>


        <?php if (isset($_SESSION['type'])) : ?>
            <!-- Gestion des inscriptions pour les parents -->
            <?php if ($_SESSION['type']=="user") : ?>
                <form method="get">
                    <input type="hidden" name="stage" value="<?= $stage['id'] ?>">
                    <label class="stage-description" for="branch-select">Pour qui ?</label>
                    <select name="child" required id="child-select">
                        <option value="">--Choisissez un enfant--</option>
                        <?php foreach ($childs as $child) : ?>
                            <option value="<?= $child["id"] ?>"><?= $child["first_name"] ?> <?= $child["last_name"] ?></option>
                        <?php endforeach;?>
                    </select><br>
                    <input type="hidden" name="action" value="stage">
                    <input type="submit" value="Inscrire">
                </form>
            <?php endif;?>
            <!-- Gestion des status pour les admins -->
            <?php if ($_SESSION['type']=="admin") : ?>
                <form method="get">
                    <label for="pet-select" class="stage-description">Changer le status:</label>
                    <select name="mv-status" id="status-select">
                        <?php foreach ($status as $statu) : ?>
                            <option value="<?= $statu["name"] ?>"><?= $statu["name"] ?></option>
                        <?php endforeach;?>
                    </select>
                    <input type="hidden" name="nom" value="<?= $stage["name"] ?>">
                    <input type="hidden" name="date" value="<?= $stage["start_date"] ?>">
                    <input type="hidden" name="action" value="stage">
                    <input type="hidden" name="stage" value=<?= $stage["id"] ?>>
                    <input type="submit" value="Changer">
                </form>
            <?php endif;?>
        <?php endif;?>

    </div>
    <br>
<?php endforeach;?>
<?php
$content = ob_get_clean();
require "gabarit.php";
?>