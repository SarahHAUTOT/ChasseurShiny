<?php

	include ('./metier/DB.inc.php');

	$db = DB::getInstance();
	if ($db == null) 
	{
		echo "Impossible de se connecter &agrave; la base de donn&eacute;es !";
	}
	else 
	{

		//Si on cherche a se connecter...
		if (isset($_POST["connect"])) 
		{
			$loginEntered = $_REQUEST['login'];
			$pwdEntered   = $_REQUEST['pwd'];

			if ($db->getPasswordByLogin($loginEntered) === $pwdEntered) 
			{
				session_start();

				$users = $db->getUser($loginEntered);
				$_SESSION['user'] = serialize($users[0]);
				header("Location: hunts/afficherShinyHunt.php");

				exit();
			}
			else
			{
				header("Location: afficherFormulaire.php");
				exit();
			}
		}
		else
		{
			$login = $_REQUEST['newLogin'];
			$email = $_REQUEST['newEmail'];
			$pwd   = $_REQUEST['newPwd'];

			try 
			{
				$db->addUser($login,$email,$pwd);

				$users = $db->getUser($login);

				session_start();
				$_SESSION['user'] = serialize($users[0]);
				header("Location: hunts/afficherShinyHunt.php");
				exit();
			}
			//L'ajout ne c'est pas fait pour x raison
			catch (Exception $e)
			{
				header("Location: afficherFormulaire.php");
				exit();
			}
		}
	}

?>