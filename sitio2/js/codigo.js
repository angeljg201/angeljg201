// Código para la aplicación del sitio2
// Método inicial

$(function() {
    // $("selector")
    // $("etiqueta")         --> $("body")
    // $(".clase")           --> $(".centrar")
    // $("#nombreID")        --> $("#frm_registrar_prod")
    // $("etiqueta .clase")  --> $("body .centrar")

    // Evento click de la clase btn1 (Botón Editar)
    $(".btn1").click(function(e) {
        let codprod = $(this).closest("tr").children(".codprod").text();
        
        location.href = "editar_producto.php?codprod=" + codprod;
    });
     // Evento click de la clase btn2 (Botón Borrar)
    $(".btn2").click(function(e) {
        let codprod = $(this).closest("tr").children(".codprod").text();
        let prod = $(this).closest("tr").children(".prod").text();
        let mensaje = "";
        mensaje += "¿Seguro de borrar el producto?";
        mensaje += "Código: "+codprod+"(" + prod + ")";

        if(confirm(mensaje)){
            location.href = "ctr_borrar.php?codprod=" + codprod;
        }
    });
     // Evento click del id btn_filtrar de la pagina filtrar_producto.php
    $("#frm_filtrar_prod #btn_filtrar").on("click", function(e){
        let valor = $("#txt_valor").val();
        
        if(valor!=""){
            // AJAX: Javascript Asíncrono + XML
            $.post("ctr_filtrar.php",
            {valor: valor},
            function(resultado){
                $("#tabla").html(resultado);
                }
            );
            
        }
        }
    );

    //Evento focusout del txt_codprod del frm_consultar_producto.php
    $("#frm_consultar_prod #txt_codprod").focusout(function(e){
        let codprod = $(this).val();

        if(codprod != ""){
            $.ajax({
                url: "ctr_consultar.php",
                type: "post",
                data:{codprod: codprod},
                success: function(resultado){
                    let rp = JSON.parse(resultado);

                    if(rp.datos["error"]){
                        alert("El codigo "+codprod+"no existe");
                    }else{
                        $("#txt_prod").val(rp.datos[0].producto);
                        $("#txt_stk").val(rp.datos[0].stock_disponible);
                        $("#txt_cst").val(rp.datos[0].costo);
                        $("#txt_gnc").val(rp.datos[0].ganancia);
                        $("#txt_marca").val(rp.datos[0].marca);
                        $("#txt_categoria").val(rp.datos[0].categoria);
                    }
                } 
            });
        }
    });

});