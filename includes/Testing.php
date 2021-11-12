<?php
header('Content-Type: application/json');
include_once ("Class/class.utilisateur.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
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


$firtsName=htmlspecialchars($_POST["nom"]);
$lastName=htmlspecialchars($_POST["prenom"]);
$sexe=htmlspecialchars($_POST["sexe"]);
$adresse=htmlspecialchars($_POST["adresse"]);
$ville=htmlspecialchars($_POST["ville"]);
$cp=htmlspecialchars($_POST["cp"]);
$email=htmlspecialchars($_POST["email"]);
$mdp=hash('md5',hash('sha256',htmlspecialchars($_POST["mdp"])));


    $user = new Utilisateur($firtsName,$lastName,$sexe,$adresse,$ville,$cp,$email,$mdp);
    echo $user->addUser();

   // die();

}

else{
    http_response_code(404);
    echo "erreur 404";
}


}
