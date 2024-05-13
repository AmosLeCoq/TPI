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
function displayStage()
{
    if(isset($_GET["recherche"])){
        try {
            require_once "model/stageManager.php";
            $recherche = getRecherche();
        }
        catch (ModelSataBaseException $ex){
            $articleErrorMessage="Nous rencontrons temporairement un problème technique";
        }
    }

    try {
        // look for data in db
        require_once "model/stageManager.php";
        $stages = getStage();
    }
    catch (ModelSataBaseException $ex){
        $articleErrorMessage="Nous rencontrons temporairement un problème technique";
    } finally {
        require"view/home.php";
    }
}