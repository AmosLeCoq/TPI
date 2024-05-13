<?php
/**
 * @file      stageManager.php
 * @author    Created by Amos Le Coq
 * @version   07.05.2024
 */

/**
 * Recherche les stages pour la page home.php
 * @return array
 */
function getStage()
{
    $Query='SELECT name, description FROM dbstage.internships';

    require_once 'model/dbConnector.php';
    return executeQuerySelect($Query);
}

/**
 * e
 *Recherche les stages avec un mot cle
 * @return array|false|null
 */
function getRecherche(){

    $strSeparator = '\'';
    $recherche = "'%".$_GET['recherche']."%'";

    $Query='SELECT name, description FROM dbstage.internships WHERE LOWER(description) LIKE LOWER('.$recherche.') OR LOWER(name) LIKE LOWER('.$recherche.') OR branchs_id IN (SELECT id FROM dbstage.branches WHERE LOWER(name) LIKE LOWER('.$recherche.')) OR YEAR(start_date) ='.$recherche.';';
    require_once 'model/dbConnector.php';
    return executeQuerySelect($Query);
}


