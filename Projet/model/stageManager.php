<?php

function getStage()
{
    $Query='SELECT name, description FROM dbstage.internships';

    require_once 'model/dbConnector.php';
    return executeQuerySelect($Query);
}
