<?php
//get request from body of https
//convert request form json to php object
$request = json_decode(file_get_contents('php://input'));

//include functions.php script
//if faild it will stop this script also
require_once('functions.php');


if(true==verifyRequest($request)){
  
}
else{
  sendFaildVer();
}
?>
