<!DOCTYPE html>
<html lang="es">
    <?php
        $titulo = "Desarrollo de Aplicaciones Web II";
        $ruta = ".";

        include("./pages/includes/cabecera.php");
    ?>
    
    <body>
        <div>
            <?php
                include("./pages/includes/menu.php");
            ?>
            <section>
                <article>
                <?php
                    for($i = 1; $i <= 5; $i++) {
                ?>
                    <img src="images/cuzco<?=$i?>.jpg" alt="" />
                <?php
                    }
                ?>
                </article>
            </section>
            <?php
                include("./pages/includes/pie.php");
            ?>
        </div>
    </body>
</html>
