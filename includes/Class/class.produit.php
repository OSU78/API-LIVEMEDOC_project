<?php

require_once("config.php");
class Produit{   		
      	private static $idPo ;
        private static $libelle ;
        private static $photo ;
        private static $description ;
        private static $idPha ;

		
	public function __construct($unId, $unLibelle,$unePhoto, $uneDescription, $unePharmacie){
		$this->idPo = $unId;
		$this->libelle = $unLibelle;
		$this->photo = $unePhoto;
		$this->description = $uneDescription;
        $this->idPha = $unePharmacie;
	}




       /******************Function to auto increment seq******************/
function getProduitId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersProduit->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }






	public function getIdPo(){
        return $this->idPo;
    }
	
	public function setIdPo(int $unId){
        $this->idPo = $unId;
    }

	 
    public function getLibelle(){
        return $this->libelle;
    }
	
	public function setLibelle(string $unLibelle){
        $this->libelle = $unLibelle;
    }


    public function getPhoto(){
        return $this->photo;
    }
	
	public function setPhoto(string $unePhoto){
        $this->photo = $unePhoto;
    }


    public function getDescription(){
        return $this->description;
    }
	
	public function setDescription(string $uneDescription){
        $this->description = $uneDescription;
    }
   

   public function getIdPha(){
        return $this->idPha;
    }
    
    public function setIdPha(int $unePharmacie){
        $this->idPha = $unePharmacie;
    }


}
?>



