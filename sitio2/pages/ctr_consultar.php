<?php
    if(isset($_POST["codprod"])){

        $codprod = $_POST["codprod"];
        
        require("./class/crud_producto.php");

        $cp = new CrudProducto();

        $cp->ConsultarProductoPorCodigo($codprod);

    }
?>