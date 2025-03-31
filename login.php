<?php
    session_start();
    $numCarteTest = "29c6323be6";
    $numCarteAdmin = "c489d0de43";
    $_SESSION['numCarte'] = $numCarteTest;

    // Connexion :
    require_once("param.inc.php");
    $mysqli = new mysqli($host, $login, $passwd, $dbname);
    if ($mysqli->connect_error) {
        die('Erreur de connexion (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("SELECT * FROM votant WHERE numCarte = ? ");
    $stmt->bind_param("s", $numCarteTest);

    if ($stmt->execute()){

        $result = $stmt->get_result()->fetch_assoc();
        $_SESSION['votant'] = $result;
        header('Location: vote.php');
        exit();
    }
?>