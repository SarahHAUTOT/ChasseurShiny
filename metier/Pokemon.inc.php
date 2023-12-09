<?php

class Pokemon
{
    private int    $numpokedex;
    private string $nompokemon;
    private int    $generation;
    private string $imgsonshiny;
    private string $imgshiny;

    public function __construct(int $num = -1, string $pok = "", int $gen = 0 , string $ins = "", string $is = "")
    {
        $this->numpokedex  = $num;
		$this->nompokemon  = $pok;
		$this->generation  = $gen;
		$this->imgsonshiny = $ins;
		$this->imgshiny    = $is;
    }

    public function getNumPokedex() { return $this->numpokedex;  }
    public function getNomPokemon() { return $this->nompokemon;  }
    public function getGeneration() { return $this->generation;  }
    public function getImgNormal () { return $this->imgsonshiny; }
    public function getImgShiny  () { return $this->imgshiny;    }

    
    public function __toString() 
    {
        $res =       "id   :".$this->numpokedex."\n";
        $res = $res ."pok  :".$this->nompokemon."\n";
        $res = $res ."gen  :".$this->generation."\n";
        $res = $res ."imgNS:".$this->imgsonshiny."\n";
        $res = $res ."imgS :".$this->imgshiny."\n";
        $res = $res ."<br/>";
        return $res;
    }
}

?>
