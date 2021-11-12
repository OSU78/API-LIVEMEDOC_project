<?php
require_once("config.php");

Class Avoir_allergie {
        
        private static $idAl ;
        private static $idPa ;

        
    public function __construct($uneAllergie, $unPatient){
        $this->idAl = $uneAllergie;
        $this->idPa = $unPatient;
    }


  /******************Function to auto increment seq******************/
function getAvoirAllergieId($sequenceName){
    $db=new Bdd();
    $bdd=$db->bddConnect();
    
    $retval = $bdd->countersAvoirAllergie->findOneAndUpdate(
         array('_id' => $sequenceName),
         array('$inc' => array("seq" => 1))
        
    );
    $idIncrement=$retval["seq"]+1;
    
   
    return $idIncrement;
    }
    

    public function getAllergie(){
        return $this->idAl;
    }
    
    public function setAllergie(int $uneAllergie){
        $this->idAl = $uneAllergie;
    }

     
    public function getPatient(){
        return $this->idPa;
    }
    
    public function setPatient(int $unPatient){
        $this->idPa = $unPatient;
    }



}
?>



