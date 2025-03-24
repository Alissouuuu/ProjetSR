<?php
    include('header.php');
    $title = "Passez votre carte !";
?>
<body>
    <?php
        include('menu.php');
    ?>


    <header class="bg-success text-white text-center py-5">
        <div class="container">
            <h1><?php echo $title; ?></h1>
            <button>Se connecter</button>
        </div>
    </header>

<?php
    include('footer.php');
?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>