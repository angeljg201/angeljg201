<!DOCTYPE html>
<html lang="es">
    <?php
        $titulo = "Registrar Producto";
        $ruta = "..";

        include("./includes/cabecera.php");
    ?>
    <body>
        <?php
            require("./class/crud_producto.php");
            require("./class/crud_marca.php");
            require("./class/crud_categoria.php");

            $cp = new CrudProducto();
            $cm = new CrudMarca();
            $cc = new CrudCategoria();

            $rs_mar = $cm->getMarca();
            $rs_cat = $cc->getCategoria();
        ?>
        <div>
            <?php
                include("./includes/menu.php");
            ?>
            <section>
                <div class="centrar">
                    <a href="listar_producto.php" class="btn3">Regresar</a>
                </div>
                <article>
                    <form name="frm_registrar_prod" id="frm_registrar_prod" action="ctr_grabar.php" method="post">
                        <input type="hidden" name="txt_accion" id="txt_accion" value="r" />
                        
                    </form>
                </article>
            </section>
            <?php
                include("./includes/pie.php");
            ?>
        </div>
    </body>
</html>
