<?php
/**
 * @file      users.php
 * @author    Created by Amos Le Coq
 * @version   13.05.2024
 */


function login($LoginInfo)
{
    if(isset($LoginInfo['email']) && isset($LoginInfo['userPswd'])){
        $LoginUsername = $LoginInfo['email'];
        $LoginPassword = $LoginInfo['userPswd'];
        $LoginPassword = hash('sha256', $LoginPassword);

        require_once "model/userManager.php";

        $login=LoginIsCorrect($LoginUsername, $LoginPassword);

        switch($login){
            case "admin":
                session_start();
                $_SESSION['type'] = "admin";
                break;
            case "user":
                session_start();
                $_SESSION['type'] = "user";
                break;
            case "Inactif":
                echo "";
                break;
            case "mdpFaux":
                break;
        }
    }
    require "view/login.php";
}