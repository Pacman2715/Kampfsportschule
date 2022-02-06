<?php

/*
 * Header auf JSON umstellen
 */
header("Content-Type: application/json;charset=utf-8");

$url = $_GET['url'];
$params = explode("/", $url);
//require './functions/dbFunctions.php';

$dbLink = connectToDatabase("localhost", "root", "", "kampfsportschule");

function connectToDatabase($server, $benutzer, $password, $database) {
    $link = mysqli_connect($server, $benutzer, $password, $database);
    if (!$link) {
        die("Datenbankverbindung gescheitert");
    }
    return $link;
}

$dbLink = connectToDatabase("localhost", "root", "", "kampfsportschule");


switch ($params[0]) {
    case "user":
        switch ($params[2]) {
            case "setTrainingStart":
                $resultJson = ["Traininsstart gesetzt."];
                break;

            case "setTrainingEnd":
                $resultJson = ["Trainingsende gesetzt"];
                break;

            case "setExamSeminar":
                $resultJson = ["kp was hier hin muss, bei smith nachfragen. Wahrscheinlich gürtel setzen"];
                break;

            case "getStatistics":
                $userID = abfrageID($dbLink);
                $userVorname = abfrageVorname($dbLink);
                $userNachname = abfrageNachname($dbLink);
                $gruetelFrabe;
                $stiel;
                $resultJson = ["$userID", "$userVorname", "$userNachname", "$url"];
                break;

            default :
                $resultJson = ["Fehler case user"];
                break;
        }
        break;

    case "training":
        if ($params[1] == "getStatistics") {
            
            $resultJson = ["ausgabe statistiken"];

        
        } else if ($params[1] == "setType") {



            $resultJson = ["Typ gesetzt"];
        } else {
            $resultJson = ["Fehler case training","params"=>$params,];
            
        }

        break;

    case "admin":
        if ($params[1] == "addUser") {
            $resultJson = ["User Estellt"];

            #Setzen von name vorname gb.datum und Email nötig.
        } else if ($params[1] == "delUser") {

            #erklät sich von selbst^^

            $resultJson = ["User Gelöscht"];
        } else {
            $resultJson = ["Fehler case Admin"];
        }

        break;

    default :
        $resultJson = ["Fehler case endpoint"];
        break;
}


/*
function abfrageID($dbLink) {
    $url = $_GET['url'];
    $params = explode("/", $url);
    $query = "SELECT * FROM person WHERE id =('" . $params[1] . "')";

    $result = mysqli_query($dbLink, $query);

    while ($row = $result->fetch_assoc()) {
//echo "<option value='".$row['ID']."'>".$row['Vorname']."</option>";
        $ID = $row['ID'];
    }

    return $ID;
}

function abfrageVorname($dbLink) {
    $url = $_GET['url'];
    $params = explode("/", $url);
    $query = "SELECT * FROM person WHERE id =('" . $params[1] . "')";

    $result = mysqli_query($dbLink, $query);

    while ($row = $result->fetch_assoc()) {
//echo "<option value='".$row['ID']."'>".$row['Vorname']."</option>";
        $VORNAME = $row['Vorname'];
    }

    return $VORNAME;
}

function abfrageNachname($dbLink) {
    $url = $_GET['url'];
    $params = explode("/", $url);
    $query = "SELECT * FROM person WHERE id =('" . $params[1] . "')";

    $result = mysqli_query($dbLink, $query);

    while ($row = $result->fetch_assoc()) {
//echo "<option value='".$row['ID']."'>".$row['Vorname']."</option>";
        $NACHNAME = $row['Nachname'];
    }

    return $NACHNAME;
}
*/


/*
  if(isset($_POST['Landspeichern'])){
  echo speichereNeuesLand($dbLink) ? "Speicherung erfolgreich" : "Speicherung fehlgeschlagen";
  }
  if(isset($_POST['ort_locSpeichern'])){
  echo speichereOrtlage($dbLink) ? "Speicherung erfolgreich" : "Speicherung fehlgeschlagen";
  }
 */



/*
  $resultJson = [
  "ID"=>$userID,
  "Vorname"=>$userVorname,
  "Nachname"=>$userNachname,
  "url"=>$url,
  "params"=>$params,
  "test"=>$test
  ];
 */

echo json_encode($resultJson);




