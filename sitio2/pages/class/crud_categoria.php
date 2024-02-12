<?php
    class CrudCategoria extends Conexion {

        public function getCategoria() {
            $arr_cat = null;

            $cn = $this->Conectar();

            $cad_sql = "";
            $cad_sql .= "select * ";
            $cad_sql .= "from tb_categoria ";
            $cad_sql .= "order by categoria asc;";

            $sentencia = $cn->prepare($cad_sql);
            $sentencia->execute();

            $arr_cat = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            $cn = null;

            return $arr_cat;
        }
    }