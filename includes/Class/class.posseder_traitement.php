<?php

require_once("config.php");
class Posseder_traitement {   		
      	
        private static $idT ;
        private static $idPa ;

		
	public function __construct($unTraitement, $unPatient){
        $this->idT = $unTraitement;
        $this->idPa = $unPatient;
	}


    /******************Function to auto increment seq******************/
function getPossederTraitementId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersPossederTraitement->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }







	public function getTraitement(){
        return $this->idT;
    }
	
	public function setTraitement(int $unTraitement){
        $this->idT = $unTraitement;
    }

	 
    public function getPatient(){
        return $this->idPa;
    }
	
	public function setPatient(int $unPatient){
        $this->idPa = $unPatient;
    }



}
?>



