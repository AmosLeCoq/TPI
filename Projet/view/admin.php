<?php
/**
 * @file      admin.php
 * @author    Created by Amos Le Coq
 * @version   14.05.2024
 */
ob_start();
$title = "Administration";
?>

<?php if ($accounts!=null) : ?>
    <div>
        <h3>Activation de compte</h3>
        <?php foreach ($accounts as $account) : ?>
            <div>
                <p class="stage-description">Nom : <?= $account['last_name'] ?></p>
                <p class="stage-description">Prénom : <?= $account['first_name'] ?></p>
                <p class="stage-description">Email : <?= $account['email'] ?></p>
            </div>
        <?php endforeach;?>
    </div>
    <hr>
<?php endif;?>


<div>
    <h3>Gestion de Stage</h3>
    <form method="get">
        <input type="text" name="nomStage" placeholder="Nom du stage" required>

        <label for="branch-select">Choisissez une branche:</label>
        <select name="branch" required id="branch-select">
            <option value="">--Choisissez une branche--</option>
            <?php foreach ($branchs as $branch) : ?>
                <option value="<?= $branch["name"] ?>"><?= $branch["name"] ?></option>
            <?php endforeach;?>
        </select>

        <label for="branch-select">Choisissez un enseignant:</label>
        <select name="enseignant" required id="enseignant-select">
            <option value="">--Choisissez un enseignant--</option>
            <?php foreach ($enseignants as $enseignant) :
                $enseignantNom = $enseignant["first_name"]."  ".$enseignant["last_name"]?>
                <option value="<?=$enseignantNom ?>"><?=$enseignantNom ?></option>
            <?php endforeach;?>
        </select>

        <label for="status-select">Choisissez un status:</label>
        <select name="status" required id="status-select">
            <option value="">--Choisissez un status--</option>
            <?php foreach ($status as $statu) : ?>
                <option value="<?=$statu["name"] ?>"><?=$statu["name"] ?></option>
            <?php endforeach;?>
        </select>

        <p><label for="description">Description du stage:</label></p>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea>

        <p>Date de début</p>
        <input type="date" name="dateDebut" required>
        <p>Date de Fin</p>
        <input type="date" name="dateFin" required>

        <p>Heure de début</p>
        <input type="time" name="heureDebut" required>
        <p>Heure de Fin</p>
        <input type="time" name="heureFin" required>
        <p>Prix</p>
        <input type="number" name="prix" required>
        <p>Nombre de personne max</p>
        <input type="number" name="max" required>
        <input type="hidden" name="action" value="admin">
        <input type="submit">
    </form>
    <br>
    <br>
</div>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>