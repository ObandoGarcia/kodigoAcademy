
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
                            <a href="./homeCoach.php">Home</a>  
                        </li>
                    </ul>
                </div>
                <div class="uk-navbar-right">
                    <h3><?php echo $_SESSION['nombre_coach']; ?></h3>
                    <form action="" method="POST">
                        <button name="cerrarSesion" type="submit" class="uk-icon-link" uk-icon="icon: sign-out; ratio: 2" uk-tooltip="Cerrar sesion"></button>
                    </form>
                    <?php cerrarSesion(); ?>
                </div>
            </div>
        </div>
    </nav>
</header>