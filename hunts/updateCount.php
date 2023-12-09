<?php
// updateCount.php

include("../metier/DB.inc.php");

// Récupérez les valeurs envoyées par la requête AJAX
$numChasse = $_POST['numChasse'];
$newValue = $_POST['newValue'];

// Mettez à jour la base de données avec la nouvelle valeur
$db = DB::getInstance();
$db->updateNbRencontre($numChasse, $newValue);
?>
