<?php

namespace ITRBundle\Funciones;

use ITRBundle\Model\Model;

class ProductosFunciones{

    public function AgregaProducto($codigobarras, $nombrecategoria, $nombreproducto, $Usuarios_id){
        $conn = new Model();
        $sql = "Insert into producto (producto_codigobarras, producto_nombre, Categoria_id, producto_usrcrea, producto_fchcrea, activo) values ('$codigobarras', '$nombreproducto', $nombrecategoria, $Usuarios_id, now(), 1);";
        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }

    public function ModificarProducto($codigobarras, $nombreproducto, $nombrecategoria, $idproducto){
        $conn = new Model();
        $sql = "Update producto set Categoria_id = $nombrecategoria, Producto_codigobarras = '$codigobarras', Producto_nombre = '$nombreproducto' where Producto_id = $idproducto;";
        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }

    public function GetProductos(){
        $conn = new Model();
        $sql  = "select B.Categoria_nombre, A.Producto_id, A.Producto_codigobarras, A.Producto_nombre, A.activo from itr.producto A inner join itr.categoria B on (A.Categoria_id = B.Categoria_id) ORDER BY A.Producto_nombre;";
        $result = $conn->consulta($sql);
        $productos = array();
        while($row = $conn->fetch_assoc($result)){
            $productos[] = $row;
        }
        //print_r($clasificaciones);
        $conn->close();
        return $productos;
    }

    public function ActDesProducto($idproducto, $activo){
        $conn = new Model();
        $sql = "Update producto set activo = $activo where Producto_id = $idproducto;";
        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }
    
}