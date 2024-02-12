<?php
    if(isset($_POST["valor"])){

        $valor = $_POST["valor"];
        
        require("./class/crud_producto.php");

        $cp = new CrudProducto();

        $cp->FiltrarProducto($valor);

    }
?>