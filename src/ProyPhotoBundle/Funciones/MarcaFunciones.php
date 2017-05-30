<?php

namespace ProyPhotoBundle\Funciones;

use ProyPhotoBundle\Model\Model;

class MarcaFunciones{

    public function AgregaMarca($nombremarca, $idUsr){
        $conn = new Model();
        $sql = "Insert into marca (NomMarca, MarcaUsr_crea, MarcaFech_crea, Visible) values ('$nombremarca', $idUsr, now(), 1);";
        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }

    public function ModificarMarca($nombremarca, $idmarca){
        $conn = new Model();
        $sql = "Update marca set NomMarca = '$nombremarca' where idMarca = $idmarca;";
      //  print_r($sql);
        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }

    public function GetMarcas(){
        $conn = new Model();
        $sql  = "Select * from marca ORDER BY NomMarca;";
        $result = $conn->consulta($sql);
        $marcas = array();
        while($row = $conn->fetch_assoc($result)){
            $marcas[] = $row;
        }
        print_r($marcas);
        $conn->close();
        return $marcas;
    }

    public function GetMarcasactivas(){
        $conn = new Model();
        $sql  = "Select * from marca where Visible = 1 ORDER BY NomMarca;";
        $result = $conn->consulta($sql);
        $marcas = array();
        while($row = $conn->fetch_assoc($result)){
            $marcas[] = $row;
        }
        //print_r($clasificaciones);
        $conn->close();
        return $marcas;
    }

    public function ActDesMarca($idmarca, $activo){
        $conn = new Model();
        $sql = "Update marca set Visible = $activo where idMarca = $idmarca;";
        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }

}