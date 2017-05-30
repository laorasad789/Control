<?php

namespace ProyPhotoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use ProyPhotoBundle\Funciones\MarcaFunciones;
use Symfony\Component\HttpFoundation\Response;
use ProyPhotoBundle\Funciones\BitacoraFunciones;

class MarcaController extends Controller{
    
    /**
     * @Route("/Marca", name="Marca")
     */
    public function MarcaAction(){
        return $this->render('ProyPhotoBundle:Marca:Marca.html.twig');
    }
    
    /**
     * @Route("/OperacionesSQLMarca", name="OperacionesSQLMarca")
     * @Method({"POST"})
     */
    public function OperacionesSQLMarcaAction(){
        $bitacora = new BitacoraFunciones();
        $nombremarca = "";
        $idmarca = "";
        $idUsr = $this->get('session')->get('idUsr');
        $btn = $_POST['btn'];
        $fn = new MarcaFunciones();
        if ($btn == "Agregar"){
            $nombremarca = $_POST['nombremarca'];
            if($fn->AgregaMarca($nombremarca, $idUsr)){
                $accion = "Insertar";
                $detalle = "Insertó: $nombremarca";
                $bitacora->InsertaBitacora($idUsr, $accion, $detalle);
                die("1");
            }
            else die("0");
        } else if ($btn == "Guardar"){
            $nombremarca = $_POST['nombremarca'];
            $idmarca = $_POST['idmarca'];
            if($fn->ModificarMarca($nombremarca, $idmarca)){
                $accion = "Modificar";
                $detalle = "Modificó: $idmarca";
                $bitacora->InsertaBitacora($idUsr, $accion, $detalle);
                die("1");
            }
            else die("0");
        } else if ($btn == "Desactivar"){
            $idmarca = $_POST['idmarca'];
            $activo = 0;
            if($fn->ActDesMarca($idmarca, $activo)){
                $accion = "Desactivar";
                $detalle = "Desactivó: $idmarca";
                $bitacora->InsertaBitacora($idUsr, $accion, $detalle);
                die("1");
            }
            else die("0");
        } else{
            $idmarca = $_POST['idmarca'];
            $activo = 1;
            if($fn->ActDesMarca($idmarca, $activo)){
                $accion = "Activar";
                $detalle = "Activó: $idmarca";
                $bitacora->InsertaBitacora($idUsr, $accion, $detalle);
                die("1");
            }
            else die("0");
        }
        return $this->render('ProyPhotoBundle:Marca:Marca.html.twig');
    }
    
    
    /**
     * @Route("/LlenatablaMarca", name="LlenatablaMarca")
     */
    public function LlenatablaMarcaAction(){
        $fn = new MarcaFunciones();
        $params = array(
            'marcas' => $fn->GetMarcas(),
        );
        
        //print_r($params);
        $content = $this->render('ProyPhotoBundle:Marca:TablaMarca.html.twig', $params);
        return new Response($content);
    }
    
}