<?php
    class CrudMarca extends Conexion {

        public function getMarca() {
            $arr_marca = null;

            $cn = $this->Conectar();

            $cad_sql = "";
            $cad_sql .= "select * ";
            $cad_sql .= "from tb_marca ";
            $cad_sql .= "order by marca asc;";

            $sentencia = $cn->prepare($cad_sql);
            $sentencia->execute();

            $arr_marca = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            $cn = null;

            return $arr_marca;
        }
    }