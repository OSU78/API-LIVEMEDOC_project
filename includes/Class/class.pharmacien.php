<?php

require_once("config.php");
class Pharmacien extends Utilisateur{   		
      	
        
        private $idPha ;

		
	public function __construct($unId, $unNom, $unPrenom, $unSexe, $uneAdresse, $uneVille, $unCodepostal, $unEmail, $unMdp, $unePharmacie){
		parent::__construct($unId, $unNom, $unPrenom, $unSexe, $uneAdresse, $uneVille, $unCodepostal, $unEmail, $unMdp);
        $this->idPha = $unePharmacie;
	}

    /******************Function to auto increment seq******************/
function getPharmacienId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    $collection = $bdd->countersPharmacien;
    
    $retval = $bdd->countersPharmacien->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }

    public function addPharmacien (){
       $req= parent::addUser();
    if(!isset(json_decode($req)->{"code"})){

    
    
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $utilisateur=$bdd->pharmacien->insertOne(
        
        [
            "_id"=>$this->getPharmacienId("pharmacienid"),
            "nom" =>$this->getNom(), "prenom" => $this->getPrenom(),
         "sexe"=> $this->getSexe(), "adresse" =>$this->getAdresse(),
        "ville" => $this->getVille(), "codepostal" => (int)$this->getCodepostal(), 
        "email" => $this->getEmail(), "motdepasse" => hash("sha256",$this->getMdp()),
		"idPha"=>$this->getIdPha()
         ]);
    
    
    
     $result= array(array(
            "nom"=>$this->getNom(),
            "prenom"=>$this->getPrenom(),
            "sexe"=>$this->getSexe(),
            "adresse"=>$this->getAdresse(),
            "ville"=>$this->getVille(),
            "code_postale"=>(int)$this->getCodepostal(),
            "email"=>$this->getEmail(),
            "mdp"=>$this->getMdp(),
            "idPharmacie"=>$this->getIdPha()
            
        ),array("etat"=>true,"description"=>"Pharmacien ajouter avec succès"));
    
    
     return json_encode($result);
    }
        $result= array(
            "etat"=>"Erreur : Ce email est déja utilisé",
            "code"=>404
        );
       return json_encode($result);
     }


	public function getIdPha(){
        return $this->idPha;
    }
	
	public function setIdPha(int $unePharmacie){
        $this->idPha = $unePharmacie;
    }

	 



   

}
?>



