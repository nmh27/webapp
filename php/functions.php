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

/*
  FUNCTION: verifyRequest

  PARAMETERS: Request php object
  NOTE: also sets the global variables targetsx,y and tilt in find.php
  RETURNS:  true if request passed verification
            false if failed
*/
function verifyRequest($req){

}


/*
  FUNCTION: findStockFrames

  PARAMETERS: Request(php object), CONN(mySQL connection)
  RETURNS:  List of Frames that match the REQUEST
*/
function findStockFrames($req){
  //<---create mySQL query from the request
  //    for bike geometrey and stock stem

  //<---query the Database

  //<---for all rows returned from reqesut
    //<----create frame object (is defined at bottom of file)
    //<----add frame to a list

  //<---returns list of frames
}


/*
  FUNCTION: findConfig
  PARAMETERS: FRAMES(class)
  RETURNS: the ids of all parts of config?

  PARAMETERS: FRAMES(class), STEMS(array(array()))
  RETURNS: the id of all parts of config?
*/
function findConfig($frames,$stems=null){
  //<---if stems param provided
    //<----$listofstems = calcluateHXY(frame,stems)

  //<----create query for request of configs
  //return results
}


function findParts($req){

}

/*
  FUNCTION: sendFaildVer

  what to do when verification fails to user
*/
function sendFaildVer(){

}

function sendResults($configs){

}

/*
  FUNCTION: calculateHXY

  PARAMETERS: FRAME(class)
  returns list HXYS for stock stem ONLY! array(array())

  PARAMETERS: FRAME(class), stems(array)
  returns list of HXYS for each stem (array(array(array()))
  NOTE: stems(array) input FORMAT is [stemID, Angle, Length, isFlippable]
*/
function calculateHXY($f,$stems=null){
  //Frame Values required for calculating
  $hTubeAngle = $f->hTubeAngle;
  $hsetCovr = $f->hsetCovr;
  $frameX = $f->frameX;
  $frameY = $f->frameY;
  $sMin = $f->sMin;
  $sMax = $f->sMax;

  //if called without PARAM: stems(array)
  if($stems===null){
    //ADD the stock stem to an array for calculating
    $stems = array(array(0,$f->sStemAngle,$f->sStemLength,$f->sStemIsFlippable));
  }

  $stemHXYList = array();
  //for all stems in the array calculated HXY
  foreach ($stems as $s){
    $stemHXY = array();
    //for all possible spacing calcluate HXY
    for($i=$sMin;$i<=$sMax;$i+=5){
      $sA = $s[1];
      $sL = $s[2];
      $isF = $s[3];
      //while true EXPLAINED in IF BREAK
      while(true){
        $flipped = false;//default calculation is not flipped

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
        $ao = $TargetX - $HX;
        $as = $TargetY - $HY;
        $stemHXY[]=(array($ao,$as,$HX,$HY,$s[0],$sA,$sL,$flipped,$i));

        //if is flippable
        //repeat loop with it Angle flipped
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
  //if only one stem just return its possible HXY postions
  if(1==count($stemHXYList)){
    return $stemHXYList[0];
  }
  //if more than one return an array(array(array()))
  else {
    return $stemHXYList;
  }
}

/*
CLASS: FRAME
values from FRAME GEOMETREY
*/
class Frame{
  public $id;//SizeCODE
  public $hTubeAngle; //Head Tube Angle
  public $hsetCovr; //Headset Cover
  public $frameX; //Frame X
  public $frameY; //Frame Y

  public $sStemAngle; //Stock Stem Angle
  public $sStemLength; //Stock Stem Length
  public $sStemIsFlippable; //Stock Stem is Flippable

  public $spacerMin;
  public $spacerMax;

  public $stockConfigs; //HXY postions using just the stock stem and spacing

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
    $stockConfigs = calculateHXY($this);
  }
  function getStockConfigs(){
    return $this->$stockConfigs;
  }
}
?>
