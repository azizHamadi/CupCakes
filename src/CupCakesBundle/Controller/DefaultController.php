<?php

namespace CupCakesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CupCakesBundle:Admin:LayoutA.html.twig');
    }

    public function AdminAction()
    {
        return $this->render('CupCakesBundle:Admin:LayoutA.html.twig');
    }

    public function FormateurAction()
    {
        return $this->render('CupCakesBundle:Formateur:LayoutF.html.twig');
    }

    public function clientAction()
    {
        return $this->render('CupCakesBundle:Client:LayoutC.html.twig');
    }

     public function TestAction(){
     $snappy = $this->get('knp_snappy.pdf');
     $filename = 'myFirstSnappyPDF';
     $url = 'http://ourcodeworld.com';


     return new Response(
         $snappy->getOutput($url),
         200,
         array(
             'Content-Type'          => 'application/pdf',
             'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
         )
     );
    }
}
