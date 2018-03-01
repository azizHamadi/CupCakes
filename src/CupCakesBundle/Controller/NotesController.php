<?php

namespace CupCakesBundle\Controller;

use CupCakesBundle\Entity\Note;
use CupCakesBundle\Entity\Recette;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;

class NotesController extends Controller
{
    public function CreateRatingAction(Request $request,$note,$idRec)
    {
        $notes=new Note();
        $em=$this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($idRec);
        $notes->setIdUser($this->getUser())
            ->setDateNote(new \DateTime())
            ->setIdRec($recette)
            ->setNote($note);
        $noteT= new Note();
        $noteT = $em->getRepository(Note::class)->findNote($this->getUser(),$recette);
        if($noteT == null)
            $em->persist($notes);
        else{
            $noteT->setNote($note);
            $notes=$noteT;
            $em->persist($notes);
        }
        $em->flush();
        if($request->isXmlHttpRequest())
        {
            $serializer = new Serializer(array(new ObjectNormalizer()));
            $arrData=$serializer->normalize(($notes));
            $avgNote = $em->getRepository(Note::class)->avgNote($recette) ;
            $data = ['data' => $arrData,'notes' => $avgNote[1]];
            return new JsonResponse($data);
        }
        return $this->render(null);
    }

}
