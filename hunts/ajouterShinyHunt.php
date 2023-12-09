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

			form($num, $db);
		}
		else
		{
			form();
		}
		pied();
	}



	function form ($num = 0, $db = null)
	{
		$nom = "";
		$nbreset = 0;



		if ($num != 0)
		{
			$chasse = $db->getChasse($num);
			$pokemon = $db->getPokemon($chasse[0]->getIdPokemon());

			$nom =  $pokemon[0]->getNomPokemon();

		}






        echo '
        <section>
			<article id = "FORM">
				<form action ="ajouterShinyHunt.php" method="post">

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
								<option value="'. $pokemon.getNomPokemon() .'">
			';
		}

		echo '</datalist>';


		echo '
					</div>


				</form>
			</article>

			<article id = "PREV">
				
			</article>
		</section>
		';


	}


?>