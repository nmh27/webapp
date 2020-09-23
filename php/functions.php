<?php

function dbconnect(){
  $servername = "localhost";
  $dbname = "name";
  $username = "username";
  $password = "password";

  try {
    $conn = new PDO("mysql:host=$servername;
    dbname=$dbname", $username, $password);
  } catch(PDOException $e) {
    echo "Database Connection Error: " . $e->getMessage();
  }
  return $conn
}

function verifyRequest(){

}

function searchForParts(){

}

function searchForConfig(){

}

function sendFaildVer(){

}

function sendResults(){

}

?>
