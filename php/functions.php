<?php

function dbconnect(){
  $servername = "localhost";
  $dbname = "name";
  $username = "username";
  $password = "password";

  try {
    $conn = new PDO("mysql:host=$servername;
    dbname=$dbname", $username, $password);
    return $conn
  } catch(PDOException $e) {
    echo "Database Connection Error: " . $e->getMessage();
  }
}

function verifyRequest(){

}

function findStockFrame(){

}

function findParts(){

}

function findConfig(){

}

function sendFaildVer(){

}

function sendResults(){

}

class Frame{
  public $id;
  public $hTubeAngle;
  public $hsetCovr;
  public $frameX;
  public $frameY;

  public $sStemAngle;
  public $sStemLength;
  public $sStemIsFlippable;

  public $spacerMin;
  public $spacerMax;

  public $stockConfigs = array();

  function __construct($i,$hTA,$hC,$fX,$fY,$sSA,$sSL,$sSIF,$sMin,$sMax) {
    $id = $i;
    $hTubeAngle = $hTA;
    $hsetCovr = $hC;
    $frameX = $fX;
    $frameY = $fY;
    $sStemAngle = $sSA;
    $sStemLength = $sSL;
    $sStemIsFlippable = $sSIF;
    $spacerMin = $sMin;
    $spacerMax = $sMax;

  }
  function calculateHXY($f,$stems=null){
    //for frames that match filters
    //a bike that met other inputs aswell(filters) example
    $hTubeAngle = $f->hTubeAngle;
    $hsetCovr = $f->hsetCovr;
    $frameX = $f->frameX;
    $frameY = $f->frameY;
    $sMin = $f->sMin;
    $sMax = $f->sMax;

    if($stems===null){
      $stems = array(array(0,$f->sStemAngle,$f->sStemLength,$f->sStemIsFlippable));
    }
    //for all stems possible
    //a stem that fits and meets some more user inputs
    $stemHXYList = array();
    foreach ($stems as $s){
      $stemHXY = array();
      for($i=$sMin;$i<=$sMax;$i+=5){
        $sA = $s[1];
        $sL = $s[2];
        $isF = $s[3];
        while(true){
          $flipped = false;
    			$RadAdjStemA = deg2rad($sA + 90 - $hTubeAngle);

    			$RadAdjHeadA = deg2rad(90 - $hTubeAngle);

    			$B = (($hsetCovr+$i)+20-17*tan(deg2rad($sA)));

    			$StemX = $sL * cos($RadAdjStemA);
    			$spacerDiff = $B * sin($RadAdjHeadA);
    			$X = $StemX - $spacerDiff;

    			$StemY = $sL * sin($RadAdjStemA);
    			$spacerH = $B * cos($RadAdjHeadA);
    			$Y = $StemY + $spacerH;

          $HX = $X+$FrameX;
          $HY = $Y+$FrameY;
          $stemHXY[]=(array($HX,$HY,$s[0],$sA,$sL,$flipped));
          if($isF==true){
            $flipped = true;
            $sA = -1*$sA
            $isF = false;
          }else {
            break;
          }
        }
      }
      $stemHXYList[]=$stemHXY;
    }
    if(1==count($stemHXYList)){
      return $stemHXYList[0];
    }
    else {
      return $stemHXYList;
    }
  }
?>
