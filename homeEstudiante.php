<?php
    session_start();
    if (!isset($_SESSION['id_estudiante'])) {
        include "./notFound.php";
    } else {
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
        include "./modulos/cabeceraEstudiante.php";
        require "./clases/Estudiante.php";

        $estudiante = new Estudiante();
        $arregloEstudiante = $estudiante->verPerfil();

        $fecha_y_hora = date('d/m/Y');
        ?>
        <main>
            <section class="uk-container uk-container-large uk-margin-xlarge-top">
                <h2 class="uk-heading-small">Perfil del estudiante</h2>

                <?php foreach($arregloEstudiante as $estudiante){ ?>
                    <div class="uk-child-width-expand@s uk-text-center" uk-grid>  
                    <div class="uk-card uk-card-default uk-card-large">
                        <div class="uk-margin-medium-top">
                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                                <div class="uk-width-auto">
                                    <img class="uk-border-circle" width="70" height="70" src="./assets/img/profile-logo.png" alt="Avatar">
                                </div>
                                <div class="uk-width-expand">
                                    <h3 class="uk-card-title uk-margin-remove-bottom"><?php echo $estudiante['nombre'] ?></h3>
                                    <p class="uk-text-meta uk-margin-remove-top"><time>Ultima actualizacion: <?php echo $fecha_y_hora; ?></time></p>
                                </div>
                            </div>
                        </div>
                        <h3 class="uk-card-title">Datos personales</h3>
                        <p class="uk-text-normal">Direccion: <span class="uk-text-bold"><?php echo $estudiante['direccion']; ?></span></p>
                        <p class="uk-text-normal">Telefono: <span class="uk-text-bold"><?php echo $estudiante['telefono']; ?></span></p>
                        <p class="uk-text-normal">Correo: <span class="uk-text-bold"><?php echo $estudiante['correo']; ?></span></p>
                        <br>
                    </div>

                    <div class="uk-card uk-card-default uk-card-large uk-card-body uk-margin-medium-left">
                        <h3 class="uk-card-title">Bootcamp</h3>
                        <p class="uk-text-normal">Nombre del Bootcamp: <span class="uk-text-bold"><?php echo $estudiante['bootcamp']; ?></span></p>
                        <p class="uk-text-normal">Carnet: <span class="uk-text-bold"><?php echo $estudiante['carnet']; ?></span></p>
                    </div>
                 </div>
                <?php } ?>
            </section>
        </main>

        <!-- UIkit JS -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>
    </body>

    </html>

<?php } ?>