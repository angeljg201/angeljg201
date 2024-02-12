<?php
    require("conexion.php");

    class CrudProducto extends Conexion {

        // Listar productos
        public function ListarProducto() {
            $arr_prod = null;

            $cn = $this->Conectar();

            $cad_sql = "";
            $cad_sql .= "select * ";
            $cad_sql .= "from tb_producto ";
            $cad_sql .= "order by producto asc;";

            $sentencia = $cn->prepare($cad_sql);
            $sentencia->execute();

            echo "<table>";
            echo "<tr><th>Código</th><th>Producto</th><th>Stock</th><th colspan='2'>Acción</th></tr>";

            while ($arr_prod = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td class='codprod'>".$arr_prod["codigo_producto"]."</td>";
                echo "<td class='prod'>".$arr_prod["producto"]."</td>";
                echo "<td>".$arr_prod["stock_disponible"]."</td>";
                echo "<td><a href='#' class='btn1'>Editar</a></td>";
                echo "<td><a href='#' class='btn2'>Borrar</a></td>";
                echo "</tr>";
            }

            echo "</table>";

            $cn = null;
        }
        public function BuscarProductoPorCodigo($codprod) {
            $prod = null;

            $cn = $this->Conectar();

            $cad_sql = "";
            $cad_sql .= "select * ";
            $cad_sql .= "from tb_producto ";
            $cad_sql .= "where codigo_producto = :codprod;";

            $snt = $cn->prepare($cad_sql);

            $snt->bindParam(":codprod", $codprod, PDO::PARAM_STR, 4);

            $snt->execute();

            $prod = $snt->fetch(PDO::FETCH_ASSOC);

            $cn = null;

            return $prod;
        }
        // Buscar producto por código
        public function FiltrarProducto($valor) {
            $cn = $this->Conectar();
            $valor = $valor . "%";
            
            $cad_sql = "SELECT tb1.codigo_producto, tb1.producto,
               tb1.stock_disponible, tb1.costo,
               CONCAT(tb1.ganancia * 100, '%') AS ganancia,
               (tb1.costo + tb1.costo * tb1.ganancia) AS precio,
               tb2.marca, tb3.categoria
            FROM tb_producto tb1
            INNER JOIN tb_marca tb2 ON (tb1.producto_codigo_marca = tb2.codigo_marca)
            INNER JOIN tb_categoria tb3 ON (tb1.producto_codigo_categoria = tb3.codigo_categoria)
            WHERE tb1.producto LIKE :valor
            ORDER BY tb1.producto ASC;";
            
            $snt = $cn->prepare($cad_sql);
            $snt->bindParam(":valor", $valor, PDO::PARAM_STR, 40);
            $snt->execute();
            
            $num_reg = $snt->rowCount();
            
            if ($num_reg > 0) {
                echo "<table>";
                echo "<tr><th>Código</th><th>Producto</th><th>Stock</th><th>Costo</th><th>Ganancia</th><th>Precio</th><th>Marca</th><th>Categoria</th></tr>";
        
                while ($arr_prod = $snt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>".$arr_prod["codigo_producto"]."</td>";
                    echo "<td>".$arr_prod["producto"]."</td>";
                    echo "<td>".$arr_prod["stock_disponible"]."</td>";
                    echo "<td>".$arr_prod["costo"]."</td>";
                    echo "<td>".$arr_prod["ganancia"]."</td>";
                    echo "<td>".$arr_prod["precio"]."</td>";
                    echo "<td>".$arr_prod["marca"]."</td>";
                    echo "<td>".$arr_prod["categoria"]."</td>";
                    echo "</tr>";
                }
        
                echo "</table>";
        
                $cn = null;
            } else {
                echo "<table><tr><td>No se encontraron registros... </td></tr></table>";
            }
        } 
        // Consultar producto por código (usando Json)
        public function ConsultarProductoPorCodigo($codprod) {
            $prod = null;

            $cn = $this->Conectar();

            $cad_sql = "";
            $cad_sql .= "select tb1.codigo_producto, tb1.producto,
            tb1.stock_disponible, tb1.costo, tb1.ganancia,
            tb2.marca, tb3.categoria
            from tb_producto tb1
            inner join tb_marca tb2 ON (tb1.producto_codigo_marca = tb2.codigo_marca)
            inner join tb_categoria tb3 ON (tb1.producto_codigo_categoria = tb3.codigo_categoria)   
            union  
            select tb1.codigo_producto, tb1.producto,
            tb1.stock_disponible, tb1.costo, tb1.ganancia,
            NULL AS marca, NULL AS categoria
            FROM tb_producto tb1
            WHERE tb1.codigo_producto = :codprod;";

            $snt = $cn->prepare($cad_sql);

            $snt->bindParam(":codprod", $codprod, PDO::PARAM_STR, 4);

            $snt->execute();

            $num_reg = $snt->rowCount();

            if ($num_reg > 0) {
                $prod["datos"][] = $snt->fetch(PDO::FETCH_ASSOC);
            } else {
                $prod["datos"]["error"] = "No hay datos";
            }
            

            $cn = null;

            echo json_encode($prod, JSON_FORCE_OBJECT);
        }       
        // Registrar Producto
        public function RegistrarProducto(Producto $producto) {
            try {
                $cn = $this->Conectar();

                $cad_sql = "";
                $cad_sql .= "insert into tb_producto ";
                $cad_sql .= "values (:codprod, :prod, :stk, :cst, :gnc, :codmar, :codcat);";

                $snt = $cn->prepare($cad_sql);

                // Agregar los valores a cada parámetro
                $snt->bindParam(":codprod", $producto->codigo_producto, PDO::PARAM_STR, 5);
                $snt->bindParam(":prod", $producto->producto, PDO::PARAM_STR, 40);
                $snt->bindParam(":stk", $producto->stock_disponible, PDO::PARAM_INT);
                $snt->bindParam(":cst", $producto->costo, PDO::PARAM_STR);
                $snt->bindParam(":gnc", $producto->ganancia, PDO::PARAM_STR);
                $snt->bindParam(":codmar", $producto->producto_codigo_marca, PDO::PARAM_STR, 5);
                $snt->bindParam(":codcat", $producto->producto_codigo_categoria, PDO::PARAM_STR, 5);

                $snt->execute();

                $cn = null;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        // Editar Producto
        public function EditarProducto(Producto $producto) {
            try {
                $cn = $this->Conectar();

                $cad_sql = "";
                $cad_sql .= "update tb_producto ";
                $cad_sql .= "set producto = :prod, stock_disponible = :stk, ";
                $cad_sql .= "costo = :cst, ganancia = :gnc, ";
                $cad_sql .= "producto_codigo_marca = :codmar, producto_codigo_categoria = :codcat ";
                $cad_sql .= "where codigo_producto = :codprod;";

                $snt = $cn->prepare($cad_sql);

                // Agregar los valores a cada parámetro
                $snt->bindParam(":codprod", $producto->codigo_producto, PDO::PARAM_STR, 5);
                $snt->bindParam(":prod", $producto->producto, PDO::PARAM_STR, 40);
                $snt->bindParam(":stk", $producto->stock_disponible, PDO::PARAM_INT);
                $snt->bindParam(":cst", $producto->costo, PDO::PARAM_STR);
                $snt->bindParam(":gnc", $producto->ganancia, PDO::PARAM_STR);
                $snt->bindParam(":codmar", $producto->producto_codigo_marca, PDO::PARAM_STR, 5);
                $snt->bindParam(":codcat", $producto->producto_codigo_categoria, PDO::PARAM_STR, 5);

                $snt->execute();

                $cn = null;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        // Borrar Producto
        public function BorrarProducto($codprod) {
            try {
                $cn = $this->Conectar();

                $cad_sql = "";
                $cad_sql .= "delete from tb_producto ";
                $cad_sql .= "where codigo_producto = :codprod;";

                $snt = $cn->prepare($cad_sql);

                // Agregar los valores a cada parámetro
                $snt->bindParam(":codprod", $codprod, PDO::PARAM_STR, 5);

                $snt->execute();

                $cn = null;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }


    }