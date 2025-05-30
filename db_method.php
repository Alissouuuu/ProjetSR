<?php
session_start(); // Démarre la session


// Ajouter un projet dans la BDD
if(isset($_POST['add_project']))
{
    // Connexion :
    require_once("param.inc.php");
    $mysqli = new mysqli($host, $login, $passwd, $dbname);
    if ($mysqli->connect_error) {
        die('Erreur de connexion (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }

    $mysqli->set_charset("utf8mb4");

    // On récupère les données dans chaque variable
    $name =  htmlentities($_POST['project_name']);
    $ping_num = htmlentities($_POST['ping_number']);
    $description =  htmlentities($_POST['project_desc']);
    
    
    if ($stmt = $mysqli->prepare("INSERT INTO projet (nom, ping_number, project_desc) VALUES (?, ?, ?)")) {

        $stmt->bind_param("sis", $name, $ping_num, $description);

        //print_r($stmt);

        // Affichage des messages
        if($stmt->execute()) {
            print_r("Requete executée");
            // Requête exécutée correctement 
            //$_SESSION['message'] = "Enregistrement réussi";

        } else {
            print_r("Requete non executée");
            // Il y a eu une erreur
            //$_SESSION['message'] =  "Impossible d'enregistrer";
        }
    }
    print_r($stmt->sqlstate);
    // Redirection vers la page d'accueil
    header('Location: index.php');
}




// Si on appuye sur le bouton voter (tag = voter)
if(isset($_POST['voter']))
{
    // Connexion :
    require_once("param.inc.php");
    $mysqli = new mysqli($host, $login, $passwd, $dbname);
    if ($mysqli->connect_error) {
        die('Erreur de connexion (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }

    $project_id = htmlentities($_POST['voter']);
    $user_id = $_SESSION['votant']['IdVotant'];


    if ($stmt = $mysqli->prepare("SELECT * FROM projet WHERE IdProjet ='$project_id'")){
        if ($stmt -> execute()){
        $result = $stmt->get_result();
        $user_exist = $result->fetch_assoc();
        $nb_vote = (int) $user_exist['nombreVote'];
        $nv_nb = $nb_vote + 1;
        }
        $stmt->close();
    } 

    if ($stmt = $mysqli->prepare("UPDATE projet SET nombreVote=? WHERE IdProjet ='$project_id'")){
        $stmt->bind_param("i", $nv_nb);
        if ($stmt -> execute()){
            //c'est bien
        }
        $stmt->close();
    }
    
    if ($stmt = $mysqli->prepare("UPDATE votant SET avote=1 WHERE IdVotant = ?")){
        $stmt->bind_param("i", $user_id);
        if ($stmt -> execute()){
            $_SESSION['votant']['avote'] = 1;
            //c'est bien
            header('Location: vote.php');
        }
    }


}

?>

