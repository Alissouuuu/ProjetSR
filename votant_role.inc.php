<?php
    $stmt = $mysqli->prepare("SELECT * FROM votant WHERE numCarte = ?");
    $stmt->bind_param("s", $numCarte);

    if ($stmt->execute())
    {
        $result = $stmt->get_result(); // Récupérer le résultat
        $votant = $result->fetch_assoc(); // Obtenir l'utilisateur

        $user_role = $votant['role'];
    }
    
    $stmt->close();
?>