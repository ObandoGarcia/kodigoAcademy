<?php
class Conexion{
    public function conectar(){
        try{
            $conexion = "mysql:host=localhost;dbname=sistema_kodigo_fsj19;charset=utf8";
            $opciones = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            $pdo = new PDO($conexion, "root", "", $opciones);
            return $pdo;
        }catch(PDOException $e){
            echo "Error de conexion: " . $e->getMessage();
            exit();
        }
    }
}