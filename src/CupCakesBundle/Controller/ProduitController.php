<?php
/**
 * Created by PhpStorm.
 * User: escobar
 * Date: 09/02/2018
 * Time: 01:59
 */

namespace CupCakesBundle\Controller;
use CupCakesBundle\Entity\Produit;
use CupCakesBundle\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ProduitController extends Controller
{

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
    public function create_ProduitAction(Request $request)
    {

        $produit = new Produit();
        $form=$this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $produit->setIdUser($this->getUser());
            $file = $produit->getImageProd();

            $filename = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('brochures_directory'),$filename
            );
            $produit->setImageProd($filename);
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute("read_produit");
        }
        return $this->render('CupCakesBundle:Patisserie/Produit:CreateProduit.html.twig', array(
            "form"=>$form->createView()
        ));
    }
    public function read_produitAction()
    {
        $produit=new Produit();
        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository(Produit::class)->findAll();
        return $this->render('CupCakesBundle:Patisserie/Produit:readProduit.html.twig', array(
            'produit'=>$produit
        ));
    }
    public function update_ProduitAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository(Produit::class)->find($id);
        $form=$this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);
        if($form->isValid()){
            $em->flush();

            return $this->redirectToRoute('read_produit');

        }

        return $this->render('CupCakesBundle:Patisserie/Produit:CreateProduit.html.twig', array(
            "form"=>$form->createView()
        ));



    }

    public function ListeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository(Produit::class)->findAll();
        return $this->render('CupCakesBundle:Client/Produit:ListeProd.html.twig',array("produits"=>$produits));

    }

    public function ProddetAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository(Produit::class)->find($id);
        $produits=$em->getRepository(Produit::class)->findAll();
        return $this->render('CupCakesBundle:Client/Produit:ProduitSingle.html.twig',array("produit"=>$produit,"produits"=>$produits));

    }

}