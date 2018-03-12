<?php

namespace CupCakesBundle\Controller;

use CupCakesBundle\Entity\LinePromo;
use CupCakesBundle\Entity\Produit;
use CupCakesBundle\Entity\Promotion;
use CupCakesBundle\Entity\Session;
use CupCakesBundle\Form\PromotionType;
use CupCakesBundle\Form\SessionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;

class PromotionController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }
     public function create_PromotionAction(Request $request)
    {

        $promotion = new Promotion();
        $form=$this->createForm(PromotionType::class,$promotion);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $promo=$em->getRepository(Promotion::class)->findBytauxPromo($promotion->getTauxPromo());
            if ($promo==null) {


            $em->persist($promotion);
            $em->flush();

            return $this->redirectToRoute("create_Line_Promotion");
            }else
            {
                return $this->render('@CupCakes/Patisserie/Promotion/CreatePromotion.html.twig', array(
                    "form"=>$form->createView(),
                    "message"=>"pourcentage deja existe vous pouvez ajouter une produit sous promotion direct"
                ));
            }
            }
        return $this->render('@CupCakes/Patisserie/Promotion/CreatePromotion.html.twig', array(
            "form"=>$form->createView(),
            "message"=>null
        ));
    }



        public function read_PromotionAction()
    {
        $promotion =new Promotion();
        $em=$this->getDoctrine()->getManager();
        $promotion=$em->getRepository(Promotion::class)->findAll();
        return $this->render('CupCakesBundle:Patisserie/Promotion:readPromotion.html.twig', array(
            'promotion'=>$promotion
        ));
    }



    public function create_PromotionFormationAction(Request $request)
    {

        $promotion = new Promotion();
        $form=$this->createForm(PromotionType::class,$promotion);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $em=$this->getDoctrine()->getManager();

            $em->persist($promotion);
            $em->flush();
            return $this->redirectToRoute("creat_Promotion_session");
        }
        return $this->render('CupCakesBundle:Formateur/Promotion:AjouterPromotionFor.html.twig', array(
            "form"=>$form->createView()
        ));
    }

    public function read_PromotionFormationAction()
    {
        $promotion =new Promotion();
        $em=$this->getDoctrine()->getManager();
        $promotion=$em->getRepository(Promotion::class)->findAll();
        return $this->render('CupCakesBundle:Formateur/Promotion:listPromoFormation.html.twig', array(
            'promotion'=>$promotion
        ));
    }
   /* public function calculer_promotionAction()
    {
        $promotion =new Promotion();
        $em=$this->getDoctrine()->getManager();
        $prix=$em->getRepository(Produit::class)->findByidProd($this->getPrixProd());

        $poucentage=$em->getRepository(Promotion::class)->findBytauxPromo($this->getTauxPromo());
        $result= ($prix*100)/$poucentage;
        return $this->render('CupCakesBundle:Patisserie/Promotion:readLinePromotion.html.twig', array(
            'promotion'=>$promotion ));

    }*/
}
