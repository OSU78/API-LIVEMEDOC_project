<?php

require_once("config.php");
class Livrer_commande {   		
      	
        private static $idL ;
        private static $idCo ;

		
	public function __construct($unLivreur, $uneCommande){
        $this->idL = $unLivreur;
        $this->idCo = $uneCommande;
        
	}



    /******************Function to auto increment seq******************/
function getLivrerCommandeId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersLivrerCommande->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }



    public function getLivreur(){
        return $this->idL;
    }
    
    public function setLivreur(int $unLivreur){
        $this->idL = $unLivreur;
    }



	public function getCommande(){
        return $this->idCo;
    }
	
	public function setCommande(int $uneCommande){
        $this->idCo = $uneCommande;
    }

	 
    


}
?>



