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
function LoginIsCorrect($LoginUsername, $LoginPassword){

    $result = false;
    $strSeparator = '\'';
    $loginQuery = 'SELECT email, password, type, account_status FROM dbstage.users WHERE email ='.$strSeparator.$LoginUsername.$strSeparator.' AND password ='.$strSeparator.$LoginPassword.$strSeparator.';';

    require_once "dbConnector.php";
    $queryResult = executeQuerySelect($loginQuery);

    if($LoginPassword == $queryResult[0]["password"]){
        if ($queryResult[0]["account_status"] == 1){
            if($queryResult[0]["type"] == 1){
                return "admin";
            }
            return "user";
        }
        return "Inactif";
    }
    return "mdpFaux";
}