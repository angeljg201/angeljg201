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

        // Método para listar los productos
        public function ListarProducto() {
            $arr_prod = null;

            $cn = $this->Conectar();//this->metodo conectar

            $cad_sql = "";
            $cad_sql .= "select tb1.codigo_producto, tb1.producto, ";
            $cad_sql .= "tb1.stock_disponible, tb1.costo, tb1.ganancia, ";
            $cad_sql .= "tb2.marca, tb3.categoria ";
            $cad_sql .= "from tb_producto tb1 inner join tb_marca tb2 ";
            $cad_sql .= "on (tb1.producto_codigo_marca = tb2.codigo_marca) inner join tb_categoria tb3 ";
            $cad_sql .= "on (tb1.producto_codigo_categoria = tb3.codigo_categoria);";

            $sentencia = $cn->prepare($cad_sql);   // prepara
            $sentencia->execute();  //ejecuta

            echo "<table>";
            echo "<tr><th>Código</th><th>Producto</th><th>Stock</th><th>Ganancia</th><th>Marca</th><th>Categoría</th></tr>";

            while ($arr_prod = $sentencia->fetch(PDO::FETCH_ASSOC)) { //fetch->obtener productos y para arreglos
                echo "<tr>";
                echo "<td>".$arr_prod["codigo_producto"]."</td>";
                echo "<td>".$arr_prod["producto"]."</td>";
                echo "<td>".$arr_prod["stock_disponible"]."</td>";
                echo "<td>".$arr_prod["ganancia"]."</td>";
                echo "<td>".$arr_prod["marca"]."</td>";
                echo "<td>".$arr_prod["categoria"]."</td>";
                echo "</tr>";
            }

            echo "</table>";

            $cn = null;

        }
    }

    // Implementar la clase Conexion()
    $conexion = new Conexion();

    $cn = $conexion->ListarProducto();

