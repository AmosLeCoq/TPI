<?php
/**
 * @file      index.php
 * @author    Created by Amos Le Coq
 * @version   06.05.2024
 */
require "controller/navigation.php";

//phpinfo();
session_start();

if (isset($_GET['action']))
{
    $action = $_GET['action'];
    switch ($action)
    {
        case 'home':
            navigation('home');
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
    navigation('home');
}


