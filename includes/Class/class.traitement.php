<?php

require_once("config.php");
class Traitement{   		
      	private static $idT ;
        private static $libelle ;

		
	public function __construct($unId, $unLibelle){
		$this->idT = $unId;
		$this->libelle = $unLibelle;
	}




    

       /******************Function to auto increment seq******************/
function getTraitementId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersTraitement->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }




	public function getIdT(){
        return $this->idT;
    }
	
	public function setIdT(int $unId){
        $this->idT = $unId;
    }

	 
    public function getLibelle(){
        return $this->libelle;
    }
	
	public function setLibelle(string $unLibelle){
        $this->libelle = $unLibelle;
    }
   

}
?>



