<?php
/**
 * @file      index.php
 * @author    Created by Amos Le Coq
 * @version   06.05.2024
 */
require "controller/navigation.php";
require "controller/users.php";

if (isset($_GET['action']))
{
    $action = $_GET['action'];
    switch ($action)
    {
        case 'home':
            displayStage();
            break;
        case 'stage':

            break;
        case 'login':
            login($_POST);
            break;
        case 'logout':
            navigation('logout');
            break;
    }
}else {
    displayStage();
}

/**
 * Premet de ce déconnecter
 * @return void
 */
function logout(){
    session_destroy();
    header("Location: index.php"); // Rediriger vers la page d'accueil
    exit; // Arrêter l'exécution du script
}