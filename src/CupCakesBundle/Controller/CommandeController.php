<?php
/**
 * Created by PhpStorm.
 * User: escobar
 * Date: 09/02/2018
 * Time: 01:31
 */

namespace CupCakesBundle\Controller;
use CupCakesBundle\Entity\Commande;
use CupCakesBundle\Entity\LineCmd;
use CupCakesBundle\Entity\Produit;
use CupCakesBundle\Form\CommandeType;
use CupCakesBundle\Form\LineCmdType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class CommandeController extends Controller
{

    public function  AjouterPanierAction($id , SessionInterface $session, Request $request){


        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');


        if (is_array($panier) && array_key_exists($id, $panier)) {
            if ($request->query->get('qte') != null) $panier[$id] = $request->query->get('qte');
        } else {
            if ($request->query->get('qte') != null)
                $panier[$id] = $request->query->get('qte');
            else
                $panier[$id] = 1;

        }

        $session->set('panier',$panier);


        return $this->redirect($this->generateUrl('AfficherPanier'));

    }

    public function SupprimerPanierAction($id , Request $request){
        $session = $request->getSession();
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier))
        {
            unset($panier[$id]);
            $session->set('panier',$panier);
        }
        return $this->redirect($this->generateUrl('AfficherPanier'));

    }



    public function ValiderPanierAction(Request $request,$total,SessionInterface $session)
    {
        if (!$session->has('panier')) $session->set('panier', array());

        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('CupCakesBundle:Produit')->findArray(array_keys($session->get('panier')));
        $commande = new Commande();
        $em=$this->getDoctrine()->getManager();
        if ($request->isMethod("POST")){
            $commande->setDateCmd(new \DateTime())
                ->setMontantCmd($total)
                ->setIdUser($this->getUser())
            ->setDateLivCmd(new \DateTime($request->get("Dateliv")))
            ->setAdresseLi($request->get("addLiv"));
            $em->persist($commande);
            $em->flush();
           return $this->redirectToRoute("AjouterLine");

        }

        return $this->render('CupCakesBundle:Client/Commande:Commande.html.twig' , array('Commandes'=>$commande,'produits' => $produit,
            'panier'=> $session->get('panier')));

    }

    public function AjouterLineAction(Request $request,SessionInterface $session){

        if (!$session->has('panier')) $session->set('panier', array());
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('CupCakesBundle:Produit')->findArray(array_keys($session->get('panier')));
        $cmd=$em->getRepository(Commande::class)->findMax();
        $line = new LineCmd();

        if ($request->isMethod("POST")) {

        foreach ($produit as $p){
            $line = new LineCmd();
                $line->setQteAcheter($request->get("Qte"))
                    ->setIdCmd($em->getRepository(Commande::class)->find($cmd->getId()))
                    ->setIdProd($em->getRepository(Produit::class)->find($p));
                $em->persist($line);
                $em->flush();

                $newQte =($em->getRepository(Produit::class)->find($p)->getQteStockProd() - $line->getQteAcheter());
                $produp=$em->getRepository(Produit::class)->find($p);
                $produp->setQteStockProd($newQte);
                $em->flush();
            }
            return $this->redirectToRoute("CommandeSuivie");
        }
       //

        return $this->render('CupCakesBundle:Client/Commande:Line.html.twig' , array('lines'=>$line,'produits' => $produit,
            'panier'=> $session->get('panier')));
    }

    public function SupprimerCmdAction($id){
        $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository(Commande::class)->find($id);
        $commande->setEtatCmd("Faux");
            $em->flush();
            return $this->redirectToRoute('CommandeListePatisserie');

    }

    public function PatisserieListeAction()
    {
        $commande = $this->getDoctrine()->getRepository("CupCakesBundle:Commande")->rechercheId($this->getUser()->getid());
        return $this->render('CupCakesBundle:Patisserie/Commande:ListeCommande.html.twig' , ['Commandes'=>$commande]);

    }

    public function SuivieAction()
    {
        $linecmd= $this->getDoctrine()->getRepository("CupCakesBundle:LineCmd")->findcomm($this->getUser()->getid());
        return $this->render('CupCakesBundle:Client/Commande:Suivie.html.twig' , ['LineCmd'=>$linecmd]);
    }

    public function listeAction(SessionInterface $session)
    {
        if (!$session->has('panier')) $session->set('panier', array());

        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('CupCakesBundle:Produit')->findArray(array_keys($session->get('panier')));

        return $this->render('CupCakesBundle:Client/Commande:ListeCommande.html.twig', ['produits' => $produit,
            'panier' => $session->get('panier')]);


    }

    public function UpdateEtatLivraisonAction (Request $request,$id){
        $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository(Commande::class)->find($id);
        $form=$this->createForm(CommandeType::class,$commande);
        $form->handleRequest($request);
        if ($form->isSubmitted()){

            $em->flush();
            return $this->redirectToRoute('CommandeListePatisserie');
        }
        return $this->render('CupCakesBundle:Patisserie/Commande:Update.html.twig' , ['Commande'=>$commande,'form'=>$form->createView()]);

    }

    public function PDFFactureAction($id){
        $em=$this->getDoctrine()->getManager();
        $linecmd=$em->getRepository(LineCmd::class)->Com($id);
        $html = $this->renderView('CupCakesBundle:Client/Commande:PDF.html.twig' , ['LineCmd'=>$linecmd]);

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="file.pdf"'
            ));
    }

    public function RechercheAction(Request $request)
    {
        $search =$request->query->get('username');
        $en = $this->getDoctrine()->getManager();
        $commandes=$en->getRepository("CupCakesBundle:Commande")->findUsername($search);
        return $this->render('CupCakesBundle:Patisserie/Commande:ListeCommande.html.twig',array(
            'Commandes' => $commandes
        ));
    }
}