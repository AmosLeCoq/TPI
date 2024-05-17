<?php
/**
 * @file      navigation.php
 * @author    Created by Amos Le Coq
 * @version   06.05.2024
 */

/**
 * Permet d'afficher la page home.php avec les stages
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

/**
 * Gestion pour la page admin
 * @return void
 */
function displayAdmin()
{
    // fait une sécurité pour la connexion à la page admin
    // problème corrigé : si on met dans la variable global GET["action"] = "admin" on pouvait accéder à la page "admin.php" sans être admin
    // actuellement si on fait ça sans être connecté on a une redirection à home.php
    if (isset($_SESSION["type"])) {
        if ($_SESSION["type"] == "admin") {

             if(isset($_GET["nomStage"]) or isset($_GET["branch"]) or isset($_GET["enseignant"]) or isset($_GET["description"]) or isset($_GET["dateDebut"]) or isset($_GET["dateFin"]) or isset($_GET["heureDebut"]) or isset($_GET["heureFin"])){
                if(!$_GET["nomStage"]=="" and !$_GET["branch"]=="" and !$_GET["enseignant"]=="" and !$_GET["description"]=="" and !$_GET["dateDebut"]=="" and !$_GET["status"]=="" and !$_GET["dateFin"]=="" and !$_GET["heureDebut"]=="" and !$_GET["heureFin"]==""){
                    try {
                        require_once "model/adminManager.php";
                        $info["info"]=getInfo($_GET["branch"],$_GET["enseignant"],$_GET["status"]);
                        createStage($_GET["nomStage"],$info["info"]["branchId"][0]["id"],$info["info"]["enseignantId"][0]["id"],$_GET["description"],$_GET["dateDebut"],$_GET["dateFin"],$_GET["heureDebut"],$_GET["heureFin"],$info["info"]["statusId"][0]["id"]);
                    }catch (ModelSataBaseException $ex){
                        $articleErrorMessage = "Nous rencontrons temporairement un problème technique";
                    }
                }
             }

            try {
                require_once "model/adminManager.php";
                $branchs = getBranchs();
                $enseignants = getEnseignants();
                $status = getStatus();
            } catch (ModelSataBaseException $ex) {
                $articleErrorMessage = "Nous rencontrons temporairement un problème technique";
            } finally {
                require "view/admin.php";
            }
        }
    }else{
        displayStage();
    }
}