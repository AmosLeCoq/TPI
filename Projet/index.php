<?php
/**
 * @file      index.php
 * @author    Created by Amos Le Coq
 * @version   06.05.2024
 */
require "controller/navigation.php";
require "controller/users.php";

session_start();

if (isset($_GET['action']))
{
    $action = $_GET['action'];
    switch ($action)
    {
        case 'home':s
            displayStage();
            break;
        case 'stage':
            displayListCourse();
            break;
        case 'login':
            login($_POST);
            break;
        case 'admin':
            displayAdmin();
            break;
        case 'parent':
            displayListRegistrer();
            break;
        case 'logout':
            logout();
            break;
    }
}else {
    displayStage();
}