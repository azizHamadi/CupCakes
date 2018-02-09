<?php
/**
 * Created by PhpStorm.
 * User: escobar
 * Date: 09/02/2018
 * Time: 01:31
 */

namespace CupCakesBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class CommandeController extends Controller
{

    public function MainAction()
    {
        return $this->render('CupCakesBundle:Client/Commande:Commande.html.twig');
    }

    public function SuivieAction()
    {
        return $this->render('CupCakesBundle:Client/Commande:Suivie.html.twig');
    }
}