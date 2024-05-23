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

/**
 * Inscrit un enfant a un stage
 * @param $child
 * @param $course
 * @return void
 */
function registerCourse($child,$course)
{
    $strSeparator = '\'';
    $Query = "INSERT INTO tpi_lqa_dbstage.childs_register_internships (childs_id, internships_id) VALUES ('$child', '$course')";
    require_once "dbConnector.php";
    executeQueryInsert($Query);
}

function getRegister($mail)
{
    $query = "SELECT i.name AS stage_name, i.start_date, i.end_date, i.start_time, i.end_time, i.price, s.name AS status, c.first_name AS child_first_name, c.last_name AS child_last_name FROM internships i JOIN childs_register_internships cri ON i.id = cri.internships_id JOIN childs c ON cri.childs_id = c.id JOIN Users u ON c.Users_id = u.id JOIN status s ON i.status_id = s.id WHERE u.email = '$mail' ORDER BY c.first_name, c.last_name;";
    require_once "dbConnector.php";
    return executeQuerySelect($query);
}

function addChild($first_name,$last_name,$mail)
{
    $query = "INSERT INTO childs (first_name, last_name, Users_id) SELECT '$first_name', '$last_name', id FROM Users WHERE email = '$mail';";
    require_once "dbConnector.php";
    executeQueryInsert($query);
}