<?php
/**
 * @file      users.php
 * @author    Created by Amos Le Coq
 * @version   13.05.2024
 */

/**
 * Vérification des infos de connexion
 * @param $LoginInfo
 * @return void
 */
function login($LoginInfo)
{
    if(isset($LoginInfo['email']) && isset($LoginInfo['userPswd'])){
        $LoginUsername = $LoginInfo['email'];
        $LoginPassword = $LoginInfo['userPswd'];
        $LoginPassword = hash('sha256', $LoginPassword);

        require_once "model/userManager.php";

        $login=LoginIsCorrect($LoginUsername, $LoginPassword);
        session_destroy();
        // Gestion de connexion et d'erreur de connexion
        switch($login){
            case "admin":
                session_start();
                $_SESSION['type'] = "admin";
                $_SESSION['mail'] = $LoginInfo['email'];
                displayAdmin();
                exit();
            case "user":
                session_start();
                $_SESSION['type'] = "user";
                $_SESSION['mail'] = $LoginInfo['email'];
                displayStage();
                exit();
            case "inactif":
                echo '<script>alert("Votre compte n est pas activé")</script>';
                displayStage();
                exit();
            case "mdpFaux":
                echo '<script>alert("Votre mot de passe est faux")</script>';
                break;
            case "mailFaux":
                echo '<script>alert("Votre email est faux")</script>';
                break;
        }
    }
    require "view/login.php";
}

/**
 * Premet de ce déconnecter
 * @return void
 */
function logout(){
    session_destroy();
    header("Location: index.php"); // Rediriger vers la page d'accueil
    exit;
}