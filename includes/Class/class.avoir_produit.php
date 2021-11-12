<?php

require_once("config.php");
class Avoir_produit {   		
      	
        private static $idPo ;
        private static $idMe ;

		
	public function __construct($unProduit, $unMedicament){
        $this->idPo = $unProduit;
        $this->idMe = $unMedicament;
        
	}


            /******************Function to auto increment seq******************/
function getAvoirProduitId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersAvoirProduit->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }

    public function getProduit(){
        return $this->idPo;
    }
    
    public function setProduit(int $unProduit){
        $this->idPo = $unProduit;
    }



	public function getMedicament(){
        return $this->idMe;
    }
	
	public function setMedicament(int $unMedicament){
        $this->idMe = $unMedicament;
    }

	 
    


}
?>



