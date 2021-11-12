<?php

require_once("config.php");
class Suivre_commande {   		
      	
        private static $idPh ;
        private static $idCo ;

		
	public function __construct($unPharmacien, $uneCommande){
        $this->idPh = $unPharmacien;
        $this->idCo = $uneCommande;
        
	}




       /******************Function to auto increment seq******************/
function getSuivreCommandeId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersSuivreCommande->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }







    public function getPharmacien(){
        return $this->idPh;
    }
    
    public function setPharmacien(int $unPharmacien){
        $this->idPh = $unPharmacien;
    }



	public function getCommande(){
        return $this->idCo;
    }
	
	public function setCommande(int $uneCommande){
        $this->idCo = $uneCommande;
    }

	 
    


}
?>



