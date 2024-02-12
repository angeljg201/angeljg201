<?php
    // Página con la información
    // para conectar al BD bd_ia301
    $usuario = "root";
    $clave = "";
    $servidor = "localhost";
    $bd = "bd_ia301";
    
    // Controlador de excepciones
    try {
        // Conexión PDO (aplica POO) / Cadena de conexión a MySQL
        $con = new PDO("mysql:host=$servidor;dbname=$bd;", $usuario, $clave);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//metodo para establecer conexion PDO  set atrubuto 
        echo "Se conectó a la BD...";
    } catch (PDOException $e) {
        echo "Hubo un error: ".$e->getMessage();
    }

    $con = null;
