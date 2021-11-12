<?php
require_once("config.php");

class Medicament{   		
      	private  $idMe ;
        private  $libelle ;
        private  $photo ;
        private  $description ;
        private $prix;
		
	public function __construct($unLibelle,$unePhoto, $uneDescription,$prix){
		
		$this->libelle = $unLibelle;
		$this->photo = $unePhoto;
		$this->description = $uneDescription;
        $this->prix=$prix;
	}


 /******************Function to auto increment seq******************/
 function getMedicamentId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersMedicament->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }


public static function delMedicament($idMedicament){

    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $result = $bdd->medicament->deleteOne(['_id' => (int)$idMedicament]);
  var_dump($result)
;
die();
    if($result ){
        $result= array(
            "etat"=>"Success : Medicament supprimer du catalogue",
            "code"=>202
        );
    }
    else{
        $result= array(
            "etat"=>"Erreur : Cet Medicament n'existe pas dans la base ou l'id est incorrect",
            "code"=>404
        );
    }
    
   return json_encode($result);

}

public function medicamentExist(){
    
    $db=new Bdd();
$bdd=$db->bddConnect();

$result = $bdd->medicament->find(array('libelle' =>$this->getLibelle()))->toArray();
foreach($result as $data)
{
    if($data["libelle"]==$this->getLibelle()){
        return false;
    }
   
}
        return true;
}


    public function addMedicament (){
       
     if($this->medicamentExist()==true){

     
     $db=new Bdd();
     $bdd=$db->bddConnect();
     $idM=$this->getMedicamentId("medicamentid");
     $utilisateur=$bdd->medicament->insertOne(
         [
             "_id"=>$idM,
             "libelle" =>$this->getLibelle(), "photo" => $this->getPhoto(),
          "description"=> $this->getDescription(),
          "prix"=>(int)$this->getPrix()
          ]);
     
     
     
      $result= array(array(
          "_id"=>$idM,
             "libelle"=>$this->getLibelle(),
             "photo"=>$this->getPhoto(),
             "description"=>$this->getDescription(),
             "prix"=>$this->getPrix()
             
         ),array("etat"=>true,"description"=>"Medicament ajouter avec succès"));
     
     
      return json_encode($result);
     
        
         $result= array(
             "etat"=>"Erreur : Ce email est déja utilisé",
             "code"=>404
         );
        return json_encode($result);
    }
    $result= array(
        "etat"=>"Erreur : Ce medicament existe déja dans la base",
        "code"=>404
    );
   return json_encode($result);

      }
     

      public static function  getMedicament(){
        $db=new Bdd();
        $bdd=$db->bddConnect();
        $req = $bdd->medicament->find()->toArray();
        $result= array(array("etat"=>true,"description"=>"Liste de tout les Medicaments"),$req);
        return json_encode($result);
    
    }
    



	public function getIdM(){
        return $this->idMe;
    }
	
	public function setIdM(int $unId){
        $this->idMe = $unId;
    }

    public function getPrix(){
        return $this->prix;
    }
	
	public function setPrix(int $unPrix){
        $this->prix = $unPrix;
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
   

}
?>



