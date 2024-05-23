<?php
/**
 * @file      adminManager.php
 * @author    Created by Amos Le Coq
 * @version   17.05.2024
 */

/**
 * Permet de retourner toutes les branches
 * @return array|false|null
 */
function getBranchs()
{
    $Query='SELECT id, name FROM tpi_lqa_dbstage.branchs';

    require_once 'model/dbConnector.php';
    return executeQuerySelect($Query);
}

/**
 * Permet de retourner touts les status
 * @return array|false|null
 */
function getStatus(){
    $Query='SELECT id, name FROM tpi_lqa_dbstage.status';

    require_once 'model/dbConnector.php';
    return executeQuerySelect($Query);
}

/**
 * Permet de retourner touts les enseignants
 * @return array|false|null
 */
function getEnseignants()
{
    $Query='SELECT id, first_name, last_name FROM tpi_lqa_dbstage.teachers';

    require_once 'model/dbConnector.php';
    return executeQuerySelect($Query);
}

/**
 * Crée la commande et l'execute
 * @param $nom
 * @param $branch
 * @param $enseignant
 * @param $description
 * @param $dateDebut
 * @param $dateFin
 * @param $heureDebut
 * @param $heureFin
 * @param $status
 * @return void
 */
function createStage($nom,$branch,$enseignant,$description,$dateDebut,$dateFin,$heureDebut,$heureFin,$status,$prix,$max)
{
    $Query="INSERT INTO tpi_lqa_dbstage.internships (name,description,start_date,end_date,start_time,end_time,price,max_people,number_registrants,branchs_id,status_id,teachers_id) VALUES ('".$nom."','".$description."','".$dateDebut."','".$dateFin."','".$heureDebut."','".$heureFin."','".$prix."','".$max."','"."0"."','".$branch."','".$status."','".$enseignant."');";
    executeQueryInsert($Query);
}

/**
 * Va chercher les IDs pour faire un INSERT dans la DB
 * @param $branch
 * @param $enseignant
 * @param $status
 * @return array
 */
function getInfo($branch,$enseignant,$status){

    $nom = explode('  ',$enseignant);

    $Query1 = "SELECT id FROM teachers WHERE first_name = '$nom[0]' AND last_name = '$nom[1]';";
    $Query2="SELECT id FROM status WHERE name = '".$status."';";
    $Query3="SELECT id FROM branchs WHERE name = '".$branch."';";

    require_once 'model/dbConnector.php';
    $r1=executeQuerySelect($Query1);
    $r2=executeQuerySelect($Query2);
    $r3=executeQuerySelect($Query3);

    $retour["enseignantId"]=$r1;
    $retour["statusId"]=$r2;
    $retour["branchId"]=$r3;
    return $retour;
}