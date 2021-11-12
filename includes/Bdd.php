<?php

require("../../vendor/autoload.php");
//require_once(__DIR__.DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR."main.php");


class Bdd
{
    public $bdd;
   
    public function __construct()
    {
    }

    public function bddConnect(){
        try{
            //$bdd = new PDO('mysql:host=localhost;port=3306;dbname=livmedoc','livmedoc','toor');
            $co = new MongoDB\Client();
            $bdd=$co->livmedoc;
            //echo "OK";
            return $bdd;
	}
    catch (MongoDB\Driver\Exception\AuthenticationException $e) {

        echo "Exception:", $e->getMessage(), "\n";
    } catch (MongoDB\Driver\Exception\ConnectionException $e) {
    
        echo "Exception:", $e->getMessage(), "\n";
    } catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
    
        echo "Exception:", $e->getMessage(), "\n";
    }
    }
}

$bdd=new Bdd();
$bdd->bddConnect();

