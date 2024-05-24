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
    if(isset($_GET["answer"]) and isset($_GET["parent"])){
        if($_GET["answer"]=="Accepter"){
            require_once "model/userManager.php";
            addParent($_GET["parent"]);
        }elseif ($_GET["answer"]=="Refuser"){
            require_once "model/userManager.php";
            rmParent($_GET["parent"]);
        }
    }
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
                        createStage($_GET["nomStage"],$info["info"]["branchId"][0]["id"],$info["info"]["enseignantId"][0]["id"],$_GET["description"],$_GET["dateDebut"],$_GET["dateFin"],$_GET["heureDebut"],$_GET["heureFin"],$info["info"]["statusId"][0]["id"],$_GET["prix"],$_GET["max"]);
                    }catch (ModelSataBaseException $ex){
                        $articleErrorMessage = "Nous rencontrons temporairement un problème technique";
                    }
                }
             }

            try {
                require_once "model/adminManager.php";
                $accounts = getAccountDisabled();
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

/**
 * Permet d'affiche la site de stage dans la page "stage.php"
 * @return void
 */
function displayListCourse()
{
    if(isset($_GET["mv-status"]) and isset($_GET["stage"])){
        if ($_SESSION["type"] == "admin") {
            require_once "model/stageManager.php";
            setStage($_GET["stage"], $_GET["mv-status"]);
        }
    }

    if(isset($_GET["search"])){
        try {
            require_once "model/stageManager.php";
            $recherche = getSearch();
        }
        catch (ModelSataBaseException $ex){
            $articleErrorMessage="Nous rencontrons temporairement un problème technique";
        }
    }

    if(isset($_GET["stage"]) and isset($_GET["child"])){
        try {
            require_once "model/userManager.php";
            registerCourse($_GET["child"],$_GET["stage"]);


        }catch (ModelSataBaseException $ex){
            $articleErrorMessage="Nous rencontrons temporairement un problème technique";
        }
    }

    try {
        // recherche les données dans la DB
        require_once "model/stageManager.php";
        $stages = getListStage();
        require_once "model/adminManager.php";
        $status = getStatus();
        $branchs = getBranchs();
        $enseignants = getEnseignants();
        $i=0;
        foreach ($stages as $stage) {
            foreach ($status as $statu){
                if($stage["status_id"]==$statu["id"]){
                    $stages[$i]["status_id"]=$statu["name"];
                }
            }
            foreach ($branchs as $branch){
                if($stage["branchs_id"]==$branch["id"]){
                    $stages[$i]["branchs_id"]=$branch["name"];
                }
            }
            foreach ($enseignants as $enseignant){
                if($stage["teachers_id"]==$enseignant["id"]){
                    $stages[$i]["teachers_id"]=$enseignant["first_name"]."  ".$enseignant["last_name"];
                }
            }
            $i++;
        }

        if (isset($_SESSION["type"])){
            if($_SESSION["type"]=="user"){
                require_once "model/userManager.php";
                $childs=getChildrens($_SESSION["mail"]);
            }
        }

    }
    catch (ModelSataBaseException $ex){
        $articleErrorMessage="Nous rencontrons temporairement un problème technique";
    } finally {
        require"view/stage.php";
    }
}

function displayListRegistrer()
{
    if(isset($_GET["first_name"]) and isset($_GET["last_name"]) and isset($_GET["user_mail"])){
        require_once "model/userManager.php";
        addChild($_GET["first_name"], $_GET["last_name"], $_GET["user_mail"]);
    }

    if(isset($_SESSION["type"])){
        if($_SESSION["type"]=="user"){
            require_once "model/userManager.php";
            $courses = getRegister($_SESSION["mail"]);
            require "view/courseRegistration.php";
        }
    }else{
        displayStage();
    }
}