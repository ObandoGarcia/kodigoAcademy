<?php
    session_start();
    if(!isset($_SESSION['id_admin'])){
        include "./notFound.php";
    }else {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kodigo Academy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css" />
</head>
<body>
    <?php 
        include "./modulos/cabecera.php";
    
    ?>
    <main>
        <section class="uk-container uk-container-large uk-margin-medium-top">
            <h1 class="uk-heading-large">Sistema de Kodigo Academy</h1>
            <p class="uk-heading-small">Control de <span class="uk-text-bold">Estudiantes, profesores, materias y bootcamps</span></p>
        </section>
    </main>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>
</body>
</html>

<?php } ?>