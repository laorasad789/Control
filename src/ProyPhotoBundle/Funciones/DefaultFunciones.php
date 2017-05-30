<?php

namespace ProyPhotoBundle\Funciones;

use ProyPhotoBundle\Model\Model;

class DefaultFunciones {
    
    public function validausr($usuario, $pass){
        $conn = new Model();
        //$pwdEnc=md5($pass);
     //   print_r($pass);
        $sql = "select idUsr, NomUsr, TipoUsr from usuario where NicknameUsr = '$usuario' and PassUsr = '$pass' and VisibleUsr = 1; ";
       // print_r($sql);
        //die($sql);
        $result = $conn->consulta($sql);
        $row = $conn->fetch_assoc($result);
        $conn->close();
        return $row;
    }

    public function Registrarusuario($nomusr,$password, $nombre, $tel, $email, $facebook){
        $conn = new Model();
       // $pwdEnc=md5($password);
        $sql = "insert into usuario (NicknameUsr, PassUsr, NomUsr, TelUsr, EmailUsr, FbUsr, VisibleUsr) values ('$nomusr','$password','$nombre','$tel','$email','$facebook',1);";
        $result = $conn->consulta($sql);
        $conn->close();
        return $result;
    }
    
}