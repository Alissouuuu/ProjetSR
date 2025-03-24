<?php

    // Connexion :
    require_once("param.inc.php");
    $mysqli = new mysqli($host, $login, $passwd, $dbname);
    if ($mysqli->connect_error) {
        die('Erreur de connexion (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }

    $numCarte = shell_exec('/home/pi/script/tag_detect.sh');
    echo "<h1>$numCarte</h1>";

    if ($stmt = $mysqli->prepare("SELECT numCarte FROM votant WHERE numCarte = '$numCarte'")){
        if ($stmt -> execute()){
          $result = $stmt->get_result();
          $user_exist = $result->fetch_assoc();
          if ($user_exist) {
            $_SESSION['message'] = "Connecté !";
            exit();
        
        }else{
            $_SESSION['message'] = "Aucun utilisateur trouvé ...";
        }
    } 
    }

    header('vote.php');
?>