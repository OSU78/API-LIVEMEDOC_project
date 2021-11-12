<?php
require_once("config.php");

class Commande{   		
      	private static $idCo ;
        private static $datelivraison ;
        private static $horairelivraison ;
        private static $modulepaiement ;

		
	public function __construct($unId, $uneDatelivraison,$unHorairelivraison, $unModulepaiement){
		$this->idCo = $unId;
		$this->datelivraison = $uneDatelivraison;
		$this->horairelivraison = $unHorairelivraison;
		$this->modulepaiement = $unModulepaiement;
	}


       /******************Function to auto increment seq******************/
function getCommandeId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersCommande->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }



	public function getIdCo(){
        return $this->idCo;
    }
	
	public function setIdCo(int $unId){
        $this->idCo = $unId;
    }

	 
    public function getDatelivraison(){
        return $this->datelivraison;
    }
	
	public function setDatelivraison(string $uneDatelivraison){
        $this->datelivraison = $uneDatelivraison;
    }


    public function getHorairelivraison(){
        return $this->horairelivraison;
    }
	
	public function setHorairelivraison(string $unHorairelivraison){
        $this->horairelivraison = $unHorairelivraison;
    }


    public function getModulepaiement(){
        return $this->modulepaiement;
    }
	
	public function setModulepaiement(string $unModulepaiement){
        $this->modulepaiement = $unModulepaiement;
    }
   

   public function getIdPha(){
        return $this->idPha;
    }
    
    public function setIdPha(int $unePharmacie){
        $this->idPha = $unePharmacie;
    }


}
?>



