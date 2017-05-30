<?php

namespace ProyPhotoBundle\Funciones;

use ProyPhotoBundle\Model\Model;

class ClasificacionFunciones{

    public function AgregaClasificacion($nombreclasificacion, $idUsr){
        $conn = new Model();
        $sql = "Insert into clasificacion (NomClasif, ClasifAdm_crea, ClasifFech_crea, Visible) values ('$nombreclasificacion', $idUsr, now(), 1);";
        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }

    public function ModificarClasificacion($nombreclasificacion, $idclasificacion){
        $conn = new Model();
        $sql = "Update clasificacion set NomClasif = '$nombreclasificacion' where idClasif = $idclasificacion;";
      //  print_r($sql);
        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }

    public function GetClasificaciones(){
        $conn = new Model();
        $sql  = "Select * from clasificacion ORDER BY NomClasif;";
        $result = $conn->consulta($sql);
        $clasificaciones = array();
        while($row = $conn->fetch_assoc($result)){
            $clasificaciones[] = $row;
        }
        print_r($clasificaciones);
        $conn->close();
        return $clasificaciones;
    }

    public function GetClasificacionesactivas(){
        $conn = new Model();
        $sql  = "Select * from clasificacion where Visible = 1 ORDER BY NomClasif;";
        $result = $conn->consulta($sql);
        $clasificaciones = array();
        while($row = $conn->fetch_assoc($result)){
            $clasificaciones[] = $row;
        }
        //print_r($clasificaciones);
        $conn->close();
        return $clasificaciones;
    }

    public function ActDesClasificacion($idcategoria, $activo){
        $conn = new Model();
        $sql = "Update clasificacion set Visible = $activo where idClasif = $idcategoria;";
        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }

}