<?php

require_once("config.php");
class Choisir_pharmacie {   		
      	
        private static $idPa ;
        private static $idPha ;

		
	public function __construct($unPatient, $unePharmacie){
        $this->idPa = $unPatient;
        $this->idPha = $unePharmacie;
	}


     /******************Function to auto increment seq******************/
function getChoisirPharmacieId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersChoisirPharmacie->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }

	public function getPatient(){
        return $this->idPa;
    }
	
	public function setPatient(int $unPatient){
        $this->idPa = $unPatient;
    }

	 
    public function getPharmacie(){
        return $this->idPha;
    }
	
	public function setPharmacie(int $unePharmacie){
        $this->idPha = $unePharmacie;
    }



}
?>



