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
    require "./clases/Coach.php";

    $coaches = new Coach();
    $obtenerCoach = $coaches->obtenerPorId();
    ?>
    <main>
        <section class="uk-container uk-container-xsmall">
            <br>
            <h2 class="uk-heading-small">Editar coach</h2>
            <form action="" method="post">
                <?php foreach ($obtenerCoach as $dataCoach) { ?>
                    <input type="hidden" name="id_coach" value="<?php echo $dataCoach['id']; ?>">

                    <div class="uk-margin">
                        <label for="nombre">Nombre completo</label>
                        <input class="uk-input" type="text" name="nombre" value="<?php echo $dataCoach['nombre']; ?>" required>
                    </div>

                    <div class="uk-margin">
                        <label for="direccion">Direccion</label>
                        <input class="uk-input" type="text" name="direccion" value="<?php echo $dataCoach['direccion']; ?>" required>
                    </div>

                    <div class="uk-margin">
                        <label for="titulo">Titulo</label>
                        <input class="uk-input" type="text" name="titulo" value="<?php echo $dataCoach['titulo']; ?>" required>
                    </div>

                    <div class="uk-margin">
                        <label for="correo">Correo electronico</label>
                        <input class="uk-input" type="email" name="correo" value="<?php echo $dataCoach['correo']; ?>" required>
                    </div>

                    <input type="submit" class="uk-button uk-button-primary uk-button-large" value="Actualizar" >
                <?php } ?>
            </form>

            <?php $coaches->actualizar(); ?>
        </section>
    </main>
    
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>
</body>

</html>
<?php } ?>