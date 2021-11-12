<?php
require_once("config.php");

class Allergie{   		
      	private static $idAl ;
        private static $libelle ;

		
	public function __construct($unId, $unLibelle){
		$this->idAl = $unId;
		$this->libelle = $unLibelle;
	}

    /******************Function to auto increment seq******************/
function getAllergieId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersAllergie->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }
    

	public function getIdAl(){
        return $this->idAl;
    }
	
	public function setIdAl(int $unId){
        $this->idAl = $unId;
    }

	 
    public function getLibelle(){
        return $this->libelle;
    }
	
	public function setLibelle(string $unLibelle){
        $this->libelle = $unLibelle;
    }
   

}
?>



