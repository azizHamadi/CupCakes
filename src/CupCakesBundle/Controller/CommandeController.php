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
use Symfony\Component\HttpFoundation\Session\SessionInterface;


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
            ->setDateLivCmd(new \DateTime($request->get("Dateliv")));
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
        if ($request->isMethod("POST")){
            $line->setQteAcheter($request->get("Qte"))
                    ->setIdProd($em->getRepository(Produit::class)->find($request->get("idProd")))
                    ->setIdCmd($em->getRepository(Commande::class)->find($cmd->getId()));
            $em->persist($line);
            $em->flush();

            return $this->redirectToRoute("CommandeSuivie");

        }
        return $this->render('CupCakesBundle:Client/Commande:Line.html.twig' , array('lines'=>$line,'produits' => $produit,
            'panier'=> $session->get('panier')));
    }

    public function PatisserieListeAction()
    {
        $commande = $this->getDoctrine()->getRepository("CupCakesBundle:Commande")->findAll();
        return $this->render('CupCakesBundle:Patisserie/Commande:ListeCommande.html.twig' , ['Commandes'=>$commande]);

    }

    public function SuivieAction()
    {
        return $this->render('CupCakesBundle:Client/Commande:Suivie.html.twig');
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
        if ($request->isMethod("POST")){
            $commande->setEtatLivCmd($request->get("Etatliv"));

            $em->flush();
            return $this->redirectToRoute('CommandeListePatisserie');
        }
        return $this->render('CupCakesBundle:Patisserie/Commande:Update.html.twig' , ['Commande'=>$commande]);

    }


}