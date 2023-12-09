<?php

class User
{
    private int    $iduser;
    private string $loginuser;
    private string $mailuser;
    private string $pwduser;

    public function __construct(int $i = -1, string $l = "", string $e = "", string $p = "")
    {
        $this->iduser    = $i;
        $this->loginuser = $l;
        $this->mailuser = $e;
        $this->pwduser   = $p;
    }

    public function getPwdUser()
    {
        return $this->pwduser;
    }

    public function getLogUser()
    {
        return $this->loginuser;
    }

    public function getIdUser()
    {
        return $this->iduser;
    }
    
    public function __toString() 
	{
		$res =       "id   :".$this->iduser."\n";
		$res = $res ."log  :".$this->loginuser."\n";
		$res = $res ."pwd  :".$this->pwduser."\n";
		$res = $res ."mail :".$this->mailuser."\n";
		$res = $res ."<br/>";
		return $res;
	}
}

?>
