<?php
/**
 * @file      home.php
 * @author    Created by Amos Le Coq
 * @version   06.05.2024
 */
ob_start();
$title = "Home";
?>

<h1>salut</h1>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>
