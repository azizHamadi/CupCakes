<?php
/**
 * Created by PhpStorm.
 * User: escobar
 * Date: 09/02/2018
 * Time: 09:42
 */

namespace CupCakesBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class RecetteController extends Controller
{


    public function ListeAction()
    {
        return $this->render('CupCakesBundle:Client/Recette:RecetteListe.html.twig');

    }
    public function RecetteSingleAction()
    {
        return $this->render('CupCakesBundle:Client/Recette:RecetteSingle.html.twig');

    }
}