<?php

namespace ProyPhotoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ProyPhotoBundle\Funciones\ClasificacionFunciones;
use Symfony\Component\HttpFoundation\Response;
use ProyPhotoBundle\Funciones\BitacoraFunciones;

class ClasificacionController extends Controller{
    
    /**
     * @Route("/Clasificacion", name="Clasificacion")
     */
    public function ClasificacionAction(){
        return $this->render('ProyPhotoBundle:Clasificacion:Clasificacion.html.twig');
    }
    
    /**
     * @Route("/OperacionesSQL", name="OperacionesSQL")
     * @Method({"POST"})
     */
    public function OperacionesSQLAction(){
        $bitacora = new BitacoraFunciones();
        $nombreclasificacion = "";
        $idclasificacion = "";
        $idUsr = $this->get('session')->get('idUsr');
        $btn = $_POST['btn'];
        $fn = new ClasificacionFunciones();
        if ($btn == "Agregar"){
            $nombreclasificacion = $_POST['nombreclasificacion'];
            if($fn->AgregaClasificacion($nombreclasificacion, $idUsr)){
                $accion = "Insertar";
                $detalle = "Insertó: $nombreclasificacion";
                $bitacora->InsertaBitacora($idUsr, $accion, $detalle);
                die("1");
            }
            else die("0");
        } else if ($btn == "Guardar"){
            $nombreclasificacion = $_POST['nombreclasificacion'];
            $idclasificacion = $_POST['idclasificacion'];
            if($fn->ModificarClasificacion($nombreclasificacion, $idclasificacion)){
                $accion = "Modificar";
                $detalle = "Modificó: $idclasificacion";
                $bitacora->InsertaBitacora($idUsr, $accion, $detalle);
                die("1");
            }
            else die("0");
        } else if ($btn == "Desactivar"){
            $idclasificacion = $_POST['idclasificacion'];
            $activo = 0;
            if($fn->ActDesClasificacion($idclasificacion, $activo)){
                $accion = "Desactivar";
                $detalle = "Desactivó: $idclasificacion";
                $bitacora->InsertaBitacora($idUsr, $accion, $detalle);
                die("1");
            }
            else die("0");
        } else{
            $idclasificacion = $_POST['idclasificacion'];
            $activo = 1;
            if($fn->ActDesClasificacion($idclasificacion, $activo)){
                $accion = "Activar";
                $detalle = "Activó: $idclasificacion";
                $bitacora->InsertaBitacora($idUsr, $accion, $detalle);
                die("1");
            }
            else die("0");
        }
        return $this->render('ProyPhotoBundle:Clasificacion:Clasificacion.html.twig');
    }
    
    
    /**
     * @Route("/LlenatablaClasificacion", name="LlenatablaClasificacion")
     */
    public function LlenatablaClasificacionAction(){
        $fn = new ClasificacionFunciones();
        $params = array(
            'clasificaciones' => $fn->GetClasificaciones(),
        );
        
        print_r($params);
        $content = $this->render('ProyPhotoBundle:Clasificacion:TablaClasificacion.html.twig', $params);
        return new Response($content);
    }
    
}