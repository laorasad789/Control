<?php

namespace ProyPhotoBundle\Funciones;

use ProyPhotoBundle\Model\Model;

class BitacoraFunciones{

    public function InsertaBitacora($idUsr, $accion, $detalle){
        $conn = new Model();
        $sql = "insert into bitacora (idUsr, FechCreacion, AccionBit, DetalleBit) values ($idUsr, now(), '$accion', '$detalle');";
      //  print_r($sql);
        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }

    public function GetBitacoraxnombre($nombre){
        $conn = new Model();
        $sql  = "select * from bitacora A inner join usuario B on (A.idUsr = B.idUsr) where B.NomUsr like '%$nombre%';";
        $result = $conn->consulta($sql);
        $bitacora = array();
        while($row = $conn->fetch_assoc($result)){
            $bitacora[] = $row;
        }
        //print_r($clasificaciones);
        $conn->close();
        return $bitacora;
    }

    public function GetBitacora(){
        $conn = new Model();
        $sql  = "select * from bitacora A inner join usuario B on (A.idUsr = B.idUsr);";
        $result = $conn->consulta($sql);
        $bitacora = array();
        while($row = $conn->fetch_assoc($result)){
            $bitacora[] = $row;
        }
        //print_r($clasificaciones);
        $conn->close();
        return $bitacora;
    }

}