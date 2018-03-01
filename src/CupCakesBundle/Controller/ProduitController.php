<?php
/**
 * Created by PhpStorm.
 * User: escobar
 * Date: 09/02/2018
 * Time: 01:59
 */

namespace CupCakesBundle\Controller;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\BarChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\Histogram;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CupCakesBundle\Entity\Categorie;
use CupCakesBundle\Entity\Produit;
use CupCakesBundle\Form\ProduitType;
use CupCakesBundle\Form\UpdateType;
use Money\Currency;
use Money\CurrencyPair;
use Money\Money;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ProduitController extends Controller
{

    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }
    public  function aaAction(){
        $fiveEur = Money::EUR(100);
        $tnd = Money::TND(100);
        $tenEur = $fiveEur->add($fiveEur);
        //$tenEur = $fiveEur->add($tnd);
        list($part1, $part2, $part3) = $tenEur->allocate(array(1, 1, 1));
        //assert($part1->equals(Money::EUR(334)));
        //assert($part2->equals(Money::EUR(333)));
        //assert($part3->equals(Money::EUR(333)));

        $pair = new CurrencyPair(new Currency('EUR'), new Currency('TND'), 1.5);
        //$pair = new CurrencyPair(new Currency('TND'), new Currency('EUR'), 1.5);
        $usd = $pair->convert($tenEur);
        //$this->assertEquals(Money::USD(1250), $usd);

        return $this->render('@CupCakes/Client/Produit/mony.html.twig',['usd'=>$usd,'euro'=>$fiveEur,'tnd'=>$tnd]);
    }
    public function create_ProduitAction(Request $request)
    {

        $produit = new Produit();
        $form=$this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();
            $produit->setIdUser($this->getUser());
            $file = $produit->getImageProd();

            $filename = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('brochures_directory'),$filename
            );
            $produit->setImageProd($filename);
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute("read_produit");
        }
        return $this->render('CupCakesBundle:Patisserie/Produit:CreateProduit.html.twig', array(
            "form"=>$form->createView()
        ));
    }
    public function read_produitAction()
    {
        $produit=new Produit();
        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository(Produit::class)->findByetatuser($this->getUser());
        return $this->render('CupCakesBundle:Patisserie/Produit:readProduit.html.twig', array(
            'produits'=>$produit
        ));
    }
    public function update_ProduitAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository(Produit::class)->find($id);
        $form=$this->createForm(UpdateType::class,$produit);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em->flush();

            return $this->redirectToRoute('read_produit');

        }

        return $this->render('CupCakesBundle:Patisserie/Produit:UpdateProduit.html.twig', array(
            "form"=>$form->createView()
        ));



    }

    public function ListeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository(Produit::class)->findByetat();
        $categories= $em->getRepository(Categorie::class)->findAll();

        $prods= array();
        foreach ($produits as $produit){
            $euro = Money::EUR( $produit->getPrixProd()*100 );
            //$tnd = Money::TND(100);
            $tenEur = $euro->add($euro);
            //$tenEur = $fiveEur->add($tnd);
            list($part1, $part2, $part3) = $tenEur->allocate(array(1, 1, 1));
            //assert($part1->equals(Money::EUR(334)));
            //assert($part2->equals(Money::EUR(333)));
            //assert($part3->equals(Money::EUR(333)));

            $pair = new CurrencyPair(new Currency('EUR'), new Currency('TND'), 1.5);
            $pair1 = new CurrencyPair(new Currency('EUR'), new Currency('USD'), 0.6199);
            $TND = $pair->convert($tenEur);
            $USD = $pair1->convert($tenEur);
            $produit->setTnd($TND);
            $produit->setEuro($euro);
            $produit->setUsd($USD);
            array_push($prods,$produit);
        }
        return $this->render('CupCakesBundle:Client/Produit:ListeProd.html.twig',array("produits"=>$prods,'categories'=>$categories));

    }

    public function ProddetAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository(Produit::class)->find($id);
        $produits=$em->getRepository(Produit::class)->findAll();
        $prods= array();
        $euro = Money::EUR($produit->getPrixProd()*100);
        //$tnd = Money::TND(100);
        $tenEur = $euro->add($euro);
        //$tenEur = $fiveEur->add($tnd);
        list($part1, $part2, $part3) = $tenEur->allocate(array(1, 1, 1));
        //assert($part1->equals(Money::EUR(334)));
        //assert($part2->equals(Money::EUR(333)));
        //assert($part3->equals(Money::EUR(333)));

        $pair = new CurrencyPair(new Currency('EUR'), new Currency('TND'), 1.5);
        $pair1 = new CurrencyPair(new Currency('EUR'), new Currency('USD'), 0.6199);
        $TND = $pair->convert($tenEur);
        $USD = $pair1->convert($tenEur);
        $produit->setTnd($TND);
        $produit->setEuro($euro);
        $produit->setUsd($USD);
        array_push($prods,$produit);
        $produit->setValeur($produit->getValeur()+1);
        $em->flush();
        return $this->render('CupCakesBundle:Client/Produit:ProduitSingle.html.twig',array("produit"=>$produit,"produits"=>$produits));

    }
    public function ListeCategorieAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository(Produit::class)->findByQteStockProd(0);
        if(is_array($produits))
        {
            foreach ($produits as $produit) {
                $em->remove($produit);
                $em->flush();
            }
        }else{

        }

        $categories= $em->getRepository(Categorie::class)->findAll();
        if($id == 0)
            $produits=$em->getRepository(Produit::class)->findAll();
        else
            $produits=$em->getRepository(Produit::class)->findByidCat($id); //tzid etat oui m3a categorie
        $prods= array();
        foreach ($produits as $produit){
            $euro = Money::EUR($produit->getPrixProd()*100);
            //$tnd = Money::TND(100);
            $tenEur = $euro->add($euro);
            //$tenEur = $fiveEur->add($tnd);
            list($part1, $part2, $part3) = $tenEur->allocate(array(1, 1, 1));
            //assert($part1->equals(Money::EUR(334)));
            //assert($part2->equals(Money::EUR(333)));
            //assert($part3->equals(Money::EUR(333)));

            $pair = new CurrencyPair(new Currency('EUR'), new Currency('TND'), 1.5);
            $pair1 = new CurrencyPair(new Currency('EUR'), new Currency('USD'), 0.6199);
            $TND = $pair->convert($tenEur);
            $USD = $pair1->convert($tenEur);
            $produit->setTnd($TND);
            $produit->setEuro($euro);
            $produit->setUsd($USD);
            array_push($prods,$produit);
        }
        return $this->render('CupCakesBundle:Client/Produit:ListeProd.html.twig',array(
            'produits'=>$produits,'categories'=>$categories));

    }
    public function indexAction()
    {
        $em= $this->getDoctrine()->getManager();
        $produits=$em->getRepository("CupCakesBundle:Produit")->findAll();

        $views=array();
        $names=array();

        foreach ($produits as $produit)
        {
            array_push($names,$produit->getNomProd());
            array_push($views,$produit->getValeur());

        }
        $bar=new BarChart();
        $bar->getData()->setArrayToDataTable([
            $names, $views
        ]);
        $bar->getOptions()->setTitle('Avis sur les produits');
        $bar->getOptions()->getVAxis()->setTitle('Noms des produits');
        $bar->getOptions()->getHAxis()->setTitle('Avis');

        $bar->getOptions()->setWidth(900);
        $bar->getOptions()->setHeight(600);

        return $this->render('CupCakesBundle:Patisserie/Produit:stat.html.twig', array('barchart' =>$bar));
    }
    public function Recherche_ProduitAction(Request $request)
    {
        $search =$request->get('produit');
        $en = $this->getDoctrine()->getManager();
        $produit=$en->getRepository("CupCakesBundle:Produit")->findByetatuserNom($this->getUser(),$search);
        return $this->render("CupCakesBundle:Patisserie/Produit:readProduit.html.twig",array(
            'produits' => $produit
        ));
    }
    public function Recherche_Produit1Action(Request $request)
    {
        $search =$request->query->get('recherche');
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Categorie::class)->findAll();
        $produits=$em->getRepository(Produit::class)->findAll();
        if($request->isXmlHttpRequest())
        {
            $serializer = new Serializer(array(new ObjectNormalizer()));
            $produits=$em->getRepository(Produit::class)->findNomProduit($search);
            $data=$serializer->normalize(($produits));
            return new JsonResponse($data);
        }
        return $this->render('CupCakesBundle:Client/Produit:ListeProd.html.twig',array(
            'produits'=>$produits,'categories'=>$categories));

    }
    public function SupprimerProduitAction($id){
        $em=$this->getDoctrine()->getManager();
        $produit=$em->getRepository(Produit::class)->find($id);
        $produit->setEtatProd("Faux");
        $em->flush();
        return $this->redirectToRoute('read_produit');

    }
}