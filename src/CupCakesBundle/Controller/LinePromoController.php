<?php

namespace CupCakesBundle\Controller;

use CupCakesBundle\Entity\LinePromo;
use CupCakesBundle\Entity\Produit;
use CupCakesBundle\Entity\Promotion;
use CupCakesBundle\Form\LinePromoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class LinePromoController extends Controller
{
    public function create_LinePromotionProduitAction(Request $request)
    {

        $promotion = new LinePromo();
        $form=$this->createForm(LinePromoType::class,$promotion);
        $form->handleRequest($request);
        if($form->isValid())
        {
            /*$produits=$promotion->getIdProd();
            if(is_array($produits))
            {
                foreach($produits as $produit){

                }
            }*/
            dump($promotion);
            $em=$this->getDoctrine()->getManager();
            $prix_produit=$promotion->getIdProd()->getPrixProd();
            $taux_promotion=$promotion->getIdPromo()->getTauxPromo();
            $prix_promotion=$prix_produit-(($prix_produit/100)*$taux_promotion);
            $produit=$em->getRepository(Produit::class)->find($promotion->getIdProd()->getId());
            $produit->setNvPrix($prix_promotion);
            $em->persist($produit);
            $em->flush();
            $em=$this->getDoctrine()->getManager();
            $em->persist($promotion);
            $em->flush();

            return $this->redirectToRoute("liste_Linepromo_produit");

        }
        return $this->render('CupCakesBundle:Patisserie/Promotion:CreateLinePromotion.html.twig', array(
            "form"=>$form->createView(),
            "message2"=>"une nouvelle promotion ajouté avec succés"
        ));
    }

    public function read_LinePromotionAction()
    {

        $em=$this->getDoctrine()->getManager();

        $promotion=$em->getRepository(LinePromo::class)->rechercheId($this->getUser());
        dump($promotion);

        foreach ($promotion as $promo)
    {
        $date_now=new \DateTime();
        if($date_now>$promo->getDateFin()){
            $em->remove($promo);
            $em->flush();
        }
    }
        return $this->render('CupCakesBundle:Patisserie/Promotion:readLinePromotion.html.twig', array(
            'promotion'=>$promotion
        ));

    }

    public function update_lineAction ($id,Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $promotion=$em->getRepository(LinePromo::class)->find($id);
        $form=$this->createForm(LinePromoType::class,$promotion);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em->flush();
            return $this->redirectToRoute("liste_Linepromo_produit");
        }
        return $this->render('@CupCakes/Patisserie/Promotion/updateLinePromotion.html.twig', array(
            "form"=>$form->createView()

        ));

    }


    public function deleteAction(Request $request , $id )
    {
        $promotion=new LinePromo();

        $em = $this->getDoctrine()->getManager();
        $promotion= $em->getRepository('CupCakesBundle:LinePromo')->find($id);
        $em -> remove($promotion) ;
        $em -> flush() ;
        return $this->redirectToRoute('liste_Linepromo_produit');


    }



    public function ListePromoAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $promotions = $em->getRepository(LinePromo::class)->findAll();
        return $this->render('CupCakesBundle:Client/Promotion:ListePromo.html.twig',array("promotions"=>$promotions));

    }

    public function detail_promoAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $promotion = $em->getRepository(LinePromo::class)->find($id);
        $promotions=$em->getRepository(LinePromo::class)->findAll();
        //incrémenter le nombre de vues
        $promotion->setViews($promotion->getViews()+ 1 );
        $em->persist($promotion);
        $em->flush();


        return $this->render('CupCakesBundle:Client/Promotion:datailPromo.html.twig',array("promotion"=>$promotion,"promotions"=>$promotions));

    }



}
