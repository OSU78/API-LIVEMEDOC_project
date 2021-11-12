<?php
require_once("config.php");

class Pharmacie{   		
      	private  $idPha ;
        private  $nom ;
        private  $adresse ;
        private  $codepostal ;
        private  $ville ;
        private  $horaireouverture ;
        private  $horairefermeture ;

		
	public function __construct($unNom,$uneAdresse,$unCodepostal, $uneVille,$unHoraireouverture,$unHorairefermeture){
		
        $this->nom = $unNom;
        $this->adresse = $uneAdresse;
        $this->codepostal = $unCodepostal;
        $this->ville = $uneVille;
		$this->horaireouverture = $unHoraireouverture;
		$this->horairefermeture = $unHorairefermeture;
	}


       /******************Function to auto increment seq******************/
function getPharmacieId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersPharmacie->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }



public static function delPharmacie($idPharmacie){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $result = $bdd->pharmacie->deleteOne(['_id' => (int)$idPharmacie]);

    if($result ){
        $result= array(
            "etat"=>"Success : Pharmacie supprimer",
            "code"=>202
        );
    }
    else{
        $result= array(
            "etat"=>"Erreur : Cette pharmacie n'existe pas dans la base ou l'id renseigner est incorrect",
            "code"=>404
        );
    }
    
   return json_encode($result);
}

public function pharmacieExist(){
    $db=new Bdd();
$bdd=$db->bddConnect();

$result = $bdd->pharmacie->find(array('nom' =>$this->nom))->toArray();
foreach($result as $data)
{
    if($data["nom"]==$this->nom){
        return false;
    }
   
}
        return true;

}


    
    public function addPharmacie (){
       
        if($this->pharmacieExist()==true){

     
     $db=new Bdd();
     $bdd=$db->bddConnect();
     $idP=$this->getPharmacieId("pharmacieid");
     $utilisateur=$bdd->pharmacie->insertOne(
         [
             "_id"=>$idP,
             "nom" =>$this->getNom(), "addrese" => $this->getAdresse(),
          "codepostal" => (int)$this->getCodepostal(),"ville" => (int)$this->getVille(),
         "horaireouverture"=>(string)$this->getHoraireouverture(),"horairefermeture"=>(string)$this->getHorairefermeture(),
        ]);
     
     
     
      $result= array(array(
          "_id"=>$idP,
             "nom"=>$this->getNom(),
             "adresse"=>$this->getAdresse(),
             "code_postale"=>$this->getCodepostal(),
             "ville"=>$this->getVille(),
             "horaireouverture"=>$this->getHoraireouverture(),
             "horairefermeture"=>$this->getHorairefermeture()
         ),array("etat"=>true,"description"=>"Pharmacie ajouter avec succès"));
     
     
      return json_encode($result);
     
        }
         $result= array(
             "etat"=>"Erreur : Cette pharmacie existe déja dans la base",
             "code"=>404
         );
        return json_encode($result);
       
      }
    
      
public static function  getPharmacie(){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    $req = $bdd->pharmacie->find()->toArray();
    $result= array(array("etat"=>true,"description"=>"Liste de tout les Pharmacies"),$req);
    return json_encode($result);

}







	public function getIdPha(){
        return $this->idPha;
    }
	
	public function setIdPha(int $unId){
        $this->idPha = $unId;
    }

	 
    public function getNom(){
        return $this->nom;
    }
	
	public function setNom(string $unNom){
        $this->nom = $unNom;
    }


    public function getAdresse(){
        return $this->adresse;
    }
	
	public function setAdresse(string $uneAdresse){
        $this->adresse = $uneAdresse;
    }


    public function getCodepostal(){
        return $this->codepostal;
    }
    
    public function setCodepostal(int $unCodepostal){
        $this->codepostal = $unCodepostal;
    }


    public function getVille(){
        return $this->ville;
    }
    
    public function setVille(string $uneVille){
        $this->ville = $uneVille;
    }


    public function getHoraireouverture(){
        return $this->horaireouverture;
    }
    
    public function setHoraireouverture(int $unHoraireouverture){
        $this->horaireouverture = $unHoraireouverture;
    }


    public function getHorairefermeture(){
        return $this->horairefermeture;
    }
    
    public function setHorairefermeture(int $unHorairefermeture){
        $this->horairefermeture = $unHorairefermeture;
    }



}
?>



