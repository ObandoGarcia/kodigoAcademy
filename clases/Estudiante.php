<?php
require "Conexion.php";

class Estudiante extends Conexion{
    protected $id;
    protected $nombre;
    protected $direccion;
    protected $telefono;
    protected $carnet;
    protected $correo;
    protected $password;
    protected $id_bootcamp;

    public function obtenerBootcamps(){
        $pdo = $this->conectar();
        $consulta = $pdo->query("SELECT * FROM bootcamps");
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function obtenerMaterias(){
        $pdo = $this->conectar();
        $consulta = $pdo->query("SELECT * FROM materias");
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function guardar(){
        if(isset($_POST['nombre'], $_POST['direccion'], $_POST['telefono'], $_POST['carnet'], $_POST['correo'], $_POST['bootcamp'], $_POST['materias'])){
            $this->nombre = $_POST['nombre'];
            $this->direccion = $_POST['direccion'];
            $this->telefono = $_POST['telefono'];
            $this->carnet = $_POST['carnet'];
            $this->correo = $_POST['correo'];
            $this->password = "Kodigo2023";
            $this->id_bootcamp = $_POST['bootcamp'];
            $estado = 1;
            $rol = 3;

            $pdo = $this->conectar();
            $query1 = $pdo->prepare("INSERT INTO estudiantes(nombre, direccion, telefono, carnet,correo, password, id_bootcamp, id_estado,id_rol) VALUES (?,?,?,?,?,?,?,?,?)");
            $resultado = $query1->execute(["$this->nombre","$this->direccion","$this->telefono","$this->carnet","$this->correo","$this->password","$this->id_bootcamp","$estado","$rol"]);

            if($resultado){
                $query2 = $pdo->query("SELECT id FROM estudiantes ORDER BY id DESC LIMIT 1");
                $query2->execute();
                $alumno = $query2->fetch(PDO::FETCH_ASSOC);
                $id_estudiante = $alumno['id'];

                $arreglo_materias = $_POST['materias'];
                for($i = 0; $i < count($arreglo_materias); $i++){
                    $query3 = $pdo->prepare("INSERT INTO detalle_estudiante_materia(id_estudiante, id_materia) VALUES (?,?)");
                    $query3->execute([$id_estudiante, $arreglo_materias[$i]]);
                }

                echo "<script>
                    window.location = './estudiantesActivos.php'
                </script>";
            }
        }
    }

    public function obtenerEstudiantes(){
        $pdo = $this->conectar();
        $query = $pdo->query("SELECT estudiantes.id, estudiantes.nombre, estudiantes.carnet, estudiantes.correo, bootcamps.bootcamp, estado.estado FROM estudiantes INNER JOIN bootcamps ON estudiantes.id_bootcamp = bootcamps.id INNER JOIN estado ON estudiantes.id_estado = estado.id WHERE estado.estado != 'desercion'");
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function obtenerPorId(){
        if(isset($_POST['id_estudiante'])){
           $this->id = $_POST['id_estudiante'];
           
           $pdo = $this->conectar();
           $query = $pdo->query("SELECT id, nombre, direccion, telefono, correo FROM estudiantes WHERE id = $this->id");
           $query->execute();
           $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
           return $resultado;
        }
    }

    public function actualizar(){
        if(isset($_POST['id_estudiante'], $_POST['nombre'], $_POST['direccion'], $_POST['telefono'], $_POST['correo'])){
            $this->nombre = $_POST['nombre'];
            $this->direccion = $_POST['direccion'];
            $this->telefono = $_POST['telefono'];
            $this->correo = $_POST['correo'];
            $this->id = $_POST['id_estudiante'];

            $pdo = $this->conectar();
            $query = $pdo->prepare("UPDATE estudiantes SET nombre = ?, direccion = ?, telefono = ?, correo = ? WHERE id = ?");
            $resultado = $query->execute(["$this->nombre", "$this->direccion", "$this->telefono", "$this->correo", "$this->id"]);

            if($resultado){
                echo "<script>
                    window.location = './estudiantesActivos.php';                   
                </script>";    
            }else{
                echo "<div class='uk-alert-warning' uk-alert>
                    <a href class='uk-alert-close' uk-close></a>
                    <p>Error al actualizar el estudiante!.</p>
                </div>";
            }
        }
    }

    public function estadoPorAsincronoActivoDesersion(){
        $pdo = $this->conectar();
        $query = $pdo->query("SELECT * FROM estado WHERE  id = 2 OR id = 4 OR id = 1");
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function actualizarEstado(){
        if(isset($_POST['id_estudiante'], $_POST['estado'])){
            $this->id = $_POST['id_estudiante'];
            $estado = $_POST['estado'];

            $pdo = $this->conectar();
            $query = $pdo->prepare("UPDATE estudiantes SET id_estado = ? WHERE id = ?");
            $resultado = $query->execute([$estado, $this->id]);

            if($resultado){
                echo "<script>
                window.location = './estudiantesActivos.php'
                </script>";
            }else{
                echo "<div class='uk-alert-warning' uk-alert>
                    <a href class='uk-alert-close' uk-close></a>
                    <p>Error al cambiar estado del estudiante!.</p>
                </div>";
            }
        }
    }

    public function actualizarReubicacion(){
        if(isset($_POST['id_estudiante'], $_POST['bootcamp'])){
            $this->id = $_POST['id_estudiante'];
            $estado = 3;
            $this->id_bootcamp = $_POST['bootcamp'];

            $pdo = $this->conectar();
            $query = $pdo->prepare("UPDATE estudiantes SET id_estado = ?, id_bootcamp = ? WHERE id = ? ");
            $resultado = $query->execute([$estado, $this->id_bootcamp, $this->id]);

            if($resultado){
                echo "<script>
                    window.location = './estudiantesActivos.php'
                    </script>";
            }else{
                echo "Error al reubicar el estudiante";
            }
        }
    }

    public function verPerfil(){
        $id = $_SESSION['id_estudiante'];
        $pdo = $this->conectar();
        $query = $pdo->query("SELECT estudiantes.nombre, estudiantes.carnet, estudiantes.direccion, estudiantes.telefono, estudiantes.correo, bootcamps.bootcamp FROM estudiantes INNER JOIN bootcamps ON estudiantes.id_bootcamp = bootcamps.id WHERE estudiantes.id = $id");
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC); //[]
        return $resultado;
    }
}