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
        require "./clases/Coach.php";

        $coaches = new Coach();
        $arregloCoaches = $coaches->obtenerCoach();
        $estadoCoach = $coaches->obtenerEstadoInactivo();

        ?>
        <main>
            <section class="uk-container uk-container-large">
                <br>
                <h2 class="uk-heading-small">Coaches activos</h2>
                <a href="./registrarCoach.php"><button class="uk-button uk-button-primary uk-button-large">Nuevo coach</button></a>

                <div class="uk-overflow-auto">
                    <br>
                    <table class="uk-table uk-table-responsive uk-table-divider uk-table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>Titulo</th>
                                <th>Materia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($arregloCoaches as $profesores) { ?>
                                <tr>
                                    <td><?php echo $profesores['nombre']; ?></td>
                                    <td><?php echo $profesores['direccion']; ?></td>
                                    <td><?php echo $profesores['titulo']; ?></td>
                                    <td><?php echo $profesores['materia']; ?></td>
                                    <td>
                                        <form action="./actualizarCoach.php" method="post">
                                            <input type="hidden" name="id_coach" value="<?php echo $profesores['id']; ?>">
                                            <button type="submit" class="uk-button uk-button-primary uk-button-small" uk-icon="file-edit">Editar </button>
                                        </form>
                                    </td>
                                    <td>
                                        <button class="uk-button uk-button-secondary uk-button-small" uk-icon="check" type="button" uk-toggle="target: #modalEstado<?php echo $profesores['id']; ?>">Estado </button>
                                    </td>
                                </tr>

                                <!--Modal estado-->
                                <div id="modalEstado<?php echo $profesores['id']; ?>" uk-modal>
                                    <div class="uk-modal-dialog">
                                        <button class="uk-modal-close-default" type="button" uk-close></button>
                                        <div class="uk-modal-header">
                                            <h2 class="uk-modal-title">Editar estado del coach</h2>
                                        </div>
                                        <form action="" method="post">
                                            <div class="uk-modal-body">
                                                <input type="hidden" name="id_coach" value="<?php echo $profesores['id']; ?>">

                                                <p class="uk-text-large uk-text-bold"><?php echo $profesores['nombre']; ?></p>
                                                <p class="uk-text-default">Estado: <span class="uk-text-bolder">Activo</span></p>
                                                <div class="uk-margin">
                                                    <label for="estado">Cambio de estado</label>
                                                    <select class="uk-select" name="estado">
                                                        <?php foreach($estadoCoach as $estado){ ?>
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

                                        <?php $coaches->actualizarEstado(); ?>
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