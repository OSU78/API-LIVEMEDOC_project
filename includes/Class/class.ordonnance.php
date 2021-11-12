<?php

require_once("config.php");
class Ordonnance {   		
      	private $idO ;
        private $dateordo ;
	private $photo;
        private $contenu ;
        private $idPa ;
        private $idM ;

		
	public function __construct($unePhoto, $unPatient){
		
		
		$this->photo = $unePhoto;
	
		$this->idPa = $unPatient;
		
	}



 /******************Function to auto increment seq******************/
 function getOrdonnanceId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersOrdonnance->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }

    public function addOrdonnance (){
        
       
       
        
        $db=new Bdd();
        $bdd=$db->bddConnect();
        $id=$this->getOrdonnanceId("ordonnanceid");
      
        $utilisateur=$bdd->ordonnance->insertOne(
            [
                "_id"=>(int)$id,
                "dateordo"=> date("d/m/y"),
                "photo" =>$this->getPhoto(),
                "idPa"=>(int)$this->getIdPa()
              ]);
        
        
        
         $result= array(array(
             "_id"=>(int)$id,
                "dateordo"=>date("d/m/y"),
                "photo"=>$this->getPhoto(),
                "idPa"=>(int)$this->getIdPa()
               
                
            ),array("etat"=>true,"description"=>"Ordonnance ajouter avec succès"));
        
        
         return json_encode($result);
        
           
    
   
         }


	public function getIdO(){
        return $this->idO;
    }
	
	public function setIdO(int $unId){
        $this->idO = $unId;
    }

	 
    public function getDateordo(){
        return $this->dateordo;
    }
	
	public function setDateordo(string $uneDateordo){
        $this->dateordo = $uneDateordo;
    }


	 public function getPhoto(){
        return $this->photo;
    }
	
	public function setPhoto(string $unePhoto){
        $this->photo = $unePhoto;
    }

   
    public function getContenu(){
        return $this->contenu;
    }
	
	public function setContenu(string $unContenu){
        $this->contenu = $unContenu;
    }


    public function getIdPa(){
        return $this->idPa;
    }
	
	public function setIdPa(int $unPatient){
        $this->idPa = $unPatient;
    }


    public function getIdM(){
        return $this->idM;
    }
	
	public function setIdM(int $unMedecin){
        $this->idM = $unMedecin;
    }

}
?>