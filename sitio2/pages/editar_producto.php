<!DOCTYPE html>
<html lang="es">
    <?php
        $titulo = "Editar Producto";
        $ruta = "..";

        include("./includes/cabecera.php");
    ?>
    <body>
        <?php
            if (isset($_GET["codprod"])) {
                $codprod = $_GET["codprod"];

                require("./class/crud_producto.php");
                $cp = new CrudProducto();

                $rs_prod = $cp->BuscarProductoPorCodigo($codprod);

                if (!empty($rs_prod)) {
                    require("./class/crud_marca.php");
                    require("./class/crud_categoria.php");
                    
                    $cm = new CrudMarca();
                    $cc = new CrudCategoria();

                    $rs_mar = $cm->getMarca();
                    $rs_cat = $cc->getCategoria();
                } else {
                    header("location: listar_producto.php");
                }
            } else {
                header("location: listar_producto.php");
            }
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
                    <form name="frm_editar_prod" id="frm_editar_prod" action="ctr_grabar.php" method="post">
                        <input type="hidden" name="txt_accion" id="txt_accion" value="e" />
                        <table>
                            <tr>
                                <td>Código</td>
                                <td><input type="text" name="txt_codprod" id="txt_codprod" maxlength="5" class="txt" readonly value="<?=$rs_prod["codigo_producto"]?>" /></td>
                            </tr>
                            <tr>
                                <td>Producto</td>
                                <td><input type="text" name="txt_prod" id="txt_prod" maxlength="40" class="txt" value="<?=$rs_prod["producto"]?>" /></td>
                            </tr>
                            <tr>
                                <td>Stock disponible</td>
                                <td><input type="number" name="txt_stk" id="txt_stk" min="1" max="200" class="txt" value="<?=$rs_prod["stock_disponible"]?>" /></td>
                            </tr>
                            <tr>
                                <td>Costo</td>
                                <td><input type="text" name="txt_cst" id="txt_cst" maxlength="8" class="txt" value="<?=$rs_prod["costo"]?>" /></td>
                            </tr>
                            <tr>
                                <td>Ganancia</td>
                                <td><input type="text" name="txt_gnc" id="txt_gnc" maxlength="8" class="txt" value="<?=$rs_prod["ganancia"]?>" /></td>
                            </tr>
                            <tr>
                                <td>Marca</td>
                                <td>
                                    <select name="cbo_codmar" id="cbo_cod_mar" class="cbo">
                                        <option value="">Seleccione marca</option>
                                        <?php
                                            foreach($rs_mar as $marca) {
                                        ?>
                                        <option value="<?=$marca["codigo_marca"]?>"><?=$marca["marca"]?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Categoría</td>
                                <td>
                                    <select name="cbo_codcat" id="cbo_cod_cat" class="cbo">
                                        <option value="">Seleccione categoría</option>
                                        <?php
                                            foreach($rs_cat as $categoria) {
                                        ?>
                                        <option value="<?=$categoria["codigo_categoria"]?>"><?=$categoria["categoria"]?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="centrar">
                                    <button type="submit" name="btn_grabar" id="btn_grabar" class="btn3">GRABAR CAMBIOS</button>
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
