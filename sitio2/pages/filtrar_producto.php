<!DOCTYPE html>
<html lang="es">
    <?php
        $titulo = "Filtrar Productos";
        $ruta = "..";

        include("./includes/cabecera.php");
    ?>
    
    <body>
        <?php
        
        ?>
        <div>
            <?php
                include("./includes/menu.php");
            ?>
            <section>
                <article>
                    <form name = "frm_filtrar_prod" id = "frm_filtrar_prod" method = "post">
                        <table>
                            <tr>
                                <td>Producto</td>
                                <td><input type="txt" name="txt_valor" id="txt_valor" maxlength="40" class="txt" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" class= "centrar">
                                    <a href="#" id= "btn_filtrar"class="btn3">filtrar</a>
                                    <a href="filtrar_producto.php" id = "btn_nuevo" class="btn3">Nuevo</a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </article>
            </section>

            <!-- Sección que se actualiza desde el servidor con AJAX -->
            <section>
                <div id="tabla"></div>
            </section>
            <?php
                include("./includes/pie.php");
            ?>
        </div>
    </body>
</html>
