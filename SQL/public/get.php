<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

require("../includes/config.php");
$task = " ";
$deviceId = "None";
$degrees = "None";
$errorCode = " ";
$data = "";
$totalDeg = 0;
$donors = "";
$NoDonors = 0;

// Check that all required data was included in the URL
if (!empty($_GET["task"])){
  $task = $_GET["task"];
}
else{
  apologize("What exactly are you trying to do?");
}

if ($task === "current"){
  //Return total degrees in database
  $data = query("SELECT degrees FROM devices");
  if ($data === false){
    apologize("Query failed");
  }
  else{
    foreach ($data as $deg){
      $totalDeg += $deg["degrees"];
    }
    print($totalDeg);
  }
}


if ($task == "donors"){
  // Calculate number of donors
  $donors = query("SELECT deviceid FROM devices");
    $lastDonor = "";
    foreach($donors as $donor){
      if ($donor["deviceid"] != $lastDonor){
        $NoDonors++;
      }
      $lastDonor = $donor["deviceid"];
    }
    print($NoDonors);
}


if ($task == "degrees"){
  //total number of degrees donated, ever
  $data = query("SELECT degrees FROM devices");
  if ($data === false){
    apologize("Query failed");
  }
  else{
    foreach ($data as $deg){
      if ($deg["degrees"] > 0){
        $totalDeg += $deg["degrees"];
      }
    }
    print($totalDeg);
  }
}

if ($task == "insert"){
  // Insert into table
  $insert = query("INSERT INTO devices (deviceid, degrees) VALUES (?, ?)", $_GET["deviceid"], $degrees = $_GET["degrees"]);
  if ($insert === false){
    apologize("Insert Failed");
  }
}

if ($task == "recievers"){
  // no of people recieving degrees
  $recievers = query("SELECT deviceid FROM devices WHERE degrees < 0");
  if ($recievers === false){
    apologize("SQL Failed");
  }
  else{
    $NoRecievers = 0;
    $lastDonor = "";
    foreach($recievers as $reciever){
      
      if ($reciever["deviceid"] != $lastDonor){
        $NoRecievers++;
      }
      
      $lastDonor = $reciever["deviceid"];
    }
    print($NoRecievers);
  }
} 

if ($task == "tempActual"){
  // Update temp in device
  $updateTemp = query("UPDATE recipients SET targetTemp = (?) WHERE deviceid = (?)", $_GET["temp"], $_GET["deviceid"]);
  if ($updateTemp === false){
    apologize("SQL failed");
  }
}

if ($task == "readTemp"){
  $tempActual = query("SELECT targetTemp, deviceid FROM recipients");
  if ($tempActual === false){
    apologize("SQL failed");
  }
  else{
    $deviceid0 = "";
    $deviceid1 = "";
    foreach($tempActual as $tempA){
      if ($tempA["deviceid"] == 0){
        $deviceid0 = $tempA["targetTemp"];
      }
      else if ($tempA["deviceid"] == 1){
        $deviceid1 = $tempA["targetTemp"];
      }
    }
    print("[" . $deviceid0 . ", " . $deviceid1 . "]");

  }
}




?>