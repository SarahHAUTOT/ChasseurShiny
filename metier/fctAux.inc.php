<?php

	function enTete ($titre = "Page Web", $cheminCss = "")
	{
		$listCSS = explode(";", $cheminCss);


		echo 
		'
		<!DOCTYPE html>
		<html lang="fr">
		<head>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<meta name="author" content="Hautot Sarah (Ottirate)">
		';

		foreach ($listCSS as $key => $css) 
			echo '<link rel="stylesheet" href="'.$css.'">';

		echo 
		'
			<title>'.$titre.'</title>
		</head>
		<body>
		';
	}


	function nav()
	{
		echo
		'
			<header>
				<a href = "../afficherFormulaire.php">
					<img src="../illustrations/shinyCharm.png">
				</a>
			</header>

			<nav>
				<ul>
					<li> <a href=""> YOUR PROFIL </a> </li>
					<li> <a href="afficherShinyHunt.php"> CURRENT HUNTS </a> </li>
					<li> <a href=""> LIBRARY </a> </li>
					<li> <a href=""> CONTACT US </a> </li>
				</ul>
			</nav>
			';
	}


	function pied ()
	{
		echo 
		'
		</body>
		</html>
		';
	}
?>