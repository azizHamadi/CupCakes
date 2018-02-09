<?php
/**
 * Created by PhpStorm.
 * User: escobar
 * Date: 09/02/2018
 * Time: 01:59
 */

namespace CupCakesBundle\Controller;


class ProduitController
{


    public function ListeAction()
    {
        return $this->render('CupCakesBundle:Client:ListeProd.html.twig');

    }

    public function ProddetAction()
    {
        return $this->render('CupCakesBundle:Client:ProduitSingle.html.twig');

    }

}