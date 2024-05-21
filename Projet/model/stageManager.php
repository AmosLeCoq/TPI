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
 * Retourne les infos des stages
 * @return array|false|null
 */
function getListStage()
{
    $Query='SELECT name, description, start_date, end_date, start_time, end_time, max_people,number_registrants, branchs_id, status_id, teachers_id FROM dbstage.internships';

    require_once 'model/dbConnector.php';
    return executeQuerySelect($Query);
}

function getSearch(){

}