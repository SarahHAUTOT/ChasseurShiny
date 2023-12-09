<?php

	include ('./metier/fctAux.inc.php');

	enTete("Login","style/styleIndex.css");
	contenue();
	pied();

	function contenue()
	{
		echo
		'
			<img src = "illustrations/umbreonShiny.gif">


			<article>

				<form action="gererFormulaire.php" method="post">
				
					<h1> Se connecter </h1>
					
					<div class = "input-group">
					<input class = "input" placeholder="" required type="text" name="login">
					<label class = "label" for = "login">Login</label>
					</div>
					
					
					<div class = "input-group">
					<input class = "input" placeholder="" required type="password" name="pwd">
					<label class = "label" for = "pwd">Mots de passe</label>
					</div>
					
					<input class = "input btn" type="submit" name="connect" value="OK">

				</form>
						
				<hr width = "100%">

				<form action="gererFormulaire.php" method="post">
						
					<h1> Créer un compte </h1>
					
					<div class = "input-group">
					<input class = "input" placeholder="" required type="text" name="newLogin">
					<label class = "label" for = "newLogin">Login</label>
					</div>
					
					<div class = "input-group">
					<input class = "input" placeholder="" required type="email" name="newEmail">
					<label class = "label" for = "newEmail">Email</label>
					</div>
					
					
					<div class = "input-group">
					<input class = "input" placeholder="" required type="password" name="newPwd">
					<label class = "label" for = "newPwd">Mots de passe</label>
					</div>
					

					<input class = "input btn" type="submit" name="create" value="OK">

				</form>
			</article>
		';
	}

?>

			<!-- <video autoplay muted loop>
				<source src="illustrations/background.mp4" type="video/mp4">
			</video> -->