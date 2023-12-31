<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
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
        include "./modulos/cabecera.php";
        require "./clases/Estudiante.php";

        $estudiantes =  new Estudiante();
        $arregloEstudiante = $estudiantes->obtenerEstudiantes();
        $arregloEstado = $estudiantes->estadoPorAsincronoActivoDesersion();
        $arregloBootcamps = $estudiantes->obtenerBootcamps();
        ?>
        <main>
            <section class="uk-container uk-container-large">
                <br>
                <h2 class="uk-heading-small">Estudiantes activos</h2>
                <a href="./registrarEstudiante.php"><button class="uk-button uk-button-primary uk-button-large">Nuevo estudiante </button></a>

                <div class="uk-overflow-auto">
                    <br>
                    <table class="uk-table uk-table-responsive uk-table-divider uk-table-hover">
                        <thead>
                            <tr>
                                <th>Estudiante</th>
                                <th>Carnet</th>
                                <th>Correo</th>
                                <th>Bootcamp</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($arregloEstudiante as $estudiante) { ?>
                                <tr>
                                    <td><?php echo $estudiante['nombre']; ?></td>
                                    <td><?php echo $estudiante['carnet']; ?></td>
                                    <td><?php echo $estudiante['correo']; ?></td>
                                    <td><?php echo $estudiante['bootcamp']; ?></td>
                                    <td><?php echo $estudiante['estado']; ?></td>
                                    <td>
                                        <form action="./actualizarEstudiante.php" method="post">
                                            <input type="hidden" name="id_estudiante" value="<?php echo $estudiante['id']; ?>">
                                            <button type="submit" class="uk-button uk-button-primary uk-button-small" uk-icon="file-edit">Editar </button>
                                        </form>
                                    </td>
                                    <td>
                                        <button class="uk-button uk-button-secondary uk-button-small" uk-icon="check" type="button" uk-toggle="target: #modalEstado<?php echo $estudiante['id']; ?>">Estado </button>
                                    </td>
                                    <td>
                                        <button class="uk-button uk-button-danger uk-button-small" uk-icon="move" type="button" uk-toggle="target: #modalReubicacion<?php echo $estudiante['id']; ?>">Reubicar </button>
                                    </td>
                                </tr>

                                <!-- Modal estado-->
                                <div id="modalEstado<?php echo $estudiante['id']; ?>" uk-modal>
                                    <div class="uk-modal-dialog">
                                        <button class="uk-modal-close-default" type="button" uk-close></button>
                                        <div class="uk-modal-header">
                                            <h2 class="uk-modal-title">Editar estado del estudiante</h2>
                                        </div>
                                        <form action="" method="post">
                                            <div class="uk-modal-body">
                                                <input type="hidden" name="id_estudiante" value="<?php echo $estudiante['id']; ?>">

                                                <p class="uk-text-large uk-text-bold"><?php echo $estudiante['nombre']; ?></p>
                                                <p class="uk-text-default">Estado: <span class="uk-text-bolder">Activo</span></p>
                                                <div class="uk-margin">
                                                    <label for="estado">Cambio de estado</label>
                                                    <select class="uk-select" name="estado">
                                                        <?php foreach ($arregloEstado as $estado) { ?>
                                                            <option value="<?php echo $estado['id']; ?>"><?php echo $estado['estado']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="uk-modal-footer uk-text-right">
                                                <button class="uk-button uk-button-danger uk-modal-close" type="button">Cancelar</button>
                                                <input type="submit" class="uk-button uk-button-primary" value="Actualizar">
                                            </div>
                                        </form>
                                        <?php $estudiantes->actualizarEstado(); ?>
                                    </div>
                                </div>

                                <!--Modal reubicacion-->
                                <div id="modalReubicacion<?php echo $estudiante['id']; ?>" uk-modal>
                                    <div class="uk-modal-dialog">
                                        <button class="uk-modal-close-default" type="button" uk-close></button>
                                        <div class="uk-modal-header">
                                            <h2 class="uk-modal-title">Reubicar estudiante</h2>
                                        </div>
                                        <form action="" method="post">
                                            <div class="uk-modal-body">
                                                <input type="hidden" name="id_estudiante" value="<?php echo $estudiante['id']; ?>">

                                                <p class="uk-text-large uk-text-bold"><?php echo $estudiante['nombre']; ?></p>
                                                <p class="uk-text-default">Bootcamp actual: <span class="uk-text-bolder"><?php echo $estudiante['bootcamp']; ?></span></p>
                                                <div class="uk-margin">
                                                    <label for="estado">Cambiar bootcamp</label>
                                                    <select class="uk-select" name="bootcamp">
                                                        <?php foreach ($arregloBootcamps as $bootcamp) { ?>
                                                            <option value="<?php echo $bootcamp['id']; ?>"><?php echo $bootcamp['bootcamp']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="uk-modal-footer uk-text-right">
                                                <button class="uk-button uk-button-danger uk-modal-close" type="button">Cancelar</button>
                                                <input type="submit" class="uk-button uk-button-primary" value="Reubicar estudiante">
                                            </div>
                                        </form>
                                        <?php $estudiantes->actualizarReubicacion(); ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </main>

        <!-- UIkit JS -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>
    </body>

    </html>

<?php } ?>