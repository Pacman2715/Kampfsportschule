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

//Switchcases von Christian
switch ($params[0]) {
    case "user":
        switch ($params[2]) {
            case "setTrainingStart":
                function doTrainingStart($dbLink){
                    $url = $_GET['url'];
                    $params = explode("/",$url);
                    $currentDateAndTime = date('Y-m-d h:i:s', time());  
                    $query = "INSERT INTO `kampfsportschule`.`training` (`Personen_ID`,`Zeit`,`Start/Stop`,`Stil_ID`) VALUES ('".$params[1]."','".$currentDateAndTime."','Start','".$params[3]."');";
                    if ($dbLink->query($query) === TRUE) {
                        return $currentDateAndTime;
                    } else {
                        echo "Error: " . $query . "<br>" . $dbLink->error;
                    return false;
                    }  
                }
                $datenbankeintrag = doTrainingStart($dbLink);
                $resultJson = [
                    "Training gestartet am: "=>$datenbankeintrag,
                    "url"=>$url,
                    "params"=>$params
                ];
                break;

            case "setTrainingEnd":
                function doTrainingEnd($dbLink){
                    $url = $_GET['url'];
                    $params = explode("/",$url);
                    $currentDateAndTime = date('Y-m-d h:i:s', time());  
                    $query = "INSERT INTO `kampfsportschule`.`training` (`Personen_ID`,`Zeit`,`Start/Stop`,`Stil_ID`) VALUES ('".$params[1]."','".$currentDateAndTime."','Stop','".$params[3]."');";
                    if ($dbLink->query($query) === TRUE) {
                        return $currentDateAndTime;
                    } else {
                        echo "Error: " . $query . "<br>" . $dbLink->error;
                    return false;
                    }
                }
                $datenbankeintrag = doTrainingEnd($dbLink);
                $resultJson = [
                    "Training gestopt am: "=>$datenbankeintrag,
                    "url"=>$url,
                    "params"=>$params
                ];
                break;

            case "setExamSeminar":
                
                function doSetExamSeminar($dbLink){
                
                    $url = $_GET['url'];
                    $params = explode("/",$url);
                    $query = "INSERT INTO `kampfsportschule`.`erfahrung` (`Erhaltungsdatum`,`Personen_ID`,`Stil_ID`,`Guertel_ID`) VALUES ('".$params[3]."','".$params[1]."','".$params[4]."','".$params[5]."');";
                    if ($dbLink->query($query) === TRUE) {
                        return true;
                    } else {
                        echo "Error: " . $query . "<br>" . $dbLink->error;
                    return false;
                    }
                
                }
                $datenbankeintrag = doSetExamSeminar($dbLink);
                $resultJson = [
                    "Eine neue Erfahrungsstufe wurde hinzugefügt: "=>$datenbankeintrag,
                    "url"=>$url,
                    "params"=>$params
                ];
                break;

            case "getStatistics":
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
                list($id, $vorname, $nachname, $geburtstag, $email,  $erfErhaltungsdatum, $stilBeschreibung, $guertelFarbe) = abfrageUser($dbLink);
                $resultJson = [
                    "ID"=>$id,
                    "Vorname"=>$vorname,
                    "Nachname"=>$nachname,
                    "Geburtsdatum"=>$geburtstag,
                    "Email"=>$email,
                    "Erfahrung in: "=>$stilBeschreibung,
                    "Guertelfarbe: "=>$guertelFarbe,
                    "Erhalten am: "=>$erfErhaltungsdatum,
                    "url"=>$url,
                    "params"=>$params
                ];
                break;

            default :
                $resultJson = ["Fehler case user"];
                break;
        }
        break;

    case "training":
        if ($params[2] == "getStatistics") {
            
            function doGetStatisticsTraining($dbLink){
                $url = $_GET['url'];
                $params = explode("/",$url);
                $query ="SELECT * FROM training WHERE Stil_ID =('".$params[1]."') AND personen_ID = ('".$params[3]."')";
                $result = mysqli_query($dbLink, $query);
                while($row=$result->fetch_assoc()){
                    //echo "<option value='".$row['ID']."'>".$row['Vorname']."</option>";
                    $zeit = $row['Zeit'];
                    $startStop = $row['Start/Stop'];
                    $personenID = $row['Personen_ID'];
                }
                
                $query ="SELECT * FROM person WHERE id =('".$personenID."')";
                $result = mysqli_query($dbLink, $query);
                while($row=$result->fetch_assoc()){
                    //echo "<option value='".$row['ID']."'>".$row['Vorname']."</option>";
                    $vorname = $row['Vorname'];
                    $nachname = $row['Nachname'];
                }

                
                
                $query ="SELECT * FROM stil WHERE id =('".$params[1]."')";
                $result = mysqli_query($dbLink, $query);
                while($row=$result->fetch_assoc()){
                    //echo "<option value='".$row['ID']."'>".$row['Vorname']."</option>";
                    $stilbezeichnung = $row['Stilbezeichnung'];
                }
                return array($zeit, $startStop, $stilbezeichnung, $vorname, $nachname);
            }
            
            list($zeit, $startStop, $stilbezeichnung, $vorname, $nachname) = doGetStatisticsTraining($dbLink);
                $resultJson = [
                    "Trainingsstil"=>$stilbezeichnung,
                    "Training am: "=>$zeit,
                    ""=>$startStop,
                    "Vorname"=>$vorname,
                    "Nachname"=>$nachname,
                    "url"=>$url,
                    "params"=>$params
                ];

        
        } else if ($params[1] == "setType") {

            function doSetTrainingType($dbLink){
                $url = $_GET['url'];
                $params = explode("/",$url);
                $query = "INSERT INTO `kampfsportschule`.`stil` (`Stilbezeichnung`) VALUES ('".$params[2]."');";
                if ($dbLink->query($query) === TRUE) {
                    return $newTrainingType = $params[2];
                } else {
                    echo "Error: " . $query . "<br>" . $dbLink->error;
                return false;
                }
            }
            $newTrainingType=doSetTrainingType($dbLink);
            $resultJson = [
                "Neuer Trainingsstil wurde hinzugefuegt: "=>$newTrainingType,
                "url"=>$url,
                "params"=>$params
            ];
        } else {
            $resultJson = ["Fehler case training","params"=>$params,];
            
        }

        break;

    case "admin":
        if ($params[1] == "addUser") {
            function doEditUser($dbLink){
                $url = $_GET['url'];
                $params = explode("/",$url);
                $query = "INSERT INTO `kampfsportschule`.`person` (`Vorname`,`Nachname`,`Geburtstag`,`E-Mail`) VALUES ('".$params[2]."','".$params[3]."','".$params[4]."','".$params[5]."');";
                if ($dbLink->query($query) === TRUE) {
                    return true;
                } else {
                    echo "Error: " . $query . "<br>" . $dbLink->error;
                return false;
                }
            }
            $editUser = doEditUser($dbLink);
            $resultJson = [
                "Nenutzeranpassungen"=>$editUser,
                "url"=>$url,
                "params"=>$params
            ];

            #Setzen von name vorname gb.datum und Email nötig.
        } else if ($params[1] == "delUser") {
            
            function doEditUser($dbLink){
                $url = $_GET['url'];
                $params = explode("/",$url);
                $query = "DELETE FROM `kampfsportschule`.`person` WHERE  `ID`='".$params[2]."';";
                if ($dbLink->query($query) === TRUE) {
                    return true;
                } else {
                    echo "Error: " . $query . "<br>" . $dbLink->error;
                return false;
                }
            }
            $editUser = doEditUser($dbLink);
            $resultJson = [
                "Nenutzeranpassungen"=>$editUser,
                "url"=>$url,
                "params"=>$params
            ];
        } else {
            $resultJson = ["Fehler case Admin"];
        }

        break;

    default :
        $resultJson = ["Fehler case endpoint"];
        break;
}

echo json_encode($resultJson);
