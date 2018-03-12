<?php

namespace CupCakesBundle\Controller;

use CupCakesBundle\Entity\Formation;
use CupCakesBundle\Entity\LinePromoSes;
use CupCakesBundle\Entity\Session;
use CupCakesBundle\Form\LinePromoFormationType;
use CupCakesBundle\Form\LinePromoSesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LinePromoSesController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function create_LinePromotionSessionAction(Request $request)
    {

        $promotion = new LinePromoSes();
        $form=$this->createForm(LinePromoSesType::class,$promotion);
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
            $prix_ses=$promotion->getIdSes()->getPrix();
            $taux_promotion=$promotion->getIdPromo()->getTauxPromo();
            $prix_promotion=$prix_ses-(($prix_ses/100)*$taux_promotion);
            $session=$em->getRepository(Session::class)->find($promotion->getIdSes()->getId());
            $session->setNvPrix($prix_promotion);
            $em->persist($session);
            $em->flush();
            $em=$this->getDoctrine()->getManager();
            $em->persist($promotion);
            $em->flush();

            return $this->redirectToRoute("read_Promotion_session");

        }
        return $this->render('@CupCakes/Formateur/Promotion/AjouterPromotionSession.html.twig', array(
            "form"=>$form->createView(),
            "message2"=>"une nouvelle promotion ajouté avec succés"
        ));
    }

    public function read_PromotionSessionAction()
    {
        $promotion =new Session();
        $em=$this->getDoctrine()->getManager();
        dump($promotion);
        $promotion=$em->getRepository(LinePromoSes::class)->rechercheLinePromoSession($this->getUser());
        return $this->render('CupCakesBundle:Formateur/Promotion:listPromoSession.html.twig', array(
            'promotion'=>$promotion
        ));
    }

    public function update_session_promoAction ($id,Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $promotion=$em->getRepository(LinePromoSes::class)->find($id);
        $form=$this->createForm(LinePromoSesType::class,$promotion);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $promotion=$form->getData();
            $em->flush();
            return $this->redirectToRoute("read_Promotion_session");
        }
        return $this->render('@CupCakes/Formateur/Promotion/updatePromoSession.html.twig', array(
            "form"=>$form->createView()

        ));

    }

    public function deleteAction(Request $request , $id )
    {
        $promotion=new Session();
        $em = $this->getDoctrine()->getManager();
        $promotion= $em->getRepository('CupCakesBundle:Session')->find($id);
        $em -> remove($promotion) ;
        $em -> flush() ;
        return $this->redirectToRoute('read_Promotion_session');
    }
    /*public function read_promo_sessionAction()
    {
        $promotion =new Promotion();
        $em=$this->getDoctrine()->getManager();
        $promotion=$em->getRepository(Formation::class)->findAll();
        return $this->render('CupCakesBundle:Client/Formateur:listPromoForm.html.twig', array(
            'promotion'=>$promotion
        ));
    }

    public function creat_promo_formationAction(Request $request ,$id )
    {
        $em=$this->getDoctrine()->getManager();
        $session=$em->getRepository(Session::class)->findByidFor($id);
        $form=$this->createForm(LinePromoFormationType::class,$session);
        $form->handleRequest($request);
        if($form->isSubmitted()) {
        foreach ($session as $ses)
        {
            $date_now=new \DateTime();
            if($date_now>$ses->getDateFin()){
                $session=new LinePromoSes();
                $prix_ses=$session->getIdSes()->getPrixSes();
                $taux_promotion=$session->getIdPromo()->getTauxPromo();
                $prix_ses=$prix_ses-(($prix_ses/100)*$taux_promotion);
                $session=$em->getRepository(Session::class)->find($session->getIdSes()->getId());
                $session->setNvPrixSes($prix_ses);
                $em->persist($session);
                $em->flush();
                return $this->redirectToRoute("read_promo_formation");
            }
        }
            return $this->render('@CupCakes/Formateur/Promotion/AjouterPromotionFormation.html.twig', array(
                "form"=>$form->createView(),
                "now"=>$date_now
            ));
        }

    }*/

 /*   public function read_PromotionFormationAction()
    {
        $em=$this->getDoctrine()->getManager();
        $session=$em->getRepository(Session::class)->findAll();
        $sessionsnom=$em->getRepository(Formation::class)->find($id);
        return $this->render('CupCakesBundle:Client/Promotion:listPromotionFormation.html.twig', array(
            'session'=>$session,"sessionsnom"=>$sessionsnom , "message"=>null,"test"=>$test
        ));
    }
*/


}
