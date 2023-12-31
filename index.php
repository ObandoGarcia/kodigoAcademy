<?php 
    session_start();    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kodigo Academy</title>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css" />
</head>
<body>
    <main>
        <?php 
            require "./clases/Autenticacion.php";
            $autenticar = new Autenticacion();
        ?>
        <section class="uk-container uk-container-xsmall uk-margin-xlarge-top">
            <div uk-img>
                <img src="./assets/img/KODIGO_LOGO.png" alt="Logo de kodigo">
            </div>
            <form id="formularioSesion" action="" method="post">
                <div class="uk-margin uk-margin-large-top">
                    <label for="correo">Correo electronico</label>
                    <input class="uk-input" type="email" name="correo" required>
                </div>
                <div class="uk-margin">
                    <label for="contrasenia">Contrasenia</label>
                    <input class="uk-input" type="password" name="contrasenia" required>
                </div>
                <input type="submit" class="uk-button uk-button-primary uk-button-large" value="Iniciar sesion" >
            </form>

            <?php $autenticar->autenticarUsuario(); ?>
        </section>
    </main>

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>
</body>
</html>