<?php

require_once("config.php");

class Utilisateur{


      	private $idU ;
        private $nom ;
      	private $prenom ;
      	private $sexe ;
      	private $adresse ;
		private $ville ;
		private $codepostal ;
		private $email ;
		private $mdp ;
        
    /**
     * @var null
     */



    public function __construct($unNom, $unPrenom, $unSexe, $uneAdresse, $uneVille, $unCodepostal, $unEmail, $unMdp){
		$this->idU = null;
		$this->nom = $unNom;
		$this->prenom = $unPrenom;
		$this->sexe = $unSexe;
		$this->adresse = $uneAdresse;
		$this->ville = $uneVille;
		$this->codepostal = $unCodepostal;
		$this->email = $unEmail;
		$this->mdp = $unMdp;
	}
    

/**
 * NOS FONCTION
 */

/******************Function to auto increment seq******************/
function getUtilisateurId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    $collection = $bdd->countersUtilisateur;
    
    $retval = $bdd->countersUtilisateur->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"];
    
   
    return $idIncrement;
    }
    

public function userExist(){
    
    $db=new Bdd();
$bdd=$db->bddConnect();

$result = $bdd->utilisateur->find(array('email' =>$this->email))->toArray();
foreach($result as $data)
{
    if($data["email"]==$this->email){
        return false;
    }
   
}
        return true;
}


 public function addUser (){

    if($this->userExist()==true){


$db=new Bdd();
$bdd=$db->bddConnect();

$utilisateur=$bdd->utilisateur->insertOne(
    [
        "_id"=>$this->getUtilisateurId("utilisateurid"),
    "nom" =>$this->nom, "prenom" => $this->prenom,
     "sexe"=> $this->sexe, "adresse" =>$this->adresse,
    "ville" => $this->ville, "codepostal" => (int)$this->codepostal, 
    "email" => $this->email, "motdepasse" => hash("sha256",$this->mdp)]);



 $result= array(array(
     "id"=>$this->getIdU(),
        "nom"=>$this->getNom(),
        "prenom"=>$this->getPrenom(),
        "sexe"=>$this->getSexe(),
        "adresse"=>$this->getAdresse(),
        "ville"=>$this->getVille(),
        "code_postale"=>$this->getCodepostal(),
        "email"=>$this->getEmail(),
        "mdp"=>$this->getMdp()
    ),array("etat"=>true,"description"=>"Utilisateur ajouter avec succès"));


 return json_encode($result);
   }
    $result= array(
        "etat"=>"Erreur : Ce email est déja utilisé",
        "code"=>404
    );
   return json_encode($result);
 }


public static function getUser($type){
            
    $db=new Bdd();
    $bdd=$db->bddConnect();

    if($type=="all"){
    $req = $bdd->utilisateur->find()->toArray();
    $result= array(array("etat"=>true,"description"=>"Liste de tout les utilisateurs"),$req);
    return json_encode($result);
    }
    else if($type=="medecin"){
        $req = $bdd->medecin->find()->toArray();
        $result= array(array("etat"=>true,"description"=>"Liste de tout les Medecins"),$req);
        return json_encode($result);
    }
    else if($type=="patient"){
        $req = $bdd->patient->find()->toArray();
        $result= array(array("etat"=>true,"description"=>"Liste de tout les Patient"),$req);
        return json_encode($result);
    }
    else if($type=="pharmacien"){
        $req = $bdd->pharmacien->find()->toArray();
        $result= array(array("etat"=>true,"description"=>"Liste de tout les Pharmacien"),$req);
        return json_encode($result);
    }
    else if($type=="livreur"){
        $req = $bdd->livreur->find()->toArray();
        $result= array(array("etat"=>true,"description"=>"Liste de tout les Livreur"),$req);
        return json_encode($result);
    }

}

 /**
  * FIN
  */





	public function getIdU(){
        return $this->idU;
    }
	
	public function setIdU(int $unId){
        $this->idU = $unId;
    }

	 
    public function getNom(){
        return $this->nom;
    }
	
	public function setNom(string $unNom){
        $this->nom = $unNom;
    }


    public function getPrenom(){
        return $this->prenom;
    }
	
	public function setPrenom(string $unPrenom){
        $this->prenom = $unPrenom;
    }


    public function getSexe(){
        return $this->sexe;
    }
	
	public function setSexe(string $unSexe){
        $this->sexe = $unSexe;
    }


    public function getAdresse(){
        return $this->adresse;
    }
	
	public function setAdresse(string $uneAdresse){
        $this->adresse = $uneAdresse;
    }


    public function getVille(){
        return $this->ville;
    }
	
	public function setVille(string $uneVille){
        $this->ville = $uneVille;
    }


    public function getCodepostal(){
        return $this->codepostal;
    }
	
	public function setCodepostal(int $unCodepostal){
        $this->codepostal = $unCodepostal;
    }


    public function getEmail(){
        return $this->email;
    }
	
	public function setEmail(string $unEmail){
        $this->email = $unEmail;
    }


    public function getMdp(){
        return $this->mdp;
    }
	
	public function setMdp(string $unMdp){
        $this->mdp = $unMdp;
    }


}
?>



