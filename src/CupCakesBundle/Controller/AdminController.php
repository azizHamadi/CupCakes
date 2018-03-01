<?php

namespace CupCakesBundle\Controller;

use CupCakesBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('CupCakesBundle:Admin:LayoutA.html.twig');
    }

    public function readUserAction()
    {
        $em=$this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findAll();
        return $this->render('CupCakesBundle:Admin/GestionUsers:UserList.html.twig',array(
                'users'=>$users));

    }

    public function deleteUserAction($id,$etat)
    {
        $em=$this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        if($etat == "true")
            $user->setEnabled(1);
        else
            $user->setEnabled(0);
        $em->flush();
        $users = $em->getRepository(User::class)->findAll();
        return $this->redirectToRoute('cup_cakes_ListAdmin');
    }
}
