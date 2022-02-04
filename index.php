<?php
/*
 * Header auf JSON umstellen
 */
header("Content-Type: application/json;charset=utf-8");

$url = $_GET['url'];
$params = explode("/",$url);
//require './functions/dbFunctions.php';
function connectToDatabase($server, $benutzer, $password, $database) {
    $link = mysqli_connect($server, $benutzer, $password, $database);
    if (!$link) {
        die("Datenbankverbindung gescheitert");
    }
    return $link;
}

$dbLink = connectToDatabase("localhost", "root", "", "kampfsportschule");

//Abfrage von einer Person
function abfrageUser($dbLink){
    $url = $_GET['url'];
    $params = explode("/",$url);
    $query ="SELECT * FROM person WHERE id =('".$params[1]."')";
    $result = mysqli_query($dbLink, $query);
    while($row=$result->fetch_assoc()){
        //echo "<option value='".$row['ID']."'>".$row['Vorname']."</option>";
        $id = $row['ID'];
        $vorname = $row['Vorname'];
        $nachname = $row['Nachname'];
        $geburtstag = $row['Geburtstag'];
        $email = $row['E-Mail'];
    }
    
    $query ="SELECT * FROM erfahrung WHERE Personen_ID =('".$params[1]."')";
    $result = mysqli_query($dbLink, $query);
    while($row=$result->fetch_assoc()){
        //echo "<option value='".$row['ID']."'>".$row['Vorname']."</option>";
        $erfErhaltungsdatum = $row['Erhaltungsdatum'];
        $erfStil = $row['Stil_ID'];
        $erfGuertel = $row['Guertel_ID'];
    }
    
    $query ="SELECT * FROM stil WHERE ID =('".$erfStil."')";
    $result = mysqli_query($dbLink, $query);
    while($row=$result->fetch_assoc()){
        //echo "<option value='".$row['ID']."'>".$row['Vorname']."</option>";
        $stilBeschreibung = $row['Stilbezeichnung'];
    }
    
    $query ="SELECT * FROM guertel WHERE ID =('".$erfGuertel."')";
    $result = mysqli_query($dbLink, $query);
    while($row=$result->fetch_assoc()){
        //echo "<option value='".$row['ID']."'>".$row['Vorname']."</option>";
        $guertelFarbe = $row['Farbe'];
    }
    
    return array($id, $vorname, $nachname, $geburtstag, $email, $erfErhaltungsdatum, $stilBeschreibung, $guertelFarbe);  
}

//Start und Stop eines Trainings
function doTraining($dbLink){
    $url = $_GET['url'];
    $params = explode("/",$url);
     $currentDateAndTime = date('Y-m-d h:i:s', time());  
     if($params[2]=="setTrainingStart"){
        $query = "INSERT INTO `kampfsportschule`.`training` (`Personen_ID`,`Zeit`,`Start/Stop`,`Stil_ID`) VALUES ('".$params[1]."','".$currentDateAndTime."','Start','".$params[3]."');";
     
        if ($dbLink->query($query) === TRUE) {
            return true;
        } else {
            echo "Error: " . $query . "<br>" . $dbLink->error;
        return false;
     }
     }else if ($params[2]=="setTrainingStop"){
        $query = "INSERT INTO `kampfsportschule`.`training` (`Personen_ID`,`Zeit`,`Start/Stop`,`Stil_ID`) VALUES ('".$params[1]."','".$currentDateAndTime."','Stop','".$params[3]."');";
    
        if ($dbLink->query($query) === TRUE) {
           return true;
        } else {
           echo "Error: " . $query . "<br>" . $dbLink->error;
           return false;
        }
    }else{
        return false;
    }
     
     //$query = "INSERT INTO `kampfsportschule`.`training` (`Personen_ID`,`Zeit`,`Start/Stop`,`Stil_ID`) VALUES ('2','1665-02-03 12:26:01','Start','1');";
    
 } 

// hinzufügen oder Löschen von Benutzern
function doEditUser($dbLink){
    $url = $_GET['url'];
    $params = explode("/",$url);
    if($params[0]=="admin" && $params[1]=="addUser"){
        $query = "INSERT INTO `kampfsportschule`.`person` (`Vorname`,`Nachname`,`Geburtstag`,`E-Mail`) VALUES ('".$params[2]."','".$params[3]."','".$params[4]."','".$params[5]."');";
     
        if ($dbLink->query($query) === TRUE) {
            return true;
        } else {
            echo "Error: " . $query . "<br>" . $dbLink->error;
        return false;
        }
    }else if($params[1]=="delUser"){
        $query = "DELETE FROM `kampfsportschule`.`person` WHERE  `ID`='".$params[2]."';";
     
        if ($dbLink->query($query) === TRUE) {
            return true;
        } else {
            echo "Error: " . $query . "<br>" . $dbLink->error;
        return false;
        }
    }
}
 

//Auflistung der Arrays aus afrageUser um die Daten nutzen zu können!
list($id, $vorname, $nachname, $geburtstag, $email,  $erfErhaltungsdatum, $stilBeschreibung, $guertelFarbe) = abfrageUser($dbLink);

$datenbankeintrag = doTraining($dbLink);
//$editUser = doEditUser($dbLink);
//für User
$resultJson = [
    "ID"=>$id,
    "Vorname"=>$vorname,
    "Nachname"=>$nachname,
    "Geburtsdatum"=>$geburtstag,
    "Email"=>$email,
    "Erfahrung in: "=>$stilBeschreibung,
    "Guertelfarbe: "=>$guertelFarbe,
    "Erhalten am: "=>$erfErhaltungsdatum,
    "Training gestartet/gestopt"=>$datenbankeintrag,
    "url"=>$url,
    "params"=>$params
];

//für Admin
/*
$resultJson = [
    "Nenutzeranpassungen"=>$editUser,
    "url"=>$url,
    "params"=>$params
];
*/

echo json_encode($resultJson);
