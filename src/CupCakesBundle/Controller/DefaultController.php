<?php

namespace CupCakesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CupCakesBundle:Patisseuri:layout.html.twig');
    }

    public function AdminAction()
    {
        return $this->render('CupCakesBundle:Admin:LayoutA.html.twig');
    }

    public function FormateurAction()
    {
        return $this->render('CupCakesBundle:Formateur:LayoutF.html.twig');
    }

    public function clientAction()
    {
        return $this->render('CupCakesBundle:Client:LayoutC.html.twig');
    }

    public function DashAdAction()
    {
        return $this->render('CupCakesBundle::DashAd.layout.twig');
    }
}
