<?php

namespace CupCakesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $chart = $this->get('app.chart');

        return $this->render('CupCakesBundle:Patisserie:AcceuilP.html.twig',['ProduitQte' => $chart->ProduitQte()]);
    }

    public function AdminAction()
    {
        return $this->render('CupCakesBundle:Admin:LayoutA.html.twig');
    }

    public function FormateurAction()
    {
        return $this->render('CupCakesBundle:Formateur:LayoutF.html.twig');
    }

    public function clientAction(SessionInterface $session)
    {
        if (!$session->has('panier')) $session->set('panier', array());

        $em = $this->getDoctrine()->getManager();
        $may = $em->getRepository('CupCakesBundle:Produit')->findArray(array_keys($session->get('panier')));
        return $this->render('CupCakesBundle:Client:LayoutC.html.twig', ['May' => $may,
            'panier' => $session->get('panier')]);
    }


}
