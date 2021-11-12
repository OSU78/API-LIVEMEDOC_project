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
include_once ("Class/class.ordonnance.php");



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_GET["useradd"]) && !empty($_GET["useradd"])){
        
        if($_GET["useradd"]=="ordonnancephoto"){
           
   
            if(isset($_POST["photo"]) && !empty($_POST["idPa"])){
                   $idPa=htmlspecialchars($_POST["idPa"]);
                   $photo=htmlspecialchars($_POST["photo"]);
   $patientExsit= Patient::patientExist($idPa);
            
   if($patientExsit==true){
       
$addOrdonnance=new Ordonnance($photo,$idPa);
$result=$addOrdonnance->addOrdonnance();

echo $result;
   }
   else{
    http_response_code(404);
    echo json_encode(array(" Erreur" => " Erreur d'identification id"));
   }
        }

    }
      
    else if($_GET["useradd"]=="commande"){
           
        http_response_code(404);
        echo json_encode(array(" INFO" => " Fonctionalité en cours de production"));
        

}
   


}
}

else if($_SERVER["REQUEST_METHOD"] == "GET"){
    echo "test";
}
