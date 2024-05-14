<?php
/**
 * @file      admin.php
 * @author    Created by Amos Le Coq
 * @version   14.05.2024
 */
ob_start();
$title = "Administration";
?>

<h3>Admin</h3>

<?php
$content = ob_get_clean();
require "gabarit.php";
?>