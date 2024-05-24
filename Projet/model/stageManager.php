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
    $Query='SELECT name, description FROM tpi_lqa_dbstage.internships';

    require_once 'model/dbConnector.php';
    return executeQuerySelect($Query);
}

/**
 * Retourne les infos des stages
 * @return array|false|null
 */
function getListStage($branchName = "")
{
    $query = 'SELECT id, name, description, start_date, end_date, start_time, end_time, max_people, number_registrants, price, branchs_id, status_id, teachers_id FROM tpi_lqa_dbstage.internships';

    // Ajout du filtre si une valeur est fournie
    if (!empty($branchName)) {
        $query .= " WHERE branchs_id = (SELECT id FROM tpi_lqa_dbstage.branchs WHERE name = '$branchName')";
    }

    require_once 'model/dbConnector.php';

    // Si un filtre est fourni, exécuter la requête avec le paramètre lié
    if (!empty($branchName)) {
        return executeQuerySelect($query, array(':branchName' => $branchName));
    } else {
        // Sinon, exécuter la requête sans paramètres
        return executeQuerySelect($query);
    }
}


function setStage($stage,$statu)
{
    $statu = addslashes($statu);
    $query = "UPDATE tpi_lqa_dbstage.internships SET status_id = (SELECT id FROM tpi_lqa_dbstage.status WHERE name = '$statu') WHERE id = '$stage';";
    require_once "model/dbConnector.php";
    executeQueryUpdate($query);
}