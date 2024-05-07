<?php
/**
 * @file      home.php
 * @author    Created by Amos Le Coq
 * @version   06.05.2024
 */
ob_start();
$title = "Home";
?>

<h1>Description des stages</h1>

<?php foreach ($stages as $stage) : ?>
    <div class="stage">
        <h2 class="stage-title"><?= $stage['name'] ?></h2>
        <p class="stage-description"><?= $stage['description'] ?></p>
    </div>
    <br>
<?php endforeach;?>




<?php
$content = ob_get_clean();
require "gabarit.php";
?>
