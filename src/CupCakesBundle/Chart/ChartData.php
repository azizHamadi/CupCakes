<?php
/**
 * Created by PhpStorm.
 * User: escobar
 * Date: 28/02/2018
 * Time: 14:38
 */

namespace CupCakesBundle\Chart;

use Doctrine\Common\Persistence\ObjectManager;

class ChartData
{
    private $em;


    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }



    /**
     * Récupère et organise les données pour le graphique de la qte par produit
     *
     * @return array
     */
    public function ProduitQte()
    {
        $stats = $this->em->getRepository('CupCakesBundle:Produit')->FindAll();

        $arrayToDataTable[] = ['NomProduit', 'QteAcheter'];
        foreach ($stats as $stat) {
            $QteAcheter=($this->em->getRepository("CupCakesBundle:Produit"))->find($stat)->getQteAcheter();
            $nom=($this->em->getRepository("CupCakesBundle:Produit"))->find($stat)->getNomProd();
            $arrayToDataTable[] = [$nom,$QteAcheter];
        }

        return $arrayToDataTable;
    }
}