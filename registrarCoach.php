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
    $arregloBootcamps = $coaches->obtenerBootcamps();
    $arregloMaterias = $coaches->obtenerMaterias();
    ?>
    <main>
        <section class="uk-container uk-container-xsmall">
            <br>
            <h2 class="uk-heading-small">Registro de coaches</h2>
            <form action="" method="post">
                <div class="uk-margin">
                    <label for="nombre">Nombre completo</label>
                    <input class="uk-input" type="text" name="nombre" required autofocus>
                </div>

                <div class="uk-margin">
                    <label for="direccion">Direccion</label>
                    <input class="uk-input" type="text" name="direccion" required>
                </div>

                <div class="uk-margin">
                    <label for="titulo">Titulo</label>
                    <input class="uk-input" type="text" name="titulo" required>
                </div>

                <div class="uk-margin">
                    <label for="correo">Correo electronico</label>
                    <input class="uk-input" type="email" name="correo" required>
                </div>

                <div class="uk-margin">
                    <label for="bootcamps">Bootcamp</label>
                    <br>
                        <?php foreach($arregloBootcamps as $bootcamps){ ?>
                            <input class="uk-checkbox" type="checkbox" name="bootcamps[]" value="<?php echo $bootcamps['id']; ?>"><?php echo $bootcamps['bootcamp']; ?></input>        
                        <?php } ?>
                </div>

                <div class="uk-margin">
                    <label for="materia">Materia</label>
                    <select class="uk-select" name="materia">
                        <?php foreach($arregloMaterias as $materia){ ?>
                            <option value="<?php echo $materia['id']; ?>"><?php echo $materia['materia']; ?></option>        
                        <?php } ?>
                    </select>
                </div>

                <input type="submit" class="uk-button uk-button-primary uk-button-large" value="Guardar" > 
            </form>
            <?php $coaches->guardar(); ?>
        </section>
    </main>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>

</body>

</html>

<?php } ?>