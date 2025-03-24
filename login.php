<?php
    $numCarte = "29c6323be6";
    echo "<h1>$numCarte</h1>";
    // Connexion :
    require_once("param.inc.php");
    $mysqli = new mysqli($host, $login, $passwd, $dbname);
    if ($mysqli->connect_error) {
        die('Erreur de connexion (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("SELECT numCarte FROM votant WHERE numCarte = ? ")
    $stmt->bind_param("s", $numCarte);

        if ($stmt -> execute()){
          $result = $stmt->get_result();
          $user_exist = $result->fetch_assoc();
          if ($user_exist) {
            $_SESSION['role'] = $result['numCarte']
            $_SESSION['message'] = "Connecté !";
            exit();
        }else{
            $_SESSION['message'] = "Aucun utilisateur trouvé ...";
        }
    } 


    header('vote.php');
?>