<?php

require 'Chasse.inc.php';
require 'User.inc.php';
require 'Pokemon.inc.php';

class DB {
      private static $instance = null; //mémorisation de l'instance de DB pour appliquer le pattern Singleton
      private $connect=null; //connexion PDO à la base

      /************************************************************************/
      //	Constructeur gerant  la connexion à la base via PDO
      //	NB : il est non utilisable a l'exterieur de la classe DB
      /************************************************************************/	
      private function __construct() 
      {

      	      // Connexion à la base de données
	      $connStr = 'mysql:host=localhost;port=3306;dbname=ShinyHunt'; // A MODIFIER ! 
	      try 
            {
		      // Connexion à la base
	      	  $this->connect = new PDO($connStr, 'root', ''); //A MODIFIER !
                  // Configuration facultative de la connexion
                  $this->connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); 
                  $this->connect->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); 
	      }
	      catch (PDOException $e) {
      	      	    echo "probleme de connexion :".$e->getMessage();
		    return null;    
	      }
      }

      /************************************************************************/
      //	Methode permettant d'obtenir un objet instance de DB
      //	NB : cet objet est unique pour l'exécution d'un même script PHP
      //	NB2: c'est une methode de classe.
      /************************************************************************/
      public static function getInstance() {
      	     if (is_null(self::$instance)) {
 	     	try { 
		      self::$instance = new DB(); 
 		} 
		catch (PDOException $e) {
			echo $e;
 		}
            } //fin IF
 	    $obj = self::$instance;

	    if (($obj->connect) == null) {
	       self::$instance=null;
	    }
	    return self::$instance;
      } //fin getInstance	 

      /************************************************************************/
      //	Methode permettant de fermer la connexion a la base de données
      /************************************************************************/
      public function close() {
      	     $this->connect = null;
      }

      /************************************************************************/
      //	Methode uniquement utilisable dans les méthodes de la class DB 
      //	permettant d'exécuter n'importe quelle requête SQL
      //	et renvoyant en résultat les tuples renvoyés par la requête
      //	sous forme d'un tableau d'objets
      //	param1 : texte de la requête à exécuter (éventuellement paramétrée)
      //	param2 : tableau des valeurs permettant d'instancier les paramètres de la requête
      //	NB : si la requête n'est pas paramétrée alors ce paramètre doit valoir null.
      //	param3 : nom de la classe devant être utilisée pour créer les objets qui vont
      //	représenter les différents tuples.
      //	NB : cette classe doit avoir des attributs qui portent le même que les attributs
      //	de la requête exécutée.
      //	ATTENTION : il doit y avoir autant de ? dans le texte de la requête
      //	que d'éléments dans le tableau passé en second paramètre.
      //	NB : si la requête ne renvoie aucun tuple alors la fonction renvoie un tableau vide
      /************************************************************************/
      private function execQuery($requete, $tparam, $nomClasse) 
      {
            try {
                  // on prépare la requête
                  $stmt = $this->connect->prepare($requete);
                  
                  if ($stmt === false) 
                  {
                        throw new PDOException('Erreur de préparation de la requête.');
                  }

                  // on indique que l'on va récupérer les tuples sous forme d'objets instance de $nomClasse
                  $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $nomClasse);

                  // on exécute la requête
                  if ($tparam != null) {
                        $success = $stmt->execute($tparam);
                  } else {
                        $success = $stmt->execute();
                  }

                  if ($success === false) {
                        throw new PDOException('Erreur d\'exécution de la requête.');
                  }

                  // récupération du résultat de la requête sous forme d'un tableau d'objets
                  $tab = array();
                  $tuple = $stmt->fetch();

                  if ($tuple) {
                        // au moins un tuple a été renvoyé
                        while ($tuple != false) {
                        $tab[] = $tuple;
                        $tuple = $stmt->fetch();
                        }
                  }

                  return $tab;
            } catch (PDOException $e) {
                  // afficher l'erreur PDO
                  echo 'Erreur PDO : ' . $e->getMessage();
                  return array(); // retourner un tableau vide en cas d'erreur
            }
      }

      /*private function execQuery($requete, $tparam, $nomClasse)
      {
      // on prépare la requête
      $stmt = $this->connect->prepare($requete);
      // on indique que l'on va récupérer les tuples sous forme de tableau associatif
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      // on exécute la requête
      if ($tparam != null) {
            $stmt->execute($tparam);
      } else {
            $stmt->execute();
      }
      // récupération du résultat de la requête sous forme d'un tableau associatif
      $tab = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $tab;
      }*/


  
       /************************************************************************/
      //	Methode utilisable uniquement dans les méthodes de la classe DB
      //	permettant d'exécuter n'importe quel ordre SQL (update, delete ou insert)
      //	autre qu'une requête.
      //	Résultat : nombre de tuples affectés par l'exécution de l'ordre SQL
      //	param1 : texte de l'ordre SQL à exécuter (éventuellement paramétré)
      //	param2 : tableau des valeurs permettant d'instancier les paramètres de l'ordre SQL
      //	ATTENTION : il doit y avoir autant de ? dans le texte de la requête
      //	que d'éléments dans le tableau passé en second paramètre.
      /************************************************************************/
      private function execMaj($ordreSQL,$tparam) {
      	     $stmt = $this->connect->prepare($ordreSQL);
	     $res = $stmt->execute($tparam); //execution de l'ordre SQL      	     
	     return $stmt->rowCount();
      }

      /*************************************************************************
       * Fonctions qui peuvent être utilisées dans les scripts PHP
       *************************************************************************/
      

      /*           */
      /*   HUNTS   */
      /*           */
      
      public function getChassesNonFinit($idUser = 0) 
      {
      	$requete = 'select * from hunts where idUser = '.$idUser. ' and estfinit=FALSE;';
	      return $this->execQuery($requete,null,'Chasse');
      }    

      public function getChasse($idChasse = 0) 
      {
      	$requete = 'select * from hunts where idchasse = '.$idChasse. ';';
	      return $this->execQuery($requete,null,'Chasse');
      }

      public function insertChasse($idpokemon,$nbRencontre,$estFinit,$idUser) {
      	     $requete = 'insert into hunts values(?,?,?,?)';
	     $tparam = array($idChasse,$idpokemon,$nbRencontre,$estFinit,$idUser);
	     return $this->execMaj($requete,$tparam);
      }

      public function updateNbRencontre($numChasse, $newValue) 
      {
            $requete = 'update hunts set nbRencontre = ? where idChasse = ?';
            $tparam = array($newValue, $numChasse);
            return $this->execMaj($requete, $tparam);
      }

      public function setChasseFinit($numChasse) 
      {
            $requete = 'update hunts set estfinit = TRUE where idChasse = ?';
            $tparam = array($numChasse);
            return $this->execMaj($requete, $tparam);
      }

      



      /*              */
      /*   POKEMONS   */
      /*              */
      
      public function getPokemon($numpokedex = 0) 
      {
      	$requete = 'select * from Pokemons where numpokedex = '.$numpokedex. ';';
	      return $this->execQuery($requete,null,'Pokemon');
      }    

      public function getPokemons()
      {
      	$requete = 'select * from Pokemons;';
	      return $this->execQuery($requete,null,'Pokemon');
      }

      
      
      

      /*           */
      /*   USERS   */
      /*           */

      
      public function getUsers()
      {
            $requete = 'select * from Users;';
            return $this->execQuery($requete,null,'User');
      } 

      public function getUser($login)
      {
            $requete = 'select * from Users where loginuser = \''.$login.'\'';
            return $this->execQuery($requete,null,'User');
      } 

      // Dans la classe DB

      public function getPasswordByLogin($login = '') 
      {
            $requete = 'select pwdUser from Users where loginUser = ?';
            $tparam = array($login);

            try {
                  $resultats = $this->execQuery($requete, $tparam, 'User');

                  // Vérifier si des résultats ont été renvoyés
                  if (!empty($resultats)) {
                        // Un utilisateur avec ce login a été trouvé
                        // Retournez le mot de passe
                        return $resultats[0]->getPwdUser();
                  } else {
                        // Aucun utilisateur trouvé, renvoyer une chaîne vide
                        return "";
                  }
            } catch (PDOException $e) {
                  // Afficher le message d'erreur
                  echo "Erreur : " . $e->getMessage();
                  return "Erreur : " . $e->getMessage();
            }
      }

      public function addUser($log, $mail, $pwd)
      {
            $requete = 'insert into Users (loginuser,mailuser,pwduser) VALUES (?,?,?)';
            $tparam = array($log,$mail,$pwd);
            return $this->execMaj($requete,$tparam);
      }



} //fin classe DB

?>
