<!DOCTYPE html>
<html lang="es">
    <?php
        $titulo = "Lista de Productos";
        $ruta = "..";

        include("./includes/cabecera.php");
    ?>
    
    <body>
        <?php
            require("./class/crud_producto.php");
            $cp = new CrudProducto();
        ?>
        <div>
            <?php
                include("./includes/menu.php");
            ?>
            <section>
                <div class="centrar">
                    <a href="registrar_producto.php" class="btn3">Registrar Producto</a>
                </div>
                <article>
                    <?php
                        $cp->ListarProducto();
                    ?>
                </article>
            </section>
            <?php
                include("./includes/pie.php");
            ?>
        </div>
    </body>
</html>
