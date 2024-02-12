<?php
    if(isset($_GET["codprod"])){
        $codprod = $_GET["codprod"];
        
        require("./class/crud_producto.php");

        $cp = new CrudProducto();

        $cp->BorrarProducto($codprod);

        header("location: listar_producto.php");
    }
?>