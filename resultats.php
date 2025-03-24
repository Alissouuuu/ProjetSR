<?php
    include('header.php');
    $title = "Voici les résultats !";
?>
<body>
    <?php
        include('menu.php');
    ?>

    <header class="bg-success text-white text-center py-5">
        <div class="container">
            <h1><?php echo $title; ?></h1>
        </div>
    </header>

    <div class="container my-5">

        <?php

            if ($_ROLE == 1){

        ?>

        <button class="btn btn-success" data-bs-toggle="collapse" data-bs-target="#nom_projet">
            Ajouter un projet
        </button>


        <div id="nom_projet" class="collapse mt-2">
        <form action="db_method.php" method="POST">
            <div class="mb-3">
                <label for="nom_projet" class="form-label">Numéro de PING</label>
                <input type="text" class="form-control" id="ping_number" name = "ping_number">
            </div>
            <div class="mb-3">
                <label for="nom_projet" class="form-label">Nom du projet à ajouter</label>
                <input type="text" class="form-control" id="project_name" name = "project_name">
            </div>
            <div class="mb-3">
                <label for="nom_projet" class="form-label">Description du projet</label>
                <textarea class="form-control" id="project_desc" name="project_desc" rows="5" placeholder="Décrivez le projet ..."></textarea>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success" name="add_project">Créer le projet !</button>
            </div>

        </form>
        </div>


        <?php
            }
        ?>

<div class="container mt-5">
    <h2 class="mb-4">Liste des projets</h2>
    <div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Numéro de PING</th>
                <th>Nom du projet</th>
                <th>Nombre de votes</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                $query = "SELECT * FROM projet";
                require_once("param.inc.php");
                $mysqli = new mysqli($host, $login, $passwd, $dbname);
                $query_run = mysqli_query($mysqli, $query);

                // On vérifie que la table n'est pas vide
                if(mysqli_num_rows($query_run) > 0){

                    $stmt = $mysqli->prepare("SELECT * FROM projet");
                    $stmt->execute();
                    $result = $stmt->get_result();

                    //Pour chaque ligne du résultat
                    foreach($query_run as $projet){
                    
                    ?>
                        <tr>
                        <td><?= $projet['ping_number'];?></td>
                        <td><?= $projet['nom'];?></td>
                        <td><?= $projet['nombreVote'];?></td>
                        </tr>
                    <?php
                }
            }
                ?>
            </tr>
            </tbody>
        </table>
        </div>
        </div>
        </div>

<?php
    include('footer.php');
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>