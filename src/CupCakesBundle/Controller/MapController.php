<?php

namespace CupCakesBundle\Controller;

use CupCakesBundle\Entity\Formation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MapController extends Controller
{
    public function mapAction($id)
    {
        //$Latitudes=40.714224;
        //$Longitudes=-73.961452;
        $em= $this->getDoctrine()->getManager();
        $formateurs=$em->getRepository(Formation::class)->find($id);


        $place=$formateurs->getPlace();
                return $this->render('CupCakesBundle:Formateur/FormationSession:map.html.twig',array('place'=>$place
        ));


    }
}
