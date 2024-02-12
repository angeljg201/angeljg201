<?php
    // print_r($_POST);
    // Verificar que se ha enviado los datos del formulario
    // usando el botón Grabar Producto
    if (isset($_POST["btn_grabar"])) {
        require("./class/crud_producto.php");
        require("./class/producto.php");

        $cp = new CrudProducto();
        $producto = new Producto();

        $producto->codigo_producto = $_POST["txt_codprod"];
        $producto->producto = $_POST["txt_prod"];
        $producto->stock_disponible = $_POST["txt_stk"];
        $producto->costo = $_POST["txt_cst"];
        $producto->ganancia = $_POST["txt_gnc"];
        $producto->producto_codigo_marca = $_POST["cbo_codmar"];
        $producto->producto_codigo_categoria = $_POST["cbo_codcat"];

        $accion = $_POST["txt_accion"];

        if ($accion == "r") {
            $cp->RegistrarProducto($producto);
        } else if ($accion == "e") {
            $cp->EditarProducto($producto);
        }

        header("location: listar_producto.php");
    }