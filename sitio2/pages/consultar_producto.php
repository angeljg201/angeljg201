<!DOCTYPE html>
<html lang="es">
    <?php
        $titulo = "Consultar Producto";
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
                    <form name="frm_consultar_prod" id="frm_consultar_prod"  method="post">
                        <table>
                            <tr>
                                <td>Código a consultar</td>
                                <td><input type="text" name="txt_codprod" id="txt_codprod" maxlength="5" class="txt" /></td>
                            </tr>
                            <tr>
                                <td>Producto</td>
                                <td><input type="text" name="txt_prod" id="txt_prod"  readonly class="txt" /></td>
                            </tr>
                            <tr>
                                <td>Stock disponible</td>
                                <td><input type="text" name="txt_stk" id="txt_stk"  readonly class="txt" /></td>
                            </tr>
                            <tr>
                                <td>Costo</td>
                                <td><input type="text" name="txt_cst" id="txt_cst"  readonly class="txt" /></td>
                            </tr>
                            <tr>
                                <td>Ganancia</td>
                                <td><input type="text" name="txt_gnc" id="txt_gnc"  readonly class="txt" /></td>
                            </tr>
                            <tr>
                                <td>Marca</td>
                                <td><input type="text" name="txt_marca" id="txt_marca"  readonly class="txt" /></td>
                            </tr>
                            <tr>
                                <td>Categoría</td>
                                <td><input type="text" name="txt_categoria" id="txt_categoria"  readonly class="txt" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="centrar">
                                    <a href="consultar_producto.php" id ="btn_consultar" class ="btn3">Nueva Consulta </a>
                                </td>
                            </tr>
                        </table>

                    </form>
                </article>
            </section>
            <?php
                include("./includes/pie.php");
            ?>
        </div>
    </body>
</html>
