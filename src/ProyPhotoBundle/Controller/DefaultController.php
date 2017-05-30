<?php

namespace ProyPhotoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\Session;
use ProyPhotoBundle\Funciones\DefaultFunciones;//LIBRERÍA QUE HACÍA FALTA

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['usuario'];
            $pass = $_POST['contrasena'];
            $fn = new DefaultFunciones();
            
            
            if($row = $fn->validausr($usuario, $pass)) {
            //    print_r($row);
                if($row['TipoUsr'] == "0"){//usuario normal
                    $session = $request->getSession();
                    $session->start();
                    $this->get('session')->set('idUsr', $row['idUsr']);
                    die("0");
                }
                if($row['TipoUsr'] == "1"){//usuario administrador
              //      print_r($row);
                    $session = $request->getSession();
                    $session->start();
                    $this->get('session')->set('idUsr', $row['idUsr']);
                    die("1");
                }
                else {die("2");
                }
           
                
            }
        }
        return $this->render('ProyPhotoBundle:Default:index.html.twig');
    }//fin de la función index
    
    
    
    
    
    /**
     * @Route("/indexUsuario", name="indexUsuario")
     */
    public function indexUsuarioAction(Request $request){
        
        $session = $request->getSession();
        if($session->has('idUsr')){
            $params = array(
                'mensaje' => 'Bienvenido Admistrador',
                'fecha' => date("d-m-y"),
                'alumno' => "Diana Laura Noria Rodríguez",
            );
            return $this->render('ProyPhotoBundle:Default:indexUsuario.html.twig', $params);
        } else return $this->render('ProyPhotoBundle:Default:index.html.twig');
          
        //return $this->render('ProyPhotoBundle:Default:indexUsuario.html.twig');
    }
    
    /**
     * @Route("/indexAdmin", name="indexAdmin")
     */
    public function indexAdminAction(Request $request){
        
        $session = $request->getSession();
        if($session->has('idUsr')){
            $params = array(
                'mensaje' => 'Bienvenido Admistrador',
                'fecha' => date("d-m-y"),
                'alumno' => "Diana Laura Noria Rodríguez",
            );
            return $this->render('ProyPhotoBundle:Default:indexAdmin.html.twig', $params);
        } else return $this->render('ProyPhotoBundle:Default:index.html.twig');
          
        //return $this->render('ProyPhotoBundle:Default:indexUsuario.html.twig');
    }
    
    
    /**
     * @Route("/Registrar", name="Registrar")
     */
    public function RegistrarAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nomusr = $_POST['nomusr'];
            $password = $_POST['password'];
            $nombre = $_POST['nombre'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];
            $facebook = $_POST['facebook'];
            
            $fn = new DefaultFunciones();
            if ($fn->Registrarusuario($nomusr,$password, $nombre, $tel, $email, $facebook)) die("1");
            else die("0");
        }
        return $this->render('ProyPhotoBundle:Default:Registrar.html.twig');
    }
    
    
    
    
    
    
    
    /**
     * @Route("/Inicio", name="Inicio")
     */
    
    
 /*   public function InicioAction(Request $request){
        $session = $request->getSession();
        if($session->has('idUsr')){
            $params = array(
                'mensaje' => 'Bienvenido Admistrador',
                'fecha' => date("d-m-y"),
                'alumno' => "Diana Laura Noria Rodríguez",
            );
            return $this->render('ProyPhotoBundle:Default:indexAdmin.html.twig', $params);
        } else return $this->render('ProyPhotoBundle:Default:index.html.twig');
    }//fin de función Inicio
  */
}
