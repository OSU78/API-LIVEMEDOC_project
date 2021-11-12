<?php

require_once("config.php");
class AssuranceMaladie{   		
      	private static $idAs ;
        private static $libelle ;

		
	public function __construct($unId, $unLibelle){
		$this->idAs = $unId;
		$this->libelle = $unLibelle;
	}

        /******************Function to auto increment seq******************/
function getAssuranceMaladieId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersAssuranceMaladie->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }

	public function getIdAs(){
        return $this->idAs;
    }
	
	public function setIdAs(int $unId){
        $this->idAs = $unId;
    }

	 
    public function getLibelle(){
        return $this->libelle;
    }
	
	public function setLibelle(string $unLibelle){
        $this->libelle = $unLibelle;
    }
   

}
?>



