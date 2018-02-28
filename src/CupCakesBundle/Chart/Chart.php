<?php
/**
 * Created by PhpStorm.
 * User: escobar
 * Date: 28/02/2018
 * Time: 16:00
 */

namespace CupCakesBundle\Chart;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\ComboChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\VAxis;

class Chart
{
    const ANIMATION_STARTUP = true;
    const ANIMATION_DURATION = 100;
    const CHART_AREA_HEIGHT = '80%';
    const CHART_AREA_WIDTH = '80%';

    private $chartData;


    public function __construct(ChartData $chartData)
    {
        $this->chartData = $chartData;
    }


    /**
     * Crée le graphique du montant des bénéfices par année.
     *
     * @return ComboChart
     */
    public function ProduitQte()
    {
        $arrayToDataTable = $this->chartData->ProduitQte();

        $chart = new ComboChart();
        $chart->getData()->setArrayToDataTable($arrayToDataTable);
        $chart->getOptions()->getAnimation()->setStartup(self::ANIMATION_STARTUP);
        $chart->getOptions()->getAnimation()->setDuration(self::ANIMATION_DURATION);
        $chart->getOptions()->getChartArea()->setHeight(self::CHART_AREA_HEIGHT);
        $chart->getOptions()->getChartArea()->setWidth(self::CHART_AREA_WIDTH);

        $vAxisAmount = new VAxis();
        $vAxisAmount->setTitle('Quantités Acheter');
        $vAxisEvol = new VAxis();
        $vAxisEvol->setTitle('Nom Produit');
        $chart->getOptions()->setVAxes([$vAxisAmount, $vAxisEvol]);

        $seriesAmount = new \CMEN\GoogleChartsBundle\GoogleCharts\Options\ComboChart\Series();
        $seriesAmount->setType('bars');
        $seriesAmount->setTargetAxisIndex(0);
        $seriesEvol = new \CMEN\GoogleChartsBundle\GoogleCharts\Options\ComboChart\Series();
        $seriesEvol->setType('line');
        $seriesEvol->setTargetAxisIndex(1);
        $chart->getOptions()->setSeries([$seriesAmount, $seriesEvol]);

        $chart->getOptions()->getHAxis()->setTitle('Produits');
        $chart->getOptions()->setColors(['#f6dc12', '#759e1a']);

        return $chart;
    }
}