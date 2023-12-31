
<?php
    function cerrarSesion(){
        if(isset($_POST['cerrarSesion'])){
            session_destroy();
            header("location: ./index.php");
        }
    }
?>

<header>
    <nav class="uk-navbar-container">
        <div class="uk-container">
            <div uk-navbar>
                <div class="uk-navbar-left">
                    <ul class="uk-navbar-nav">
                        <li class="uk-active"> 
                            <a class="uk-icon-link uk-margin-small-right" uk-icon="home"  href="./homeAdmin.php"></a>  
                        </li>
                        <li>
                            <a class="uk-icon-link uk-margin-small-right" uk-icon="users" href="./estudiantesActivos.php">Estudiantes</a>
                        </li>
                        <li>
                            <a class="uk-icon-link uk-margin-small-right" uk-icon="user" href="./coachActivos.php">Profesores</a>
                        </li>
                    </ul>
                </div>
                <div class="uk-navbar-right">
                    <h3><?php echo $_SESSION['nombre_admin']; ?></h3>
                    <form action="" method="POST">
                        <button name="cerrarSesion" type="submit" class="uk-icon-link" uk-icon="icon: sign-out; ratio: 2" uk-tooltip="Cerrar sesion"></button>
                    </form>
                    <?php cerrarSesion(); ?>
                </div>
            </div>
        </div>
    </nav>
</header>