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
            mail("amos.lecoq@eduvaud.ch", "Test 1mail", "Test 2mail");
            echo '<script>alert("mail")</script>';
            break;
        case 'login':
            login($_POST);
            break;
        case 'logout':
            logout();
            break;
    }
}else {
    displayStage();
}