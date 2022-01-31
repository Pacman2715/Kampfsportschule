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

function abfrageID($dbLink){
    $url = $_GET['url'];
    $params = explode("/",$url);
    $query ="SELECT * FROM person WHERE id =('".$params[1]."')";
    
    $result = mysqli_query($dbLink, $query);

    while($row=$result->fetch_assoc()){
        //echo "<option value='".$row['ID']."'>".$row['Vorname']."</option>";
        $ID = $row['ID'];
    }
    
    return $ID;
    
}

function abfrageVorname($dbLink){
    $url = $_GET['url'];
    $params = explode("/",$url);
    $query ="SELECT * FROM person WHERE id =('".$params[1]."')";
    
    $result = mysqli_query($dbLink, $query);

    while($row=$result->fetch_assoc()){
        //echo "<option value='".$row['ID']."'>".$row['Vorname']."</option>";
        $VORNAME = $row['Vorname'];
    }
    
    return $VORNAME;
    
}

function abfrageNachname($dbLink){
    $url = $_GET['url'];
    $params = explode("/",$url);
    $query ="SELECT * FROM person WHERE id =('".$params[1]."')";
    
    $result = mysqli_query($dbLink, $query);

    while($row=$result->fetch_assoc()){
        //echo "<option value='".$row['ID']."'>".$row['Vorname']."</option>";
        $NACHNAME = $row['Nachname'];
    }
    
    return $NACHNAME;
    
}
/*
if(isset($_POST['Landspeichern'])){
    echo speichereNeuesLand($dbLink) ? "Speicherung erfolgreich" : "Speicherung fehlgeschlagen";
}
if(isset($_POST['ort_locSpeichern'])){
    echo speichereOrtlage($dbLink) ? "Speicherung erfolgreich" : "Speicherung fehlgeschlagen";
}
*/

$userID = abfrageID($dbLink);
$userVorname = abfrageVorname($dbLink);
$userNachname = abfrageNachname($dbLink);

$resultJson = [
    "ID"=>$userID,
    "Vorname"=>$userVorname,
    "Nachname"=>$userNachname,
    "url"=>$url,
    "params"=>$params
];


echo json_encode($resultJson);




/*
<!--
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        Post-Methode aus Tabellen aus altem Projekt
        <form action="" method="post" style="display: flex; flex-wrap: wrap">    
        </form>

        
    </body>
</html>
-->
*/
