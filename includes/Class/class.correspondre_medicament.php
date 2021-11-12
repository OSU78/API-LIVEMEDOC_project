<?php

require_once("config.php");
class Correspondre_Medicament {   		
      	
        private static $idO ;
        private static $idMe ;

		
	public function __construct($uneOrdonnance, $unMedicament){
        $this->idO = $uneOrdonnance;
        $this->idMe = $unMedicament;
	}



/******************Function to auto increment seq******************/
function getCorrespondreMedicamentId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersCorrespondreMedicament->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }




	public function getOrdonnance(){
        return $this->idO;
    }
	
	public function setOrdonnance(int $uneOrdonnance){
        $this->idO = $uneOrdonnance;
    }

	 
    public function getMedicament(){
        return $this->idMe;
    }
	
	public function setMedicament(int $unMedicament){
        $this->idMe = $unMedicament;
    }



}
?>



