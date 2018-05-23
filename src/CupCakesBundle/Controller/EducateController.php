<?php

namespace CupCakesBundle\Controller;

use CupCakesBundle\Entity\Educate;
use CupCakesBundle\Entity\Formation;
use CupCakesBundle\Entity\Session;
use CupCakesBundle\Form\EducateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Tests\Fixtures\ToString;

class EducateController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    //Ajouter un client a une session en effectuant les tests necessaires
    public function createEducateSansPromoAction(Request $request,$id)
    {

        $educate = new Educate();
        $educate->setEtatEduc("inscri");
        $em=$this->getDoctrine()->getManager();
        $educate->setIdUser($this->getUser());
        $educate->setIdSes($em->getRepository(Session::class)->find($id));
        $educate->setDateIscri(new \DateTime());
        $iduser=$educate->getIdUser();
        //chercher iduser et idsession sil existe deja dans la table educate
        $test=$em->getRepository(Educate::class)->chercherIdForandSes($iduser,$id);
        //find session par id formation
        $sessionsByIdFor=$em->getRepository(Session::class)->find($id);
        //afficher le nom de la formation a partir de la session
        $sessionsnom=$em->getRepository(Formation::class)->find($sessionsByIdFor->getIdFor());
        //afficher la liste des sessions a partir
        $sessions =$em->getRepository(Session::class)->findByidFor($sessionsByIdFor->getIdFor());
        //$count=$em->getRepository(Educate::class)->CountNbrClient($id);//ne9es id session
        //afficher la capacite de la session a partir de son id
        //$capacite=$sessionsByIdFor->getCapaciteSes();
        $message="client deja inscrit";
            if(($test==null) && ($sessionsByIdFor->getCapaciteSes() != 0) )
            {

                $em->persist($educate);
                $sessionsByIdFor->setCapaciteSes($sessionsByIdFor->getCapaciteSes() - 1 );
                $em->flush();
                return $this->render('CupCakesBundle:Client/Formation:readSessionByIdFor.html.twig', array(
                    "sessionsByIdFor"=>$sessions,"sessionsnom"=>$sessionsnom , "message"=>null,"test"=>$test
                ));
            }
            else
            {
                if ($test !=null ) $message="client deja inscri";
                else $message="capacite = 0";
                return $this->render('CupCakesBundle:Client/Formation:readSessionByIdFor.html.twig', array(
                    "sessionsByIdFor"=>$sessions,"sessionsnom"=>$sessionsnom , "message"=>$message,"test"=>$test
                ));
            }

    }

    //Ajouter un client a une session avec promo en effectuant les tests necessaires
    public function createEducateAvecPromoAction(Request $request,$id)
    {
        $educate = new Educate();
        $educate->setEtatEduc("inscri");
        $em=$this->getDoctrine()->getManager();
        $educate->setIdUser($this->getUser());
        $educate->setIdSes($em->getRepository(Session::class)->find($id));
        $educate->setDateIscri(new \DateTime());
        $iduser=$educate->getIdUser();
        //chercher iduser et idsession sil existe deja dans la table educate
        $test=$em->getRepository(Educate::class)->chercherIdForandSes($iduser,$id);
        //find session par id formation
        $sessionsByIdFor=$em->getRepository(Session::class)->find($id);
        //afficher le nom de la formation a partir de la session
        $sessionsnom=$em->getRepository(Formation::class)->find($sessionsByIdFor->getIdFor());
        //afficher la liste des sessions a partir
        //$count=$em->getRepository(Educate::class)->CountNbrClient($id);//ne9es id session
        //afficher la capacite de la session a partir de son id
        //$capacite=$sessionsByIdFor->getCapaciteSes();
        $sessionsnom=$em->getRepository(Formation::class)->find($sessionsByIdFor->getIdFor());
        $message="client deja inscrit";
        if(($test==null) && ($sessionsByIdFor->getCapaciteSes() != 0) )
        {

            $em->persist($educate);
            $sessionsByIdFor->setCapaciteSes($sessionsByIdFor->getCapaciteSes() - 1 );
            $em->flush();
            $sessions =$em->getRepository(Session::class)->findSessionPromo();
            return $this->render('CupCakesBundle:Formateur/Promotion:listPromotionFormation.html.twig', array(
                "session"=>$sessions , "message"=>null,"test"=>$test
            ));
        }
        else
        {
            if ($test !=null ) $message="client deja inscri";
            else $message="capacite = 0";
            $sessions =$em->getRepository(Session::class)->findSessionPromo();
            return $this->render('CupCakesBundle:Formateur/Promotion:listPromotionFormation.html.twig', array(
                "session"=>$sessions,"message"=>$message,"test"=>$test
            ));
        }

    }
    public function readEducateAction(Request $request,$id)
    {
        $educate = new Educate();


            $educate->setIdSes($id);
            $educate->setEtatEduc("hello");
            $educate->setDateIscri(new \DateTime());
            $educate->setIdUser($this->getUser());
            $em=$this->getDoctrine()->getManager();
            $em->persist($educate);
            $em->flush();




        $em= $this->getDoctrine()->getManager();
        $educates=$em->getRepository(Educate::class)->findAll();

        return $this->render('CupCakesBundle:Formateur/FormationSession:readEducate.html.twig', array(
            "educates"=>$educates
        ));
    }


}
