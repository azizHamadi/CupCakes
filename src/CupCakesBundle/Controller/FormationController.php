<?php

namespace CupCakesBundle\Controller;

use CupCakesBundle\Entity\Formation;
use CupCakesBundle\Entity\Session;
use CupCakesBundle\Form\FormationType;
use CupCakesBundle\Form\RechercheFormation;
use CupCakesBundle\Form\UpdateForm;
use CupCakesBundle\Form\updateFormationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class FormationController extends Controller
{
    public function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    //ajouter une formation
    public function createFormationAction(Request $request)
    {

        $formation = new Formation();
        $form=$this->createForm(FormationType::class,$formation);
        $form->handleRequest($request);
        if( $form->isSubmitted())
        {
            $file = $formation->getImageForm();
            $filename =$this->generateUniqueFileName().'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('brochures_directory_formateur'),$filename
            );
            $formation->setImageForm($filename);
            $formation->setIdUser($this->getUser());
            $em=$this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();

            return $this->redirectToRoute("read_Formateur");
        }
        return $this->render('CupCakesBundle:Formateur/FormationSession:createFormation.html.twig', array(
            "form"=>$form->createView()
        ));
    }



    public function readFormationAction()
    {
        $em= $this->getDoctrine()->getManager();
        $formateurs=$em->getRepository(Formation::class)->findAll();
        $sessions=$em->getRepository(Session::class)->findAll();
        foreach ($sessions as $se)
        if($se->getDateFinSes()<= (new \DateTime()))
        {
            $se->setEtatSes("finie");
            $em->flush();

        }
        return $this->render('CupCakesBundle:Client/Formation:readFormateur.html.twig', array(
            "formateurs"=>$formateurs
        ));
    }

//afficher la liste des formations au backend
    public function ListeFormationBackAction(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        //$dql   = "SELECT f FROM CupCakesBundle:Formation f WHERE idUser=".$this->getUser();
        $select=$em->getRepository(Formation::class)->SelectFormationByidUSer($this->getUser());
        //$this->getUser();
       //$query = $em->createQuery($dql);
        $paginator  = $this->get('knp_paginator');
        $pagination=$paginator->paginate(
            $select, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        //$formations=$em->getRepository(Formation::class)->findAll();
        return $this->render('CupCakesBundle:Formateur/FormationSession:readFormation.html.twig', array(
            //"formations"=>$formations
            'pagination' => $pagination
        ));
    }

    //supprimer une formation
    public function deleteFormationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $formation= $em->getRepository(Formation::class)->find($id);
        $formation->setEtatFor("faux");
        $em->flush();
        return $this->redirectToRoute("read_Formateur");
    }


    //modifier une formation
    public function updateFormationAction ($id,Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $formation=$em->getRepository(Formation::class)->find($id);
        $form=$this->createForm(updateFormationType::class,$formation);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->flush();
            return $this->redirectToRoute("read_Formateur");
        }
        return $this->render('CupCakesBundle:Formateur/FormationSession:updateFormation.html.twig', array(
            "form"=>$form->createView()
        ));

    }


    //rechercher une formation par idtypefor
    public function searchFormationAction(Request $request)
    {

            $search = $request->query->get('formation');
            $en = $this->getDoctrine()->getManager();
            $query = $en->getRepository(Formation::class)->findNom($search);
            return $this->render('CupCakesBundle:Formateur/FormationSession:searchFormation.html.twig', array(
                'formation' => $query

            ));

    }

        /*
            $search = $request->get('formation');
            $en = $this->getDoctrine();
            $formations = $en->getRepository(Formation::class)->FindByIdType($search);

        return $this->render("CupCakesBundle:Formateur:readFormation.html.twig",array(

            'formations' => $formations
        ));*/

    //liste des clients affectées a une formation
    public function ClientAffectesAction()
    {
        $em= $this->getDoctrine()->getManager();

        $clients=$em->getRepository(Formation::class)->ClientsAffectés($this->getUser());

        return $this->render('CupCakesBundle:Formateur/FormationSession:ListeClientsAffectes.html.twig', array(
            "clients"=>$clients
        ));
    }

}
