<?php
/**
 * Created by PhpStorm.
 * User: escobar
 * Date: 09/02/2018
 * Time: 09:42
 */

namespace CupCakesBundle\Controller;
use CupCakesBundle\Entity\CategorieRec;
use CupCakesBundle\Entity\Note;
use CupCakesBundle\Entity\Recette;
use CupCakesBundle\Form\RecetteType;
use CupCakesBundle\Form\RecetteUpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;



class RecetteController extends Controller
{
    public function ListeMesRecetteClientAction()
    {
        $em=$this->getDoctrine()->getManager();
        $recettes=$em->getRepository(Recette::class)->findByidUser($this->getUser());
            return $this->render('CupCakesBundle:Client/Recette:MesRecetteList.html.twig', array(
            'recettes'=>$recettes));

    }

    public function ListeMesRecetteFormateurAction()
    {
        $em=$this->getDoctrine()->getManager();
        $recettes=$em->getRepository(Recette::class)->findByidUser($this->getUser());
        return $this->render('CupCakesBundle:Formateur/Recette:RecetteList.html.twig', array(
            'recettes'=>$recettes));
    }

    public function ListeMesRecettePatisserieAction()
    {
        $em=$this->getDoctrine()->getManager();
        $recettes=$em->getRepository(Recette::class)->findByidUser($this->getUser());
        return $this->render('CupCakesBundle:Patisserie/Recette:RecetteList.html.twig', array(
            'recettes'=>$recettes));
    }


    public function ModifierClientRecetteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($id);
        $form=$this->createForm(RecetteUpdateType::class,$recette);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            //Mettre a jour
            $em->flush();
            //Rederiger vers read
            $recettes =$em->getRepository(Recette::class)->findByidUser($this->getUser());
            return $this->render('CupCakesBundle:Client/Recette:MesRecetteList.html.twig', array(
                'recettes'=>$recettes));
        }
        return $this->render('CupCakesBundle:Client/Recette:RecetteUpdate.html.twig',array(
                "form"=>$form->createView(),"recette"=>$recette)
        );
    }

    public function SupprimerClientRecetteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($id);
        $recette->setEtatRec('non');
        $em->flush();
        //Rederiger vers read
        $recettes =$em->getRepository(Recette::class)->findByidUser($this->getUser());
            return $this->render('CupCakesBundle:Client/Recette:MesRecetteList.html.twig', array(
                'recettes'=>$recettes));
    }

    public function SupprimerFormateurRecetteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($id);
        $recette->setEtatRec('non');
        $em->flush();
        //Rederiger vers read
        $recettes =$em->getRepository(Recette::class)->findByidUser($this->getUser());
        return $this->render('CupCakesBundle:Formateur/Recette:RecetteList.html.twig', array(
            'recettes'=>$recettes));
    }

    public function SupprimerPatisserieRecetteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($id);
        $recette->setEtatRec('non');
        $em->flush();
        //Rederiger vers read
        $recettes =$em->getRepository(Recette::class)->findByidUser($this->getUser());
        return $this->render('CupCakesBundle:Patisserie/Recette:RecetteList.html.twig', array(
            'recettes'=>$recettes));
    }


    public function ReadAllRecetteClientAction()
    {
        $em=$this->getDoctrine()->getManager();
        $categorieRec = $em->getRepository(CategorieRec::class)->findAll();
            $recettes=$em->getRepository(Recette::class)->findAll();
            return $this->render('CupCakesBundle:Client/Recette:RecetteListe.html.twig',array(
                'recettes'=>$recettes,'categorieRec'=>$categorieRec));
    }

    //read lel formateur
    public function ReadAllRecetteFormateurAction()
    {
        $em=$this->getDoctrine()->getManager();
        $categorieRec = $em->getRepository(CategorieRec::class)->findAll();
        $recettes=$em->getRepository(Recette::class)->findAll();
        return $this->render('CupCakesBundle:Formateur/Recette:ListesRecette.html.twig',array(
            'recettes'=>$recettes,'categorieRec'=>$categorieRec));
    }

    public function ReadAllRecettePatisserieAction()
    {
        $em=$this->getDoctrine()->getManager();
        $categorieRec = $em->getRepository(CategorieRec::class)->findAll();
        $recettes=$em->getRepository(Recette::class)->findAll();
        return $this->render('CupCakesBundle:Patisserie/Recette:ListesRecette.html.twig',array(
            'recettes'=>$recettes,'categorieRec'=>$categorieRec));
    }

    public function RecetteSingleClientAction(Request $request,$id)
    {
        $thread = $this->container->get('fos_comment.manager.thread')->findThreadById($id);
        if (null === $thread) {
            $thread = $this->container->get('fos_comment.manager.thread')->createThread();
            $thread->setId($id);
            $thread->setPermalink($request->getUri());
            // Add the thread
            $this->container->get('fos_comment.manager.thread')->saveThread($thread);
        }
        $comments = $this->container->get('fos_comment.manager.comment')->findCommentTreeByThread($thread);
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($id);
        $note=$em->getRepository(Note::class)->findNote($this->getUser(),$recette);
        $avgNote=0;
        $avgNote = $em->getRepository(Note::class)->avgNote($recette) ;
        $categorieRec = $em->getRepository(CategorieRec::class)->findAll();
            return $this->render('CupCakesBundle:Client/Recette:RecetteSingle.html.twig',array(
                "recette"=>$recette ,
                'categorieRec'=>$categorieRec,
                'comments' => $comments,
                'thread' => $thread,
                'note' =>$note,
                'avgNote' =>$avgNote));
    }

    public function UpdateRecettePatisserieAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($id);
        $form=$this->createForm(RecetteUpdateType::class,$recette);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {

            //Mettre a jour
            $em->flush();
            //Rederiger vers read
            $recettes =$em->getRepository(Recette::class)->findByidUser($this->getUser());
            return $this->render('CupCakesBundle:Patisserie/Recette:RecetteList.html.twig', array(
                'recettes'=>$recettes));
        }
        return $this->render('CupCakesBundle:Patisserie/Recette:RecetteUpdate.html.twig',array(
        "form"=>$form->createView(),"recette"=>$recette)
        );
    }

    public function UpdateRecetteFormateurAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($id);
        $form=$this->createForm(RecetteUpdateType::class,$recette);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {

            //Mettre a jour
            $em->flush();
            //Rederiger vers read
            $recettes =$em->getRepository(Recette::class)->findByidUser($this->getUser());
            return $this->render('CupCakesBundle:Formateur/Recette:RecetteList.html.twig', array(
                'recettes'=>$recettes));
        }
        return $this->render('CupCakesBundle:Formateur/Recette:RecetteUpdate.html.twig',array(
                "form"=>$form->createView(),"recette"=>$recette)
        );
    }


    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }

    public function AddRecettePatisserieAction(Request $request)
    {
        $recette = new Recette();
        $form=$this->createForm(RecetteType::class,$recette);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $file = $recette->getImageRec();

            $filename = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('brochures_directoryrecette'),$filename
            );
            $recette->setImageRec($filename);
            $recette->setIdUser($this->getUser())
                ->setDateRec(new \Datetime());
            $em=$this->getDoctrine()->getManager();
            $em->persist($recette);
            $em->flush();
            $recettes =$em->getRepository(Recette::class)->findByidUser($this->getUser());
            return $this->render('CupCakesBundle:Patisserie/Recette:RecetteList.html.twig', array(
                'recettes'=>$recettes));
        }
        return $this->render('CupCakesBundle:Patisserie/Recette:RecetteAdd.html.twig', array(
            "form"=>$form->createView()));
    }

    public function AjouterClientRecetteAction(Request $request)
    {
        $recette = new Recette();
        $form=$this->createForm(RecetteType::class,$recette);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $file = $recette->getImageRec();

            $filename = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('brochures_directoryrecette'),$filename
            );
            $recette->setImageRec($filename);
            $recette->setIdUser($this->getUser())
                ->setDateRec(new \Datetime());
            $em=$this->getDoctrine()->getManager();
            $em->persist($recette);
            $em->flush();
            $recettes =$em->getRepository(Recette::class)->findByidUser($this->getUser());
            return $this->render('CupCakesBundle:Client/Recette:MesRecetteList.html.twig', array(
                'recettes'=>$recettes));
        }
        return $this->render('CupCakesBundle:Client/Recette:RecetteClientAdd.html.twig', array(
            "form"=>$form->createView()));
    }

    public function AjouterFormateurRecetteAction(Request $request)
    {
        $recette = new Recette();
        $form=$this->createForm(RecetteType::class,$recette);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $file = $recette->getImageRec();

            $filename = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('brochures_directoryrecette'),$filename
            );
            $recette->setImageRec($filename);
            $recette->setIdUser($this->getUser())
                ->setDateRec(new \Datetime());
            $em=$this->getDoctrine()->getManager();
            $em->persist($recette);
            $em->flush();
            $recettes =$em->getRepository(Recette::class)->findByidUser($this->getUser());
            return $this->render('CupCakesBundle:Formateur/Recette:RecetteList.html.twig', array(
                'recettes'=>$recettes));
        }
        return $this->render('CupCakesBundle:Formateur/Recette:RecetteAdd.html.twig', array(
            "form"=>$form->createView()));
    }


    public function RecupererClientRecetteAction()
    {
        $em=$this->getDoctrine()->getManager();
        $recettes=$em->getRepository(Recette::class)->findByidUser($this->getUser());
            return $this->render('CupCakesBundle:Client/Recette:RecupererMesRecetteList.html.twig', array(
                'recettes'=>$recettes));
    }

    public function RestaurerPatisserieRecetteAction($type,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($id);
        $recette->setEtatRec('oui');
        $em->flush();
        //Rederiger vers read
        $recettes =$em->getRepository(Recette::class)->findByidUser($this->getUser());
        if($type == "client")
            return $this->render('CupCakesBundle:Client/Recette:MesRecetteList.html.twig', array(
                'recettes'=>$recettes));
        else if ($type == "patisserie")
            return $this->render('CupCakesBundle:Patisserie/Recette:RecetteList.html.twig', array(
                'recettes'=>$recettes));
        else
            return $this->render('CupCakesBundle:Client/Recette:MesRecetteList.html.twig', array(
                'recettes'=>$recettes));
    }

    public function RechercheRecetteAction(Request $request)
    {
        $search =$request->query->get('recherche');
        $em = $this->getDoctrine()->getManager();
        $categorieRec = $em->getRepository(CategorieRec::class)->findAll();
        $recettes=$em->getRepository(Recette::class)->findAll();
        if($request->isXmlHttpRequest())
        {
            $serializer = new Serializer(array(new ObjectNormalizer()));
            $recettes=$em->getRepository(Recette::class)->findNom($search);
            $data=$serializer->normalize(($recettes));
            return new JsonResponse($data);
        }

        return $this->render('CupCakesBundle:Client/Recette:RecetteListe.html.twig',array(
            'recettes'=>$recettes,'categorieRec'=>$categorieRec));
    }

    public function RecetteSingleFormateurAction(Request $request,$id)
    {
        $thread = $this->container->get('fos_comment.manager.thread')->findThreadById($id);
        if (null === $thread) {
            $thread = $this->container->get('fos_comment.manager.thread')->createThread();
            $thread->setId($id);
            $thread->setPermalink($request->getUri());
            // Add the thread
            $this->container->get('fos_comment.manager.thread')->saveThread($thread);
        }
        $comments = $this->container->get('fos_comment.manager.comment')->findCommentTreeByThread($thread);
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($id);
        $note=$em->getRepository(Note::class)->findNote($this->getUser(),$recette);
        $avgNote=0;
        $avgNote = $em->getRepository(Note::class)->avgNote($recette) ;
        $categorieRec = $em->getRepository(CategorieRec::class)->findAll();
        return $this->render('CupCakesBundle:Formateur/Recette:RecetteSingleF.html.twig',array(
            "recette"=>$recette ,
            'categorieRec'=>$categorieRec,
            'comments' => $comments,
            'thread' => $thread,
            'note' =>$note,
            'avgNote' =>$avgNote));
    }

    public function ModifierPatisserieRecetteAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($id);
        $form=$this->createForm(RecetteUpdateType::class,$recette);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            //Mettre a jour
            $em->flush();
            //Rederiger vers read
            $recettes =$em->getRepository(Recette::class)->findByidUser($this->getUser());
            return $this->render('CupCakesBundle:Patisserie/Recette:ListesRecette.html.twig', array(
                'recettes'=>$recettes));
        }
        return $this->render('CupCakesBundle:Patisserie/Recette:RecetteUpdate.html.twig',array(
                "form"=>$form->createView(),"recette"=>$recette)
        );
    }

    public function AjouterPatisserieRecetteAction(Request $request)
    {
        $recette = new Recette();
        $form=$this->createForm(RecetteType::class,$recette);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $file = $recette->getImageRec();

            $filename = $this->generateUniqueFileName().'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('brochures_directoryrecette'),$filename
            );
            $recette->setImageRec($filename);
            $recette->setIdUser($this->getUser())
                ->setDateRec(new \Datetime());
            $em=$this->getDoctrine()->getManager();
            $em->persist($recette);
            $em->flush();
            $recettes =$em->getRepository(Recette::class)->findByidUser($this->getUser());
            return $this->render('CupCakesBundle:Patisserie/Recette:ListesRecette.html.twig', array(
                'recettes'=>$recettes));
        }
        return $this->render('CupCakesBundle:Patisserie/Recette:RecetteAdd.html.twig', array(
            "form"=>$form->createView()));
    }


    public function RecetteSinglePatisserieAction(Request $request,$id)
    {
        $thread = $this->container->get('fos_comment.manager.thread')->findThreadById($id);
        if (null === $thread) {
            $thread = $this->container->get('fos_comment.manager.thread')->createThread();
            $thread->setId($id);
            $thread->setPermalink($request->getUri());
            // Add the thread
            $this->container->get('fos_comment.manager.thread')->saveThread($thread);
        }
        $comments = $this->container->get('fos_comment.manager.comment')->findCommentTreeByThread($thread);
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($id);
        $note=$em->getRepository(Note::class)->findNote($this->getUser(),$recette);
        $avgNote=0;
        $avgNote = $em->getRepository(Note::class)->avgNote($recette) ;
        $categorieRec = $em->getRepository(CategorieRec::class)->findAll();
        return $this->render('CupCakesBundle:Patisserie/Recette:RecetteSingleF.html.twig',array(
            "recette"=>$recette ,
            'categorieRec'=>$categorieRec,
            'comments' => $comments,
            'thread' => $thread,
            'note' =>$note,
            'avgNote' =>$avgNote));
    }

}