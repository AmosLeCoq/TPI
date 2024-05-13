<?php
/**
 * @file      login.php
 * @author    Created by Amos Le Coq
 * @version   13.05.2024
 */

ob_start();
$title = "Login";
?>
    <section>
        <div>
            <div>
                <div>
                    <form method="post">
                        <h4>
                            Connectez-vous
                        </h4>
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
            </div>
        </div>
    </section>
<?php
$content = ob_get_clean();
require "gabarit.php";