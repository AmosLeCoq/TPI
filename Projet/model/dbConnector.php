<?php
/**
 * Ouvre une connexion à la base de données.
 * @return PDO|null
 */
function openDBConnection()
{
    $serverName = '127.0.0.1'; //l'adresse IP du serveur MySQL
    $databaseName = 'dbstage';
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
