<?php

	include ('../metier/fctAux.inc.php');
	include ('../metier/DB.inc.php');

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

		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			$numChasse = $_POST['num'];

			if (isset($_POST["modif"])) 
			{
				header("Location: ajouterShinyHunt.php?num=$numChasse");
			}

			if (isset($_POST["finit"])) 
			{
				$db->setChasseFinit($numChasse);

				echo "Chasse finit : " . $numChasse;
				header("Location: afficherShinyHunt.php");
				exit();
			}
    	}



		enTete("Shiny Hunt","../style/stylePage.css;../style/stylePageHunts.css");
		nav();
		chasses($db->getChassesNonFinit($user->getIdUser()), $db);
		pied();
	}

    function chasses($tabChasses, $db)
    {
        echo '
        <section> ';

        foreach ($tabChasses as $key => $chasse) 
        { 
            $pokemons = $db->getPokemon($chasse->getIdPokemon());
            
            if (!empty($pokemons)) 
            {

                $pokemon = $pokemons[0];

                $num = $chasse->getIdChasse();
                $nom = $pokemon->getNomPokemon();
                $img = $pokemon->getImgShiny();
                $nb  = $chasse->getNbRencontre();

                echo
                '
                <article>
                    <form id="form_'.$num.' action ="afficherShinyHunt.php" method="post">
						<input type="submit" name="modif" value="Paramètres">

						<h1>'. $nom .'</h1>
						<img src="'. $img .'">
						<br>

                        <input type="hidden" name="num" value="'.$num.'">
                        <input type="hidden" id="nbRencontre_'.$num.'" name="valeur" value="'.$nb.'">

                        <div id = "CONT_COMPT">
                            <div class = "plusMoinsDiv">
                                <input type="button" class="plusMoins" onclick="updateCount(\''.$num.'\', \'-\')" value="-">
                            </div>

                            <div id = "COMPT"> <b id="displayNbRencontre_'.$num.'">'.$nb.'</b> </div>

                            <div class = "plusMoinsDiv">
                                <input type="button" class="plusMoins" onclick="updateCount(\''.$num.'\', \'+\')" value="+">
                            </div>    
                        </div>

						<input id="FINISH" type="submit" name="finit" value="TERMINER">
                    </form>
                </article>
                ';
            }
        }

        echo 
        '
            <article id="ADD">
                <a href = "ajouterShinyHunt.php">
                    <h1>+</h1>
                    Ajouter une nouvelle chasse
                </a>
            </article>
        </section>
        ';
    }
    
    // Incluez le fichier JavaScript à la fin de votre fichier PHP
    echo '<script src="script.js"></script>';
?>

