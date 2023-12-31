<?php
require "./clases/Conexion.php";

class Autenticacion extends Conexion{
    protected $correo;
    protected $password;

    public function autenticarUsuario(){
        if(isset($_POST['correo'], $_POST['contrasenia'])){
            $this->correo = $_POST['correo'];
            $this->password = $_POST['contrasenia'];

            $pdo = $this->conectar();
            //Administrador
            $query = $pdo->prepare("SELECT * FROM admin WHERE correo = ? AND password = ?");
            $query->execute(["$this->correo", "$this->password"]);
            $usuarioAdmin = $query->fetch(PDO::FETCH_ASSOC);

            //Estudiante
            $query2 = $pdo->prepare("SELECT id, nombre, correo, password, id_rol FROM estudiantes WHERE correo = ? AND password = ?");
            $query2->execute(["$this->correo", "$this->password"]);
            $usuario_estudiante = $query2->fetch(PDO::FETCH_ASSOC);

            //Coach
            $query3 = $pdo->prepare("SELECT id, nombre, correo, password, id_rol FROM coaches WHERE correo = ? AND password = ?");
            $query3->execute(["$this->correo","$this->password"]);
            $usuario_coach = $query3->fetch(PDO::FETCH_ASSOC);

            if(is_array($usuarioAdmin)){
                $_SESSION['nombre_admin'] = $usuarioAdmin['nombre'];
                $_SESSION['id_admin'] = $usuarioAdmin['id'];
                header("location: ./homeAdmin.php");
            }else if(is_array($usuario_estudiante)){
                $_SESSION['nombre_estudiante'] = $usuario_estudiante['nombre'];
                $_SESSION['id_estudiante'] = $usuario_estudiante['id'];
                header("location: ./homeEstudiante.php");
            }else if(is_array($usuario_coach)){
                $_SESSION['nombre_coach'] = $usuario_coach['nombre'];
                $_SESSION['id_coach'] = $usuario_coach['id'];
                header("location: ./homeCoach.php");
            }else{
                echo "<div class='uk-alert-danger' uk-alert>
                    <a href class='uk-alert-close' uk-close></a>
                    <p>Credenciales incorrectas!</p>
                </div>";
            }
        }
    }
}
