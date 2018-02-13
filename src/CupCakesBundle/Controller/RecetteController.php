<?php
/**
 * Created by PhpStorm.
 * User: escobar
 * Date: 09/02/2018
 * Time: 09:42
 */

namespace CupCakesBundle\Controller;
use CupCakesBundle\Entity\Recette;
use CupCakesBundle\Form\RecetteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class RecetteController extends Controller
{


    public function ListeCAction()
    {
            return $this->render('CupCakesBundle:Client/Recette:RecetteListe.html.twig');
    }

    public function CreateRecetteFormateurAction(Request $request)
    {
        $recette = new Recette();
        $form=$this->createForm(RecetteType::class,$recette);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $recette->setIdUser($this->getUser())
                ->setDateRec(new \Datetime());
            $em=$this->getDoctrine()->getManager();
            $em->persist($recette);
            $em->flush();
        }
        return $this->render('CupCakesBundle:Patisserie/Recette:RecetteList.html.twig', array(
            "form"=>$form->createView()));
    }
    public function ListePAction()
    {
        return $this->render('CupCakesBundle:Client/Recette:RecetteListe.html.twig');
    }
    public function RecetteSingleAction()
    {
        return $this->render('CupCakesBundle:Client/Recette:RecetteSingle.html.twig');

    }
}