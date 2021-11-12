<?php


class PdoLivMedoc{   		
      	private static $serveur='mysql:host=localhost';
        private static $port='3306';
      	private static $bdd='dbname=livmedoc';   		
      	private static $user='root' ;    		
      	private static $mdp='' ;	
		private static $monPdo;
		private static $monPdoLivMedoc=null;

		
	private function __construct(){
    	PdoLivMedoc::$monPdo = new PDO(PdoLivMedoc::$serveur.';'. PdoLivMedoc::$port.';'.PdoLivMedoc::$bdd, PdoLivMedoc::$user, PdoLivMedoc::$mdp); 
		PdoLivMedoc::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoLivMedoc::$monPdo = null;
	}


	public  static function getPdoLivMedoc(){
		if(PdoLivMedoc::$monPdoLivMedoc==null){
			PdoLivMedoc::$monPdoLivMedoc= new PdoLivMedoc();
		}
		return PdoLivMedoc::$monPdoLivMedoc;  
	}
        
     

}


//on fait la connexion à la base
//$pdo = PdoLivMedoc::getPdoLivMedoc();
//$client = $pdo->getInfosClient($login,$mdp);

?>



