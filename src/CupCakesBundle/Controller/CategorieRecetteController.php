<?php

namespace CupCakesBundle\Controller;

use CupCakesBundle\Entity\Categorie;
use CupCakesBundle\Entity\CategorieRec;
use CupCakesBundle\Form\CategorieRecette;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategorieRecetteController extends Controller
{
    public function listeCategorieRecetteAction()
    {
        $em=$this->getDoctrine()->getManager();
        $categorieRecette = $em->getRepository(CategorieRec::class)->findAll();
        return $this->render('CupCakesBundle:Patisserie/CategorieRecette:CategorieRecetteListe.html.twig',array(
            'categorieRecette'=>$categorieRecette));
    }
    public function ajouterCategorieRecetteAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
            $categorieRecette = new CategorieRec();
        $form=$this->createForm(CategorieRecette::class,$categorieRecette);
        $form->handleRequest($request);
        $message=null;
        if($form->isSubmitted())
        {
            $categorie = $em->getRepository(CategorieRec::class)->findBynomCatRec(strtoupper($categorieRecette->getNomCatRec()));
            if($categorie==null)
            {$em->persist($categorieRecette);
            $em->flush();
            $categorieRecettes =$em->getRepository(CategorieRec::class)->findAll();
            return $this->redirectToRoute('ListCategorieRecette');
            }
        }
        $categorie = $em->getRepository(CategorieRec::class)->findBynomCatRec(strtoupper($categorieRecette->getNomCatRec()));
        if($categorie==null)
            return $this->render('CupCakesBundle:Patisserie/CategorieRecette:ajouterCategorieRecette.html.twig',array(
            'categorieRecette'=>$categorieRecette,'form'=>$form->createView(),'titre'=>"Ajouter Categorie Recette",'message'=>null));
        else
            return $this->render('CupCakesBundle:Patisserie/CategorieRecette:ajouterCategorieRecette.html.twig',array(
                'categorieRecette'=>$categorieRecette,'form'=>$form->createView(),'titre'=>"Ajouter Categorie Recette",'message'=>"Categorie existe deja"));
    }

    public function ajouterCCategorieRecetteAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $categorieRecette = new CategorieRec();
        $form=$this->createForm(CategorieRecette::class,$categorieRecette);
        $form->handleRequest($request);
        $message=null;
        if($form->isSubmitted())
        {
            $categorie = $em->getRepository(CategorieRec::class)->findBynomCatRec(strtoupper($categorieRecette->getNomCatRec()));
            if($categorie==null)
            {
                $em->persist($categorieRecette);
                $em->flush();
                $categorieRecettes =$em->getRepository(CategorieRec::class)->findAll();
                return $this->redirectToRoute('ListCategorieRecette');
            }
        }
        $categorie = $em->getRepository(CategorieRec::class)->findBynomCatRec(strtoupper($categorieRecette->getNomCatRec()));
        if($categorie==null)
            return $this->render('CupCakesBundle:Client/CategorieRecette:ajouterCategorieRecette.html.twig',array(
                'categorieRecette'=>$categorieRecette,'form'=>$form->createView(),'titre'=>"Ajouter Categorie Recette",'message'=>null));
        else
            return $this->render('CupCakesBundle:Client/CategorieRecette:ajouterCategorieRecette.html.twig',array(
                'categorieRecette'=>$categorieRecette,'form'=>$form->createView(),'titre'=>"Ajouter Categorie Recette",'message'=>"Categorie existe deja"));
    }


    public function updateCategorieRecetteAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $categorieRecette = $em->getRepository(CategorieRec::class)->find($id);
        $form=$this->createForm(CategorieRecette::class,$categorieRecette);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em->flush();
            $categorieRecettes =$em->getRepository(CategorieRec::class)->findAll();
            return $this->render('CupCakesBundle:Patisserie/CategorieRecette:CategorieRecetteListe.html.twig', array(
                'categorieRecettes'=>$categorieRecettes));
        }
        return $this->render('CupCakesBundle:Patisserie/CategorieRecette:ajouterCategorieRecette.html.twig',array(
            'categorieRecette'=>$categorieRecette,'form'=>$form->createView(),'titre'=>"Modifier Categorie Recette"));
    }


    public function listeCategorieRecetteFormateurAction()
    {
        $em=$this->getDoctrine()->getManager();
        $categorieRecette = $em->getRepository(CategorieRec::class)->findAll();
        return $this->render('CupCakesBundle:Formateur/CategorieRecette:CategorieRecetteListe.html.twig',array(
            'categorieRecette'=>$categorieRecette));
    }

    public function listeCategorieRecettePatisserieAction()
    {
        $em=$this->getDoctrine()->getManager();
        $categorieRecette = $em->getRepository(CategorieRec::class)->findAll();
        return $this->render('CupCakesBundle:Patisserie/CategorieRecette:CategorieRecetteListe.html.twig',array(
            'categorieRecette'=>$categorieRecette));
    }


    public function ajouterFCategorieRecetteAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $categorieRecette = new CategorieRec();
        $form=$this->createForm(CategorieRecette::class,$categorieRecette);
        $form->handleRequest($request);
        $message=null;
        if($form->isSubmitted())
        {
            $categorie = $em->getRepository(CategorieRec::class)->findBynomCatRec(strtoupper($categorieRecette->getNomCatRec()));
            if($categorie==null)
            {
                $em->persist($categorieRecette);
                $em->flush();
                $categorieRecettes =$em->getRepository(CategorieRec::class)->findAll();
                return $this->redirectToRoute('ListCategorieRecetteFormateur');
            }
        }
        $categorie = $em->getRepository(CategorieRec::class)->findBynomCatRec(strtoupper($categorieRecette->getNomCatRec()));
        if($categorie==null)
            return $this->render('CupCakesBundle:Formateur/CategorieRecette:ajouterCategorieRecette.html.twig',array(
                'categorieRecette'=>$categorieRecette,'form'=>$form->createView(),'titre'=>"Ajouter Categorie Recette",'message'=>null));
        else
            return $this->render('CupCakesBundle:Formateur/CategorieRecette:ajouterCategorieRecette.html.twig',array(
                'categorieRecette'=>$categorieRecette,'form'=>$form->createView(),'titre'=>"Ajouter Categorie Recette",'message'=>"Categorie existe deja"));
    }

    public function ajouterPCategorieRecetteAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $categorieRecette = new CategorieRec();
        $form=$this->createForm(CategorieRecette::class,$categorieRecette);
        $form->handleRequest($request);
        $message=null;
        if($form->isSubmitted())
        {
            $categorie = $em->getRepository(CategorieRec::class)->findBynomCatRec(strtoupper($categorieRecette->getNomCatRec()));
            if($categorie==null)
            {
                $em->persist($categorieRecette);
                $em->flush();
                $categorieRecettes =$em->getRepository(CategorieRec::class)->findAll();
                return $this->redirectToRoute('ListCategorieRecetteFormateur');
            }
        }
        $categorie = $em->getRepository(CategorieRec::class)->findBynomCatRec(strtoupper($categorieRecette->getNomCatRec()));
        if($categorie==null)
            return $this->render('CupCakesBundle:Patisserie/CategorieRecette:ajouterCategorieRecette.html.twig',array(
                'categorieRecette'=>$categorieRecette,'form'=>$form->createView(),'titre'=>"Ajouter Categorie Recette",'message'=>null));
        else
            return $this->render('CupCakesBundle:Patisserie/CategorieRecette:ajouterCategorieRecette.html.twig',array(
                'categorieRecette'=>$categorieRecette,'form'=>$form->createView(),'titre'=>"Ajouter Categorie Recette",'message'=>"Categorie existe deja"));
    }


}
