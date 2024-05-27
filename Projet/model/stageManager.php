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
function getListStage($branchName = "",$year= "")
{
    $query = 'SELECT id, name, description, start_date, end_date, start_time, end_time, max_people, number_registrants, price, branchs_id, status_id, teachers_id FROM tpi_lqa_dbstage.internships';

    // Ajout du filtre si une valeur est fournie
    if (!empty($branchName)) {
        $query .= " WHERE branchs_id = (SELECT id FROM tpi_lqa_dbstage.branchs WHERE name = '$branchName')";
    }

    if (!empty($year)) {
        $query .= " WHERE YEAR(start_date) = '$year'";
    }

    require_once 'model/dbConnector.php';

    $params = array();
    if (!empty($branchName)) {
        $params[':branchName'] = $branchName;
    }
    if (!empty($year)) {
        $params[':year'] = $year;
    }
    // Sinon, exécuter la requête sans paramètres
    return executeQuerySelect($query);

}

/**Permet de changer le status d'un stage
 * @param $stage
 * @param $statu
 * @return void
 */
function setStage($stage,$statu)
{
    $statu = addslashes($statu);
    $query = "UPDATE tpi_lqa_dbstage.internships SET status_id = (SELECT id FROM tpi_lqa_dbstage.status WHERE name = '$statu') WHERE id = '$stage';";
    require_once "model/dbConnector.php";
    executeQueryUpdate($query);
}