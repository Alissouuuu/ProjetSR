<?php
    include('header.php');
    $title = "Choisissez votre projet PING !";
    $user_id = 1;
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

<div class="container mt-5">
    <h2 class="mb-4">Liste des projets</h2>
    <div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped" style ="table-layout: fixed;">
            <thead>
            <tr>
                <th style = "width: 15%">Numéro de PING</th>
                <th>Nom du projet</th>
                <th style = "width: 20%">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                $query = "SELECT * FROM projet";
                $query2 = "SELECT * FROM Votant WHERE IdVotant=$user_id";
                require_once("param.inc.php");
                $mysqli = new mysqli($host, $login, $passwd, $dbname);
                $query_run = mysqli_query($mysqli, $query);
                $query_run2 = mysqli_query($mysqli, $query2);

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
                        <td><?= $projet['nom'];?>
                        <div id="<?= $projet['IdProjet'];?>" class="collapse">

                            <label for="nom_projet" class="form-label"><?= $projet['project_desc'];?></label>

                            </div>
                        </td>
                        <td>

                            <?php

                                if(mysqli_num_rows($query_run2) > 0){

                                    $stmt = $mysqli->prepare("SELECT * FROM votant WHERE IdVotant=$user_id");
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    //Pour chaque ligne du résultat
                                    foreach($query_run2 as $votant){

                                        if($votant['avote']==0){

                            ?>

                            <form action="db_method.php" method="POST" class="d-inline">
                              <button type="submit" name="voter" value="<?=$projet['IdProjet']; ?>" class="btn btn-dark btn-sm">Voter</button>
                              <input type="hidden" name='us_id' value=$user_id>
                            </form>

                            <?php
                                        }
                                    }
                                }
                            ?>

                            <button class="btn btn-success" data-bs-toggle="collapse" data-bs-target="#<?= $projet['IdProjet'];?>">
                            Description
                            </button>
                        </td>
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