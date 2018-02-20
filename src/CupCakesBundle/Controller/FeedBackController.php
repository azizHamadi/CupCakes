<?php
/**
 * Created by PhpStorm.
 * User: escobar
 * Date: 19/02/2018
 * Time: 21:18
 */

namespace CupCakesBundle\Controller;


use CupCakesBundle\Entity\Commande;
use CupCakesBundle\Entity\FeedBack;
use CupCakesBundle\Form\FeedbackType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FeedBackController extends Controller
{
    public function AjouterFeedbackAction(Request $request,$id)
    {
        $feedback = new FeedBack();
        $em=$this->getDoctrine()->getManager();
        if ($request->isMethod("POST")){
            $feedback->setIdCmd($em->getRepository(Commande::class)->find($id))
                      ->setDescription($request->get("Desc"))
                        ->setSujet($request->get("sujet"));

            $em->persist($feedback);
            $em->flush();
            return $this->redirectToRoute("ListeFeedback");
        }
        return $this->render('CupCakesBundle:Client/Commande:AjouterFeedback.html.twig',['Feedback'=>$feedback]);
    }



    public function DetailFeedbackAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $feedback = $em->getRepository(FeedBack::class)->find($id);

        return $this->render('CupCakesBundle:Patisserie/Commande:Feedback.html.twig',["Feedback"=>$feedback]);

    }

    public function ListeFeedbackAction()
    {
        $em = $this->getDoctrine()->getManager();
        $feedback = $em->getRepository(FeedBack::class)->findAll();
        return $this->render('CupCakesBundle:Patisserie/Commande:ListeFeedback.html.twig',array("Feedbacks"=>$feedback));

    }
}