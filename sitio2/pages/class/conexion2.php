<?php
    // Clase para la conexión
    class Conexion {
        // Atributos para conectar a la BD bd_ia301
        private $usuario = "root";
        private $clave = "";
        private $servidor = "localhost";
        private $bd = "bd_ia301";

        public function Conectar() {
            // Controlador de excepciones
            try {
                // Conexión PDO (aplica POO) / Cadena de conexión a MySQL
                $con = new PDO("mysql:host=$this->servidor;dbname=$this->bd;", $this->usuario, $this->clave);
                $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $con;
            } catch (PDOException $e) {
                echo "Hubo un error: ".$e->getMessage();
            }
        }
    }

    // Implementar la clase Conexion()
    $conexion = new Conexion();

    $cn = $conexion->Conectar();

    if ($cn)
        echo "Conexión exitosa...";
    
    $cn = null;
    
    
    
