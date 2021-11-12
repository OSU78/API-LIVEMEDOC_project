<?php
require_once("config.php");

class Patient extends Utilisateur{   		
      	
        private $age ;
        private  $enceinte ;
        private $allaitement ;
        private  $idAs ;

		
	public function __construct($unNom, $unPrenom, $unSexe, $uneAdresse, $uneVille, $unCodepostal, $unEmail, $unMdp, $unAge, $enceinte, $allaitement, $uneAssurance){
		parent::__construct( $unNom, $unPrenom, $unSexe, $uneAdresse, $uneVille, $unCodepostal, $unEmail, $unMdp);
        $this->age = $unAge;
        $this->enceinte = $enceinte;
        $this->allaitement = $allaitement;
        $this->idAs = $uneAssurance;
	}



/******************Function to auto increment seq******************/
function getPatientId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersPatient->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }


    public static function patientExist($idP){
    
        $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $result = $bdd->patient->find(array('_id' =>(int)$idP))->toArray();
    foreach($result as $data)
    {
        if($data["_id"]==$idP){
            return true;
        }
       
    }
            return false;
    }

    public function addPatient (){
       $req= parent::addUser();
        if(!isset(json_decode($req)->{"code"})){
    
    $db=new Bdd();
    $bdd=$db->bddConnect();
    $idP=$this->getPatientId("patientid");
    $utilisateur=$bdd->patient->insertOne(
        [
            "_id"=>$idP,
            "nom" =>$this->getNom(), "prenom" => $this->getPrenom(),
         "sexe"=> $this->getSexe(), "adresse" =>$this->getAdresse(),
        "ville" => $this->getVille(), "codepostal" => $this->getCodepostal(), 
        "email" => $this->getEmail(), "motdepasse" => hash("sha256",$this->getMdp()),
        "age"=>$this->getAge(),"enceinte"=>$this->getEnceinte(),
        "allaitement"=>$this->getAllaitement(),"assurance"=>$this->getIdAs() ]);
    
    
    
     $result= array(array(
         "_id"=>$idP,
            "nom"=>$this->getNom(),
            "prenom"=>$this->getPrenom(),
            "sexe"=>$this->getSexe(),
            "adresse"=>$this->getAdresse(),
            "ville"=>$this->getVille(),
            "code_postale"=>$this->getCodepostal(),
            "email"=>$this->getEmail(),
            "mdp"=> $this->getMdp(),
            "age"=>$this->getAge(),
            "allaitement"=>$this->getAllaitement(),
            "assurance"=>$this->getIdAs()
        ),array("etat"=>true,"description"=>"Patient ajouter avec succès"));
    
    
     return json_encode($result);
    }
       
        $result= array(
            "etat"=>"Erreur : Ce email est déja utilisé",
            "code"=>404
        );
       return json_encode($result);
     }
    
    

	public function getAge(){
        return $this->age;
    }
	
	public function setAge(int $unAge){
        $this->age = $unAge;
    }

	 
    public function getEnceinte(){
        return $this->enceinte;
    }
	
	public function setEnceinte(bool $enceinte){
        $this->enceinte = $enceinte;
    }


    public function getAllaitement(){
        return $this->allaitement;
    }
	
	public function SetAllaitement(bool $allaitement){
        $this->allaitement = $allaitement;
    }


    public function getIdAs(){
        return $this->idAs;
    }
	
	public function setIdAs(int $uneAssurance){
        $this->idAs = $uneAssurance;
    }


   

}
?>



