<?php
    session_start();
    $numCarteTest = "29c6323be6";
    $numCarteAdmin = "c489d0de43";
    $numCarte = shell_exec('/home/pi/script/tag_detect.sh');
    $_SESSION['numCarte'] = $numCarte;

    // Connexion :
    require_once("param.inc.php");
    $mysqli = new mysqli($host, $login, $passwd, $dbname);
    if ($mysqli->connect_error) {
        die('Erreur de connexion (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }

    $stmt = $mysqli->prepare("SELECT * FROM votant WHERE numCarte = ? ");
    $stmt->bind_param("s", $numCarte);

    if ($stmt->execute()){

        $result = $stmt->get_result()->fetch_assoc();
        $_SESSION['votant'] = $result;
        // echo "Nom du votant : " . $_SESSION['votant']['nom'];
        // echo "Nom du votant : " . $_SESSION['votant']['IdVotant'];
        // echo "Nom du votant : " . $_SESSION['votant']['avote'];
        // echo "Nom du votant : " . $_SESSION['votant']['numCarte'];
        header('Location: vote.php');
        exit();
    }
?>