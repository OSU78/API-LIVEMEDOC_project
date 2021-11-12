<?php
require_once("config.php");

class Livreur extends Utilisateur{   		
      	

		
	public function __construct($unId, $unNom, $unPrenom, $unSexe, $uneAdresse, $uneVille, $unCodepostal, $unEmail, $unMdp){
		parent::__construct($unId, $unNom, $unPrenom, $unSexe, $uneAdresse, $uneVille, $unCodepostal, $unEmail, $unMdp);
	}



        /******************Function to auto increment seq******************/
function getLivreurId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersLivreur->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }

	public function addLivreur (){
       $req =parent::addUser();
    
	   if(!isset(json_decode($req)->{"code"})){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    $idLi=$this->getLivreurId("livreurid");
    $utilisateur=$bdd->livreur->insertOne(
        [
            "_id"=>$this->$idLi,
            "nom" =>$this->getNom(), "prenom" => $this->getPrenom(),
         "sexe"=> $this->getSexe(), "adresse" =>$this->getAdresse(),
        "ville" => $this->getVille(), "codepostal" => (int)$this->getCodepostal(), 
        "email" => $this->getEmail(), "motdepasse" => hash("sha256",$this->getMdp()),
		
         ]);
    
    
    
     $result= array(array(
         "_id"=>$idLi,
            "nom"=>$this->getNom(),
            "prenom"=>$this->getPrenom(),
            "sexe"=>$this->getSexe(),
            "adresse"=>$this->getAdresse(),
            "ville"=>$this->getVille(),
            "code_postale"=>$this->getCodepostal(),
            "email"=>$this->getEmail(),
            "mdp"=>$this->getMdp()
            
        ),array("etat"=>true,"description"=>"Livreur ajouter avec succès"));
    
    
     return json_encode($result);
       
	}
        $result= array(
            "etat"=>"Erreur : Ce email est déja utilisé",
            "code"=>404
        );
       return json_encode($result);
     }


}
?>



