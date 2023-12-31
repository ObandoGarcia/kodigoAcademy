<?php 
require "Conexion.php";

class Coach extends Conexion{
    protected $id;
    protected $nombre;
    protected $direccion;
    protected $titulo;
    protected $correo;
    protected $password;
    protected $id_materia;

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
        if(isset($_POST['nombre'], $_POST['direccion'], $_POST['titulo'], $_POST['correo'], $_POST['bootcamps'], $_POST['materia'])){
            $this->nombre = $_POST['nombre'];
            $this->direccion = $_POST['direccion'];
            $this->titulo = $_POST['titulo'];
            $this->correo = $_POST['correo'];
            $this->password = "Kodigo2023";
            $this->id_materia = $_POST['materia'];   
            $estado = 1;
            $rol = 2;

            $pdo = $this->conectar();
            $query = $pdo->prepare("INSERT INTO coaches(nombre, direccion, titulo, correo, password, id_materia, id_estado, id_rol) VALUES (?,?,?,?,?,?,?,?)");
            $resultado = $query->execute(["$this->nombre","$this->direccion","$this->titulo","$this->correo","$this->password","$this->id_materia","$estado","$rol"]);

            if($resultado){
                $query2 = $pdo->query("SELECT id FROM coaches ORDER BY id DESC LIMIT 1");
                $query2->execute();
                $coach = $query2->fetch(PDO::FETCH_ASSOC);
                $id_coach = $coach['id'];

                $arreglo_bootcamps = $_POST['bootcamps'];
                for($i = 0; $i < count($arreglo_bootcamps); $i++){
                    $query3 = $pdo->prepare("INSERT INTO detalle_bootcamp_coach(id_coach, id_bootcamp) VALUES(?,?)");
                    $query3->execute([$id_coach, $arreglo_bootcamps[$i]]);
                }

                echo "<script>
                    window.location = './coachActivos.php'
                </script>";
            }
        }
    }

    public function obtenerCoach(){
        $pdo = $this->conectar();
        $query = $pdo->query("SELECT coaches.id, coaches.nombre, coaches.direccion, coaches.titulo, materias.materia, estado.estado FROM coaches INNER JOIN materias ON coaches.id_materia = materias.id INNER JOIN estado ON coaches.id_estado = estado.id WHERE estado.estado = 'activo'");
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function obtenerPorId(){
        if(isset($_POST['id_coach'])){
            $this->id = $_POST['id_coach'];

            $pdo = $this->conectar();
            $query = $pdo->query("SELECT id, nombre, direccion, titulo, correo FROM coaches WHERE id= $this->id");
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }
    }

    public function actualizar(){
        if(isset($_POST['id_coach'], $_POST['nombre'], $_POST['direccion'], $_POST['titulo'], $_POST['correo'])){
            $this->nombre = $_POST['nombre'];
            $this->direccion = $_POST['direccion'];
            $this->titulo = $_POST['titulo'];
            $this->correo = $_POST['correo'];
            $this->id = $_POST['id_coach'];

            $pdo = $this->conectar();
            $query = $pdo->prepare("UPDATE coaches SET nombre = ?, direccion = ?, titulo = ?, correo = ? WHERE id = ?");
            $resultado = $query->execute(["$this->nombre","$this->direccion","$this->titulo","$this->correo","$this->id"]);

            if($resultado){
                echo "<script>
                    window.location = './coachActivos.php';                   
                </script>";    
            }else{
                echo "<div class='uk-alert-warning' uk-alert>
                    <a href class='uk-alert-close' uk-close></a>
                    <p>Error al actualizar el coach!.</p>
                </div>";
            }
        }
    }

    public function obtenerEstadoInactivo(){
        $pdo = $this->conectar();
        $query = $pdo->query("SELECT * FROM estado WHERE id = 5");
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function actualizarEstado(){
        if(isset($_POST['id_coach'], $_POST['estado'])){
            $this->id = $_POST['id_coach'];
            $estado = $_POST['estado'];

            $pdo = $this->conectar();
            $query = $pdo->prepare("UPDATE coaches SET id_estado = ? WHERE id = ?");
            $resultado = $query->execute([$estado, $this->id]);

            if($resultado){
                echo "<script>
                window.location = './estudiantesActivos.php'
                </script>";
            }else{
                echo "<div class='uk-alert-warning' uk-alert>
                    <a href class='uk-alert-close' uk-close></a>
                    <p>Error al cambiar estado del coach!</p>
                </div>";
            }

        }
    }

    public function verPerfilCoach(){
        $id = $_SESSION['id_coach'];
        $pdo = $this->conectar();
        $query = $pdo->query("SELECT coaches.nombre, coaches.direccion, coaches.titulo, coaches.correo, materias.materia FROM coaches INNER JOIN materias ON coaches.id_materia = materias.id WHERE coaches.id = $id");
        $query->execute();
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }


}