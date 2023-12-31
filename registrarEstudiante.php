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
        $arregloBootcamps = $estudiantes->obtenerBootcamps();
        $arregloMaterias = $estudiantes->obtenerMaterias();

     ?>
    <main>
        <section class="uk-container uk-container-xsmall">
            <br>
            <h2 class="uk-heading-small">Registro de estudiantes</h2>
            <form action="" method="POST">
                <div class="uk-margin">
                    <label for="nombre">Nombre completo</label>
                    <input class="uk-input" type="text" name="nombre" required autofocus>
                </div>

                <div class="uk-margin">
                    <label for="direccion">Direccion</label>
                    <input class="uk-input" type="text" name="direccion" required>
                </div>

                <div class="uk-margin">
                    <label for="telefono">Telefono</label>
                    <input class="uk-input" type="number" name="telefono" required min="0" step="1">
                </div>

                <div class="uk-margin">
                    <label for="carnet">Carnet</label>
                    <input class="uk-input" type="text" name="carnet" required>
                </div>

                <div class="uk-margin">
                    <label for="correo">Correo electronico</label>
                    <input class="uk-input" type="email" name="correo" required>
                </div>

                <div class="uk-margin">
                    <label for="bootcamp">Bootcamp</label>
                    <select class="uk-select" name="bootcamp">
                        <?php foreach($arregloBootcamps as $bootcamp) { ?>
                            <option value="<?php echo $bootcamp['id']; ?>"><?php echo $bootcamp['bootcamp']; ?></option>        
                        <?php } ?>    
                    </select>
                </div>

                <div class="uk-margin">
                    <label for="materias">Materias</label>
                    <br>
                    <?php foreach($arregloMaterias as $materias) { ?>          
                        <input class="uk-checkbox" type="checkbox" name="materias[]" value="<?php echo $materias['id']; ?>"> <?php echo $materias['materia']; ?>
                    <?php } ?>
                </div>

                <input type="submit" class="uk-button uk-button-primary uk-button-large" value="Guardar" >    

            </form>
            <?php $estudiantes->guardar(); ?>                
        </section>
    </main>
    
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>
</body>
</html>

<?php } ?>