<?php
//get request from body of https
//convert request form json to php object
$request = json_decode(file_get_contents('php://input'));

//SHOULD BE GLOBAL, SET DURING VERIFY REQUEST
$TargetX;
$TargetY;
$TILT;

//include functions.php script
//if faild it will stop this script also
require_once('functions.php');


if(true==verifyRequest($request)){
  $finalconfigs;
  $frames = findStockFrames($request);
  foreach ($frame as $f) {
    $finalconfigs[] = findConfig($f);
  }
  if(empty($finalconfigs)){
    $parts = findParts($request);
  }else {
    //close conn
    sendResults($finalconfigs);
  }
}
else{
  sendFaildVer();
}
//note if you want back end to rember stuff when send waring or req send data back to user
//might be a techincal security risk
//could also create sessions
?>
