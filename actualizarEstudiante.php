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
    require "./clases/Estudiante.php";

    $estudiantes = new Estudiante();
    $obtenerDatos = $estudiantes->obtenerPorId();
    ?>
    <main>
        <section class="uk-container uk-container-xsmall">
            <br>
            <h2 class="uk-heading-small">Editar estudiante</h2>
            <form action="" method="post">
                <?php foreach($obtenerDatos as $datos) { ?>
                    <input type="hidden" name="id_estudiante" value="<?php echo $datos['id']; ?>">

                    <div class="uk-margin">
                        <label for="nombre">Nombre completo</label>
                        <input class="uk-input" type="text" name="nombre" value="<?php echo $datos['nombre']; ?>" required>
                    </div>

                    <div class="uk-margin">
                        <label for="direccion">Direccion</label>
                        <input class="uk-input" type="text" name="direccion" value="<?php echo $datos['direccion']; ?>" required>
                    </div>

                    <div class="uk-margin">
                        <label for="telefono">Telefono</label>
                        <input class="uk-input" type="number" name="telefono" value="<?php echo $datos['telefono']; ?>" required min="0" step="1">
                    </div>

                    <div class="uk-margin">
                        <label for="correo">Correo electronico</label>
                        <input class="uk-input" type="email" name="correo" value="<?php echo $datos['correo']; ?>" required>
                    </div>

                    <input type="submit" class="uk-button uk-button-primary uk-button-large" value="Actualizar" >
                <?php } ?>
            </form>

            <?php $estudiantes->actualizar(); ?>
        </section>
    </main>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>
</body>

</html>

<?php } ?>