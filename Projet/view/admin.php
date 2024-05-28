<?php
/**
 * @file      admin.php
 * @author    Created by Amos Le Coq
 * @version   14.05.2024
 */
ob_start();
$title = "Administration";
?>

<?php if (isset($accounts)) : ?>
    <?php if ($accounts!=null) :     ?>
        <div>
            <h3>Activation de compte</h3>
            <?php foreach ($accounts as $account) : ?>
                <div>
                    <hr>
                    <p class="stage-description">Nom : <?= $account['last_name'] ?></p>
                    <p class="stage-description">Prénom : <?= $account['first_name'] ?></p>
                    <p class="stage-description">Email : <?= $account['email'] ?></p>
                    <form method="get">
                        <input type="hidden" name="parent" value="<?= $account['email'] ?>">
                        <input type="hidden" name="action" value="admin">
                        <input type="submit" name="answer" value="Accepter">
                        <input type="submit" name="answer" value="Refuser">
                    </form>
                </div>
            <?php endforeach;?>
        </div>
        <hr>
    <?php endif;?>
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

        <label for="status-select">Choisissez un statut:</label>
        <select name="status" required id="statut-select">
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
    <div>
        <hr>
        <h3>Gestion des comptes</h3>
        <label for="teacher">Type de compte :</label>
        <input type="radio" id="teacher" name="accountType" value="teacher" onchange="changeForm()">
        <label for="teacher">Enseignant</label>
        <br>
        <br>
        <label>Action :</label>
        <label for="create">Créer un compte</label>
        <input type="radio" id="create" name="action" value="create" onchange="changeForm()">

        <label for="edit">Modifier un compte</label>
        <input type="radio" id="edit" name="action" value="edit" onchange="changeForm()">

        <label for="delete">Supprimer un compte</label>
        <input type="radio" id="delete" name="action" value="delete" onchange="changeForm()">

        <br>
        <br>
        <form id="accountForm" method="post">
            <!-- Les champs spécifiques à chaque action seront ajoutés ici -->
        </form>
        <br>
        <br>
    </div>
    <script>
        function changeForm() {
            var action = document.querySelector('input[name="action"]:checked');
            var accountType = document.querySelector('input[name="accountType"]:checked');
            var form = document.getElementById("accountForm");

            // Effacer le formulaire précédent
            form.innerHTML = "";

            if (!accountType || !action) {
                // Ne rien faire tant que l'utilisateur n'a pas sélectionné à la fois le type de compte et l'action
                return;
            }

            // Créer un nouveau formulaire en fonction de l'action sélectionnée
            if (accountType.value === "teacher") {
                if (action.value === "create") {
                    form.innerHTML = `
            <label for="email">Adresse e-mail Enseignant :</label>
            <input type="email" id="email" name="email" required>
            <label for="nom">Nom Enseignant :</label>
            <input type="text" id="nom" name="nom" required>
            <label for="prenom">Prénom Enseignant :</label>
            <input type="text" id="prenom" name="prenom" required>
            <input type="hidden" name="type" value="create">
            <input type="hidden" name="action" value="admin">
            <button type="submit">Créer</button>
            `;
                } else if (action.value === "edit") {
                    form.innerHTML = `
            <label for="oldEmail">Actuelle adresse e-mail Enseignant :</label>
            <input type="email" id="oldEmail" name="oldEmail" required>
            <label for="newEmail">Nouvelle adresse e-mail Enseignant :</label>
            <input type="email" id="newEmail" name="newEmail" required>
            <label for="newName">Nouveau nom Enseignant :</label>
            <input type="text" id="newName" name="newName" required>
            <label for="newFirstName">Nouveau prénom Enseignant :</label>
            <input type="text" id="newFirstName" name="newFirstName" required>
            <input type="hidden" name="type" value="modify">
            <input type="hidden" name="action" value="admin">
            <button type="submit">Modifier</button>
            `;
                } else if (action.value === "delete") {
                    form.innerHTML = `
            <label for="emailToDelete">Adresse e-mail Enseignant à supprimer :</label>
            <input type="email" id="emailToDelete" name="emailToDelete" required>
            <input type="hidden" name="type" value="delete">
            <input type="hidden" name="action" value="admin">
            <button type="submit">Supprimer</button>
            `;
                }
            } else if (accountType.value === "parent") {
                if (action.value === "edit") {
                    form.innerHTML = `
            <label for="oldEmail">Actuelle adresse e-mail Parent :</label>
            <input type="email" id="oldEmail" name="oldEmail" required>
            <label for="newEmail">Nouvelle adresse e-mail Parent :</label>
            <input type="email" id="newEmail" name="newEmail" required>
            <label for="newName">Nouveau nom Parent :</label>
            <input type="text" id="newName" name="newName" required>
            <label for="newFirstName">Nouveau prénom Parent :</label>
            <input type="text" id="newFirstName" name="newFirstName" required>
            <input type="hidden" name="type" value="modify">
            <input type="hidden" name="action" value="admin">
            <button type="submit">Modifier</button>
            `;
                } else if (action.value === "delete") {
                    form.innerHTML = `
            <label for="emailToDelete">Adresse e-mail Parent à désactiver :</label>
            <input type="email" id="emailToDelete" name="emailToDelete" required>
            <input type="hidden" name="type" value="delete">
            <input type="hidden" name="action" value="admin">
            <button type="submit">Désactiver</button>
            `;
                }
            }
        }
    </script>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>