<?php

	include ("../metier/fctAux.inc.php");
	include ("../metier/DB.inc.php");

	session_start();

	$user = unserialize($_SESSION['user']);

	global $db;
	$db = DB::getInstance();

	if ($db == null) 
	{
		echo "Impossible de se connecter &agrave; la base de donn&eacute;es !";
	}
	else 
	{
		
		enTete("Shiny Hunt","../style/stylePage.css;../style/styleFormulaireHunts.css");
		nav();

		if (isset($_REQUEST["num"]))
		{
			$num = $_REQUEST["num"];

			form($db, $num);
		}
		else
		{
			form($db);
		}
		pied();
	}



	function form ($db = null, $num = 0)
	{
		$nom = "";
		$nbreset = 0;



		if ($num != 0)
		{
			$chasse = $db->getChasse($num);
			$chasse = $chasse[0];

			$pokemon = $db->getPokemon($chasse->getIdPokemon());

			$nom     = $pokemon[0]->getNomPokemon();
			$nbreset = $chasse->getNbRencontre();

		}



		/*-----------------------------------------------*/
		/*                      NOM                      */
		/*-----------------------------------------------*/


        echo '
        <section>
			<article id = "FORM">
				<form action ="formulaireShinyHunt.php" method="post">

					<h1> AJOUT DE CHASSE </h1>
					
					<br>

					
					
					<div class = "input-group">
						<label class = "label" for = "nomPokemon">Nom</label>
						<input class = "input" list = "pokemon" placeholder="" required type="text" name="nomPokemon" value="'. $nom .'">
						<datalist id = "pokemon">';

		$tabPokemons = $db->getPokemons();
		foreach ($tabPokemons as $key => $pokemon)
		{
			echo '	
							<option value="'. $pokemon->getNomPokemon() .'">';
		}

		echo '
						</datalist> 
					</div>';

		



		/*-----------------------------------------------*/
		/*                   NB RESET                    */
		/*-----------------------------------------------*/












		echo '
					<div class = "input-group">
						<label class = "label" for = "nbReset">Nombre de reset</label>
						<input class = "input" placeholder="" required type="number" name="nbReset" value="'. $nbreset .'">
					</div>

					<div class = "input-group">
						<label class = "label" for = "shinyImg">Sprite</label>
						<input type="radio" name="img" value="s" checked> Shiny
						<input type="radio" name="img" value="n"> Normal
					</div>

					<div class = "input-group">
						<label class = "label" for = "jeu">Jeu </label>
						<input class = "input" placeholder="" required type="text" name="jeu">
					</div>

					<div class = "input-group">
						<label class = "label" for = "methode">Méthode de chasse </label>
						<input class = "input" placeholder="" required type="text" name="methode">
					</div>


				</form>
			</article>

			<article id = "PREV">
				
			</article>
		</section>
		';


	}


?>