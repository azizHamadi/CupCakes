<?php
/**
 * Created by PhpStorm.
 * User: escobar
 * Date: 09/02/2018
 * Time: 01:31
 */

namespace CupCakesBundle\Controller;


class CommandeController
{

    public function MainAction()
    {
        return $this->render('CupCakesBundle:Client:Commande.html.twig');
    }

    public function SuivieAction()
    {
        return $this->render('CupCakesBundle:Client:Suivie.html.twig');
    }
}