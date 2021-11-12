<?php

require_once("config.php");
class Comporter_medicament {   		
      	
        private static $idMe ;
        private static $idCo ;

		
	public function __construct($unMedicament, $uneCommande){
        $this->idMe = $unMedicament;
        $this->idCo = $uneCommande;
	}



      /******************Function to auto increment seq******************/
function getComporterMedicamentId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->counterscomporterMedicament->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }


	public function getMedicament(){
        return $this->idMe;
    }
	
	public function setMedicament(int $unMedicament){
        $this->idMe = $unMedicament;
    }

	 
    public function getCommande(){
        return $this->idCo;
    }
	
	public function setCommande(int $uneCommande){
        $this->idCo = $uneCommande;
    }



}
?>



