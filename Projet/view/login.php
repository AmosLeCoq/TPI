<?php
/**
 * @file      login.php
 * @author    Created by Amos Le Coq
 * @version   13.05.2024
 */

ob_start();
$title = "Login";
?>
<div>
    <h4>
        Connectez-vous
    </h4>
    <form method="post">
        <div>
            <input type="email" name="email" placeholder="Adresse email">
        </div>
        <div>
            <input type="password" name="userPswd" placeholder="Mot de passe">
        </div>
        <input type="submit" value="login"><br>
        <input type="reset" value="Annuler">
    </form>
</div>
<hr>
<div>
    <h4>
        Demande d'accès pour les parents
    </h4>
    <script>
        function checkPasswordMatch() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (password != confirmPassword) {
                alert("Les mots de passe ne correspondent pas !");
                return false;
            }
            return true;
        }
    </script>

    <form method="post" onsubmit="return checkPasswordMatch();" action="index.php?action=login">
        <input type="text" name="last_name" placeholder="Nom" required><br>
        <input type="text" name="first_name" placeholder="Prénom" required><br>
        <input type="email" name="email" placeholder="Adresse email" required><br>
        <input type="password" name="password" id="password" placeholder="Mot de passe" required><br>
        <input type="password" id="confirm_password" placeholder="Confirmer le mot de passe" required><br>
        <input type="submit" value="Demande"><br>
        <input type="reset" value="Annuler">
    </form>
</div>

<?php
$content = ob_get_clean();
require "gabarit.php";