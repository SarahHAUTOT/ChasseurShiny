<?php

	class Chasse 
	{
		private int  $idchasse;
		private int  $idpokemon;
		private int  $nbrencontre;
		private bool $estfinit;
		private bool $imgshiny;
		private int  $iduser;

		public function __construct ($ic = -1, $np = 0, $nr = 0, $ef = false, $is = true, $iu = -1)
		{
			$this->idchasse    = $ic;
			$this->idpokemon   = $np;
			$this->nbrencontre = $nr;
			$this->estfinit    = $ef;
			$this->imgShiny    = $is;
			$this->iduser      = $iu;
		}


		public function getIdChasse () {return $this->idchasse;} 
		public function getIdPokemon () {return $this->idpokemon;} 
		public function getNbRencontre () {return $this->nbrencontre;} 
		public function getEstFinit () {return $this->estfinit;} 
		public function getImgShiny () {return $this->imgshiny;} 
		public function getIdUser () {return $this->iduser;} 
		
    
		public function __toString() 
		{
			$res =       "id   :".$this->idchasse."\n";
			$res = $res ."pok  :".$this->idpokemon."\n";
			$res = $res ."reset:".$this->nbrencontre."\n";
			$res = $res ."fin  :".$this->estfinit."\n";
			$res = $res ."img  :".$this->imgshiny."\n";
			$res = $res ."user :".$this->iduser."\n";
			$res = $res ."<br/>";
			return $res;
		}
	}


?>