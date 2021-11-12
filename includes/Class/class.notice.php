<?php
require_once("config.php");

class Notice{   		

        private  $notice ;
        private  $idMe ;

		
	public function __construct($idMe,$notice){
		
		$this->notice = $notice;
		$this->idMe = $idMe;
	}






     /******************Function to auto increment seq******************/
 function getNoticeId($sequenceName){
   

        $db=new Bdd();
        $bdd=$db->bddConnect();
        $retval = $bdd->countersNotice->findOneAndUpdate(
             array('_id' => $sequenceName),
             array('$inc' => array("seq" => 1))
            
        );
        $idIncrement=$retval["seq"]+1;
        
       
        return $idIncrement;
    
    }




    public static function delNotice($idNotice){
        $db=new Bdd();
        $bdd=$db->bddConnect();
        
        $result = $bdd->notice->deleteOne(['_id' => (int)$idNotice]);
    
       
        
        if($result){
            $result= array(
                "etat"=>"Success : Notice supprimer",
                "code"=>202
            );
        }
        else{
            $result= array(
                "etat"=>"Erreur : Cette Notice n'existe pas dans la base ou l'id renseigner est incorrect",
                "code"=>404
            );
        }
        
       return json_encode($result);
    }
    




    public function noticeExist(){
    
        $db=new Bdd();
    $bdd=$db->bddConnect();
    $count=0;
    $result = $bdd->notice->find(array("idMe" =>(int)$this->getIdMe()))->toArray();
    
   
    foreach($result as $data)
    {
        if((int)$data["idMe"]==(int)$this->getIdMe()){
            return false;
        }
       
    }
   
$result2 = $bdd->medicament->find(array("_id" =>(int)$this->getIdMe()))->toArray();
    
   if(empty($result2)){
    return false;
   }
            return true;
    }

    public function addNotice (){
        
       
        if($this->noticeExist()==true){
   
        
        $db=new Bdd();
        $bdd=$db->bddConnect();
        $id=$this->getNoticeId("noticeid");
      
        $utilisateur=$bdd->notice->insertOne(
            [
                "_id"=>(int)$id,
                "idMe"=> (int)$this->getIdMe(),
                "notice" =>$this->getNotice()
              ]);
        
        
        
         $result= array(array(
             "_id"=>$id,
                "idMedicament"=>$this->getIdMe(),
                "notice"=>$this->getNotice()
               
                
            ),array("etat"=>true,"description"=>"Notice ajouter avec succès"));
        
        
         return json_encode($result);
        
           
            $result= array(
                "etat"=>"Erreur : Cette notice existe déja dans la base",
                "code"=>404
            );
           return json_encode($result);
       }
       $result= array(
           "etat"=>"Erreur : Cette Notice n'existe pas ou est deja lier à un medicament",
           "code"=>404
       );
      return json_encode($result);
   
         }



	public function getIdMe(){
        return $this->idMe;
    }
	
	public function setIdMe(int $unId){
        $this->idMe= $unId;
    }

	 
    

    public function getNotice(){
        return $this->notice;
    }
	
	public function setNotice(int $unNotice){
        $this->idMe = $unNotice;
    }



}
?>



