<?php
require("../vendor/autoload.php");
//require_once(__DIR__.DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."main.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/API/css//style.css">

</head>
<body>
    <header>
    <?php
$co = new MongoDB\Client();

$db=$co->livmedoc;
/*
$utilisateur=$db->utilisateur->insertOne(
    ["nom" =>"artel", "prenom" => "Georges",
     "sexe"=> "homme", "adresse" =>"2 rue Borromée",
    "ville" => "Paris", "codepostal" => "75015", 
    "email" => "g.martel@gmail.com", "motdepasse" => "abcd1234"]);
*/
//var_dump($db);

//echo "reponse : ".$utilisateur->getInsertedId();

$result = $db->utilisateur->find()->toArray();
foreach($result as $data)
{
    echo $data['nom']." ".$data['prenom']."<br/>";
}
?>
    </header>
    <main>
  
    </main>
</body>
</html>