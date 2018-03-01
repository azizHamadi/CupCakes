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

        return $this->render('CupCakesBundle:Client:LayoutC2.html.twig');
    }


}
