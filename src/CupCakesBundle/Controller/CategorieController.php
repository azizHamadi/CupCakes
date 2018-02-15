<?php

namespace CupCakesBundle\Controller;

use CupCakesBundle\Entity\Categorie;
use CupCakesBundle\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategorieController extends Controller
{
    public function create_CategorieAction( Request $request)
    {

        $categorie = new Categorie();
        $form=$this->createForm(CategorieType::class,$categorie);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute("read");
        }
        return $this->render('CupCakesBundle:Patisserie/Categorie:Categorie.html.twig', array(
            "form"=>$form->createView()
        ));
    }
    public function read_categorieAction()
    {
        $categorie=new Categorie();
        $em=$this->getDoctrine()->getManager();
        $categorie=$em->getRepository(Categorie::class)->findAll();
        return $this->render('CupCakesBundle:Patisserie/Categorie:ReadCategorie.html.twig', array(
            'categorie'=>$categorie
        ));
    }

    public function delete_categorieAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie= $em->getRepository(Categorie::class)->find($id);
        $em->remove($categorie);
        $em->flush();
        return $this->redirectToRoute("Supprimer_Categorie");
    }
    public function update_CategorieAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository(Categorie::class)->find($id);
        $form=$this->createForm(CategorieType::class,$categorie);
        $form->handleRequest($request);
        if($form->isValid()){
            $em->flush();

            return $this->redirectToRoute('read');

        }

        return $this->render('CupCakesBundle:Patisserie/Categorie:Categorie.html.twig', array(
            "form"=>$form->createView()
        ));
}
}
