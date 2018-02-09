<?php
/**
 * Created by PhpStorm.
 * User: escobar
 * Date: 09/02/2018
 * Time: 01:59
 */

namespace CupCakesBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ProduitController extends Controller
{


    public function ListeAction()
    {
        return $this->render('CupCakesBundle:Client/Produit:ListeProd.html.twig');

    }

    public function ProddetAction()
    {
        return $this->render('CupCakesBundle:Client/Produit:ProduitSingle.html.twig');

    }

}