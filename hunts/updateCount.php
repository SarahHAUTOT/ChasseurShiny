<?php

include("../metier/DB.inc.php");

$numChasse = $_POST['numChasse'];
$newValue = $_POST['newValue'];

$db = DB::getInstance();
$db->updateNbRencontre($numChasse, $newValue);
?>
