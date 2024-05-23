<?php
/**
 * @file      userManager.php
 * @author    Created by Amos Le Coq
 * @version   13.05.2024
 */

/**
 * Cette fonction compare les deux mots de passe et retourne le type d'utilisateur qui souhaite se connecter.
 * @param $LoginUsername
 * @param $LoginPassword
 * @return string
 */
function LoginIsCorrect($LoginUsername, $LoginPassword)
{
    $result = false;
    $strSeparator = '\'';
    $loginQuery = 'SELECT id, email, password, type, account_status FROM tpi_lqa_dbstage.users WHERE email =' . $strSeparator . $LoginUsername . $strSeparator .';';

    require_once "dbConnector.php";
    $queryResult = executeQuerySelect($loginQuery);

    if (isset($queryResult[0])) {
        if ($LoginPassword == $queryResult[0]["password"]) {
            if ($queryResult[0]["account_status"] == 1) {
                if ($queryResult[0]["type"] == 1) {
                    return "admin";
                }
                return "user";
            }
            return "inactif";
        }
        return "mdpFaux";
    }
    return "mailFaux";
}
function getChildrens($mail)
{
    $strSeparator = '\'';
    $Query = 'SELECT c.* FROM tpi_lqa_dbstage.childs c JOIN tpi_lqa_dbstage.Users u ON c.Users_id = u.id WHERE u.email =' . $strSeparator . $mail . $strSeparator .';';
    // Executez votre requête ici et stockez le résultat dans la variable $result
    // Assurez-vous d'adapter cette partie selon le système de base de données que vous utilisez (MySQL, etc.)
    require_once "dbConnector.php";
    return executeQuerySelect($Query);
}

function registerCourse($child,$course)
{
    $strSeparator = '\'';
    $Query = "INSERT INTO tpi_lqa_dbstage.childs_register_internships (childs_id, internships_id) VALUES ('$child', '$course')";
    require_once "dbConnector.php";
    executeQueryInsert($Query);
}