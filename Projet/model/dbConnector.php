<?php
/**
 * @file      dbConnector.php
 * @author    Created by Amos Le Coq
 * @version   06.05.2024
 */

/**
 * Ouvre une connexion à la base de données.
 * @return PDO|null
 */
function openDBConnection()
{
    $serverName = '127.0.0.1'; //l'adresse IP du serveur MySQL
    $databaseName = 'tpi_lqa_dbstage';
    $username = 'root';
    $password = 'Pa$$w0rd';

    try {
        $conn = new PDO("mysql:host=$serverName;dbname=$databaseName", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}

/**
 * Cette fonction exécute une requête de sélection MySQL et retourne tous les résultats
 * @param $query
 * @return array|false|null
 */
function executeQuerySelect($query){
    $queryResult = null;
    $dbConnection = openDBConnection();

    if ($dbConnection != null)
    {
        $statement = $dbConnection->prepare($query);
        $statement->execute();
        $queryResult = $statement->fetchAll(PDO::FETCH_ASSOC); // Utilisation de PDO::FETCH_ASSOC pour obtenir un tableau associatif
    }
    $dbConnection = null;
    return $queryResult;
}

/**
 * Execute une commande INSERT
 * Il y a pas encore la gestion des erreurs
 * @param $query
 * @return false|PDOStatement|void|null
 */
function executeQueryInsert($query){
    $dbConnection = openDBConnection();

    if ($dbConnection != null)
    {
        try {
            $statement = $dbConnection->prepare($query);
            $statement->execute();
            echo '<script type="text/javascript">window.alert("Réussi");</script>';
        }catch (PDOException $e) {
            //Met un message si le message d'erreur est le 23000
            //Erreur en cas de double
            if($e->getCode()==23000){
                echo '<script type="text/javascript">window.alert("Déjà existant");</script>';
            }
            return null;
        }
    }
    $dbConnection = null;
}

/**
 * Exécute une commande UPDATE
 * @param string $query La requête SQL UPDATE à exécuter
 * @return void
 */
function executeQueryUpdate($query){
    $dbConnection = openDBConnection();

    if ($dbConnection != null)
    {
        try {
            $statement = $dbConnection->prepare($query);
            $statement->execute();
            echo '<script type="text/javascript">window.alert("Réussi");</script>';
        } catch (PDOException $e) {
            if($e->getCode()=="HY000"){
                echo '<script type="text/javascript">window.alert("Email pas existant");</script>';
            }
        }
    }
    $dbConnection = null;
}

/**
 * Exécute une commande DELETE
 * @param string $query La requête SQL DELETE à exécuter
 * @return void
 */
function executeQueryDelete($query){
    $dbConnection = openDBConnection();

    if ($dbConnection != null)
    {
        try {
            $statement = $dbConnection->prepare($query);
            $statement->execute();
            echo '<script type="text/javascript">window.alert("Réussi");</script>';
        } catch (PDOException $e) {
            echo "Delete failed: " . $e->getMessage(); // Gestion des erreurs
        }
    }
    $dbConnection = null;
}