<?php
header('Content-Type: application/json');
include_once ("Class/class.utilisateur.php");
include_once ("Class/class.Patient.php");
include_once ("Class/class.medecin.php");
include_once ("Class/class.medicament.php");
include_once ("Class/class.pharmacien.php");
include_once ("Class/class.livreur.php");
include_once ("Class/class.pharmacie.php");
include_once ("Class/class.notice.php");
if($_GET["AdminKey"]!=="ApfBSk5syb5hQ937V73FxwcqsVgS9vip_bCKIlULcdxiq1CWwM6N8wz7uujZ35Gg"){


echo $_COOKIE["session"];
    http_response_code(403);
    echo json_encode(array("Authentification"=>"Acceès non autorisé car la clé est invalide"));
    die();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {



    /**
 * ADD USER
 */
    if (isset($_GET["addUser"])) {
if(
    isset($_POST["nom"]) && !empty($_POST["nom"])
&& isset($_POST["prenom"]) && !empty($_POST["prenom"])
    && isset($_POST["sexe"]) && !empty($_POST["sexe"])
&& isset($_POST["adresse"]) && !empty($_POST["adresse"])
    && isset($_POST["ville"]) && !empty($_POST["ville"])
&& isset($_POST["cp"]) && !empty($_POST["cp"])
&& isset($_POST["email"]) && !empty($_POST["email"])
&& isset($_POST["mdp"]) && !empty($_POST["mdp"])
){
    if(strlen($_POST["nom"])<4 || strlen($_POST["prenom"])<4 || strlen($_POST["adresse"])<4 || strlen($_POST["ville"])<4){
        http_response_code(404);
        echo json_encode(array(" Erreur" => "Nombre de caractère insufisant ! "));
        die();
    }
    if(strlen($_POST["mdp"])<5){
        http_response_code(404);
        echo json_encode(array(" Erreur" => "Format de mot de passe incorrect !"));
        die();
    }
    if(false == filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) || strlen($_POST["email"])<5){
        http_response_code(404);
        echo json_encode(array(" Erreur" => "L'addresse email n'est pas valide ou est incorrect ! "));
        die();
    }


$firtsName=htmlspecialchars($_POST["nom"]);
$lastName=htmlspecialchars($_POST["prenom"]);
$sexe=htmlspecialchars($_POST["sexe"]);
$adresse=htmlspecialchars($_POST["adresse"]);
$ville=htmlspecialchars($_POST["ville"]);
$cp=htmlspecialchars($_POST["cp"]);
$email=htmlspecialchars($_POST["email"]);
$mdp=hash('md5',hash('sha256',htmlspecialchars($_POST["mdp"])));
$grade=(empty($_POST['grade'])) ? 0 : htmlspecialchars($_POST['grade']);
$age=(empty($_POST['age'])) ? null : htmlspecialchars($_POST['age']);
$enceinte=(empty($_POST['enceinte'])) ? null : htmlspecialchars($_POST['enceinte']);
$allaitement=(empty($_POST['allaitement'])) ? false : htmlspecialchars($_POST['allaitement']);
$assurance=(empty($_POST['assurance'])) ? 1 : htmlspecialchars($_POST['assurance']);
$idPharmacie=(empty($_POST['idPharmacie'])) ? null : htmlspecialchars($_POST['idPharmacie']);
switch($grade){
    case 0 :
        if($age===null || $assurance==null || $enceinte==null || $allaitement==null){
            http_response_code(404);
            echo json_encode(array(" Erreur" => "Veuillez remplir tout les champs "));
            die();
        }
        $user = new Patient($firtsName,$lastName,$sexe,$adresse,$ville,$cp,$email,$mdp,$age,$enceinte,$allaitement,$assurance);
        $result =$user->addPatient();
        break;
    case 1:
        $user = new Medecin($firtsName,$lastName,$sexe,$adresse,$ville,$cp,$email,$mdp,$age,$enceinte,$allaitement,$assurance);
        $result =$user->addMedecin();
        break;
    case 2:
        $user = new Livreur($firtsName,$lastName,$sexe,$adresse,$ville,$cp,$email,$mdp,$age,$enceinte,$allaitement,$assurance);
        $result =$user->addLivreur();
        break;
    case 3:
        if($idPharmacie===null){
            http_response_code(404);
        echo json_encode(array(" Erreur" => "Veuillez attribuez une pharmacie à ce pharmacien "));
        die();
        }
        $user = new Pharmacien($firtsName,$lastName,$sexe,$adresse,$ville,$cp,$email,$mdp,$age,$enceinte,$allaitement,$assurance,$idPharmacie);
        $user->setIdPha($idPharmacie);
        $result =$user->addPharmacien();
        break;
}


    


    echo $result;
die();


    
}


else{
    http_response_code(404);
    echo json_encode(array(" Erreur" => " in Body-Post Parameter"));
}

}

 if(isset($_GET["Pharmacie"])){
    if(
        isset($_POST["nom"]) && !empty($_POST["nom"])
    && isset($_POST["adresse"]) && !empty($_POST["adresse"])
        && isset($_POST["ville"]) && !empty($_POST["ville"])
    && isset($_POST["cp"]) && !empty($_POST["cp"])
    && isset($_POST["horaireOuverture"]) && !empty($_POST["horaireOuverture"])
    && isset($_POST["horaireFermeture"]) && !empty($_POST["horaireFermeture"])
    ){
    if($_GET["Pharmacie"]=="add"){
        $nom= htmlspecialchars($_POST["nom"]);
        $adresse=htmlspecialchars($_POST["adresse"]);
        $cp=htmlspecialchars($_POST["ville"]);
        $ville=htmlspecialchars($_POST["cp"]);
        $horaireouverture=htmlspecialchars($_POST["horaireOuverture"]);
        $horairefermeture=htmlspecialchars($_POST["horaireFermeture"]);
       
        $pharmacie=new Pharmacie($nom,$adresse,$cp,$ville,$horaireouverture,$horairefermeture);
       $result = $pharmacie->addPharmacie();
       echo $result;
    }
    
  
    //echo $result;
    die();  
}
else if($_GET["Pharmacie"]=="delete"){
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $idPharmacie=htmlspecialchars($_GET["id"]);
        echo Pharmacie::delPharmacie($idPharmacie);
    }
    else{
        http_response_code(404);
echo json_encode(array(" Erreur" => " Veuillez renseigner l'id de la pharmacie"));
    }
    
}


else if($_GET["Pharmacie"]=="update"){}
else{
    http_response_code(404);
    echo json_encode(array(" Erreur" => " in Body-Post Parameter (pharmacie)"));
}
}




if(isset($_GET["medicament"])){
    if(
        isset($_POST["libelle"]) && !empty($_POST["libelle"])
    && isset($_POST["photo"]) && !empty($_POST["photo"])
        && isset($_POST["description"]) && !empty($_POST["description"])
        && isset($_POST["prix"]) && !empty($_POST["prix"])
    ){

        $libelle=htmlspecialchars($_POST["libelle"]);
        $photo=htmlspecialchars($_POST["photo"]);
        $description=htmlspecialchars($_POST["description"]);
        $prix=htmlspecialchars($_POST["prix"]);

        if((int)$prix<0 || (int)$prix==0){
            http_response_code(404);
            echo json_encode(array(" Erreur" => " Le prix renseingé est incorrect"));
            die();
        }
        if($_GET["medicament"]=="add"){
             
        $medicament=new Medicament($libelle,$photo,$description,$prix);
        $result = $medicament->addMedicament();
        echo $result;

        }
       

    }
    else if ($_GET["medicament"]=="del"){
        if(isset($_GET["id"]) && !empty($_GET["id"])){
          
            
            $idMedicament=htmlspecialchars($_GET["id"]);
            $result= Medicament::delMedicament($idMedicament);
          echo $result;
        }
        else{
            http_response_code(404);
    echo json_encode(array(" Erreur" => " Veuillez renseigner l'id du medicament"));
        }
    }

}










if(isset($_GET["notice"])){
    if($_GET["notice"]=="add"){
        

        if(isset($_POST["idMe"]) && !empty($_POST["idMe"])&& isset($_POST["notice"]) && !empty($_POST["notice"])){
    
            $idMe=htmlspecialchars($_POST["idMe"]);
            $notice=htmlspecialchars($_POST["notice"]);
                 
            $notice=new Notice($idMe,$notice);
            $result = $notice->addNotice();
            echo $result;
    
            
           
    }
     
}
else if($_GET["notice"]=="del"){
    //echo 'too';
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $idNotice=htmlspecialchars($_GET["id"]);
        echo Notice::delNotice($idNotice);

}
    
    else{
        http_response_code(404);
        echo json_encode(array(" Erreur" => " Veuillez renseigner l'id du medicament et la notice"));
    }

  
    

}



}



}


else if($_SERVER["REQUEST_METHOD"] == "GET") {

  /**
 * LIST USER
 */
if (isset($_GET["userList"])) {

    if($_GET["userList"]=="all"){
       
        echo Utilisateur::getUser("all");
    }
    else if($_GET["userList"]=="medecin"){
        echo Utilisateur::getUser("medecin");
    }
    else if($_GET["userList"]=="livreur"){
        echo Utilisateur::getUser("livreur");
    }
    else if($_GET["userList"]=="patient"){
        echo Utilisateur::getUser("patient");
    }
    else if($_GET["userList"]=="pharmacien"){
        echo Utilisateur::getUser("pharmacien");
    }
    
}

if(isset($_GET["list"])){
    if($_GET["list"]=="pharmacie"){
        echo Pharmacie::getPharmacie();
    }

    else if($_GET["list"]=="medicament"){
        echo Medicament::getMedicament();
    }
    

}


}
