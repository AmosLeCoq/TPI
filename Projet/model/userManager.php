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
    $Query = 'SELECT c.* FROM tpi_lqa_dbstage.childs c JOIN tpi_lqa_dbstage.Users u ON c.Users_id = u.id WHERE u.email ='. $strSeparator . $mail . $strSeparator .';';
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

/**
 * Ajoute un enfant à un compte parent
 * @param $first_name
 * @param $last_name
 * @param $mail
 * @return void
 */
function addChild($first_name,$last_name,$mail)
{
    $query = "INSERT INTO childs (first_name, last_name, Users_id) SELECT '$first_name', '$last_name', id FROM Users WHERE email = '$mail';";
    require_once "dbConnector.php";
    executeQueryInsert($query);
}

/**
 * Premet d'acctiver un compte parent
 * @param $mail
 * @return void
 */
function addParent($mail)
{
    $query = "UPDATE Users SET account_status = 1 WHERE email = '$mail';";
    require_once "dbConnector.php";
    executeQueryUpdate($query);
}

/**
 * Premet de supprimer un utilisateur à partir de son mail
 * @param $mail
 * @return void
 */
function rmParent($mail)
{
    $query = "DELETE FROM tpi_lqa_dbstage.Users WHERE email = '$mail';";
    require_once "dbConnector.php";
    executeQueryDelete($query);
}

/**
 * Ajoute un parent à la DB
 * @param $first_name
 * @param $last_name
 * @param $mail
 * @param $password
 * @return void
 */
function createParent($first_name,$last_name,$mail,$password)
{
    $query = "INSERT INTO tpi_lqa_dbstage.Users (first_name, last_name, email, type, account_status, password) VALUES ('$first_name', '$last_name', '$mail', 0, 0, '$password');";
    require_once "dbConnector.php";
    executeQueryInsert($query);
}

/**
 * Permet d'envoyer un mail
 * @param $mail
 * @param $msg
 * @param $subject
 * @return void
 */
function sendMailTo($mail,$msg,$subject)
{
    // Paramètres SMTP de SwissCenter
    $smtpHost = 'mail01.swisscenter.com'; // Remplacez par le serveur SMTP de SwissCenter
    $smtpUsername = 'testmail@tpilqa.mycpnv.ch'; // Remplacez par votre nom d'utilisateur SMTP
    $smtpPort = 587; // Le port SMTP utilisé par SwissCenter (peut varier, vérifiez avec SwissCenter)

    // Destinataire et autres détails de l'e-mail
    $to = $mail;
    $headers = "Content-Type: text/plain; charset=UTF-8\r\n";

    // Configuration des paramètres pour la fonction mail()
    ini_set("SMTP", $smtpHost);
    ini_set("smtp_port", $smtpPort);
    ini_set("sendmail_from", $smtpUsername);


    mail($to, $subject, $msg, $headers);
}

/**
 * Retourne toutes les inscriptions à un stage
 * @param $stage
 * @return void
 */
function getParent($stage)
{
    $query = "SELECT u.id AS parent_id, u.first_name AS parent_first_name, u.last_name AS parent_last_name, u.email AS parent_email, c.id AS child_id, c.first_name AS child_first_name, c.last_name AS child_last_name FROM Users u INNER JOIN childs c ON u.id = c.Users_id INNER JOIN childs_register_internships cri ON c.id = cri.childs_id INNER JOIN internships i ON cri.internships_id = i.id WHERE i.id = '$stage';";
    require_once "dbConnector.php";
    return executeQuerySelect($query);
}