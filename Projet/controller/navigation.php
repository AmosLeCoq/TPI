<?php
/**
 * @file      navigation.php
 * @author    Created by Amos Le Coq
 * @version   06.05.2024
 */
/**
 * Gestion de la navigation dans le site
 * @param $nav /definit la page a charger
 * @return void
 */
function navigation($nav)
{
    switch ($nav)
    {
        case 'home':
            require "view/home.php";
            break;
        case 'logout':
            session_destroy();
            header("Location: index.php"); // Rediriger vers la page d'accueil
            exit; // Arrêter l'exécution du script
        case 'login':
    }
}