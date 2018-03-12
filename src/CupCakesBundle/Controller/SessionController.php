<?php

namespace CupCakesBundle\Controller;

use CupCakesBundle\Entity\Educate;
use CupCakesBundle\Entity\Formation;
use CupCakesBundle\Entity\Session;
use CupCakesBundle\Form\RechercheSession;
use CupCakesBundle\Form\SessionType;
use CupCakesBundle\Form\updateSession;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SessionController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
    public function generateUniqueFileName()
    {
        return md5(uniqid());
    }
    public function createSessionAction(Request $request)
    {

        $session = new Session();
        $form=$this->createForm(SessionType::class,$session);
        $form->handleRequest($request);

        if($form->isValid())
        {
            $file = $session->getImageSess();
            $filename =$this->generateUniqueFileName().'.'.$file->GuessExtension();
            $file->move(
                $this->getParameter('brochures_directory_formateur'),$filename
            );
            $session->setImageSess($filename);
            $session->setEtatSes("en cours");
            $em=$this->getDoctrine()->getManager();
            $em->persist($session);
            /*$datefin = new \DateTime($session->getDateFinSes());
            $datedebut = new \DateTime($session->getDateDebSes());

            var_dump($datedebut == $datefin);
            var_dump($datedebut < $datefin);
            var_dump($datedebut > $datefin);*/

            $em->flush();

            return $this->redirectToRoute("read_Session");
        }
        return $this->render('CupCakesBundle:Formateur/FormationSession:createSession.html.twig', array(
            "form"=>$form->createView()
        ));
    }

    public function readSessionAction(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
       // $dql   = "SELECT s FROM CupCakesBundle:Session s";
        //$query = $em->createQuery($dql);
        $select=$em->getRepository(Session::class)->SelectSessionByidUser($this->getUser());
        $paginator  = $this->get('knp_paginator');
        $pagination=$paginator->paginate(
            $select, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        //$formations=$em->getRepository(Formation::class)->findAll();
        return $this->render('CupCakesBundle:Formateur/FormationSession:readSession.html.twig', array(
            //"formations"=>$formations
            'pagination' => $pagination , 'date' => (new \DateTime())
        ));

    }

    public function readSessionByIdForAction($id)
    {

        $educate = new Educate();
        $iduser=$educate->getIdUser();

        $em= $this->getDoctrine()->getManager();
        $sessionsByIdFor=$em->getRepository(Session::class)->findByidFor($id);
        $sessionsnom=$em->getRepository(Formation::class)->find($id);
        $test=$em->getRepository(Educate::class)->chercherIdForandSes($iduser,$id);

        if($sessionsByIdFor == null)
        {
            return $this->render('CupCakesBundle:Client/Formation:AucuneSessionDisponible.html.twig');
        }
        else
        {
            return $this->render('CupCakesBundle:Client/Formation:readSessionByIdFor.html.twig', array(
                "sessionsByIdFor"=>$sessionsByIdFor,"sessionsnom"=>$sessionsnom,"message"=>null,"test"=>null
            ));
        }

    }

    //afficher la liste des sessions dune formation disponible en backend
    public function readSessionByIdForBackAction(Request $request,$id)
    {

        $em= $this->getDoctrine()->getManager();
        $sessions=$em->getRepository(Session::class)->findByidFor($id);

        $paginator  = $this->get('knp_paginator');
        $pagination=$paginator->paginate(
            $sessions, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

            return $this->render('CupCakesBundle:Formateur/FormationSession:readSession.html.twig', array(
                //"formations"=>$formations
                'pagination' => $pagination , 'date' => (new \DateTime())
            ));

    }

    //afficher les sessions en cours et finies dun client
    public function SessionencoursfinieAction()
    {

        $em= $this->getDoctrine()->getManager();

        $sessionencours=$em->getRepository(Session::class)->SessionEncours($this->getUser());
        $sessionfinies=$em->getRepository(Session::class)->Sessionfinie($this->getUser());
        $message="inexistant";

            return $this->render('CupCakesBundle:Client/Formation:Listedemesformations.html.twig', array(
                "sessionencours"=>$sessionencours,
                "sessionfinies"=>$sessionfinies,
                "message"=>null
            ));
    }



    //supprimer une session
    public function deleteSessionAction($id)
    {
         $em = $this->getDoctrine()->getManager();
         $session= $em->getRepository(Session::class)->find($id);
         $session->setEtatSes("out");
         $em->flush();
         return $this->redirectToRoute("read_Session");
    }


    //modifier une session
    public function updateSessionAction ($id,Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $session=$em->getRepository(Session::class)->find($id);
        $form=$this->createForm(updateSession::class,$session);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->flush();
            return $this->redirectToRoute("read_Session");
        }
        return $this->render('CupCakesBundle:Formateur/FormationSession:updateSession.html.twig', array(
            "form"=>$form->createView()
        ));

    }


    //rechercher une session par date debut
    public function searchSessionAction(Request $request)
    {
        $session = new Session();

        $form=$this->createForm(RechercheSession::class,$session);
        $form->handleRequest($request);


            $search =$request->query->get('session');
            $dateDebut=$session->getDateDebSes();
            $em = $this->getDoctrine();
            $query=$em->getRepository(Session::class)->ListesessionsAffectes($this->getUser());
            $paginator  = $this->get('knp_paginator');
            $pagination=$paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );
        return $this->render('CupCakesBundle:Formateur/FormationSession:searchSession.html.twig', array(
            "form"=>$form->createView(),
            'pagination' => $pagination
        ));
    }


    public function updateEtatSession($id)
    {
        $em= $this->getDoctrine()->getManager();


    }

    public function readSessionEnPromoAction(Request $request)
    {

        $em= $this->getDoctrine()->getManager();
        $sessions=$em->getRepository(Session::class)->findSessionPromo();


        return $this->render('CupCakesBundle:Client/Promotion:listPromotionFormation.html.twig', array(
            "session"=>$sessions,"message"=>null

        ));

    }
}
