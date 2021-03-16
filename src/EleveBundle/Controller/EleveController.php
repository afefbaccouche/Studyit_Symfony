<?php

namespace EleveBundle\Controller;

use ClassBundle\Entity\Classe;
use ClassBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EleveController extends Controller
{
    public function findElevesAction()
    {
        $em = $this->getDoctrine();
        $eleves = $em->getRepository(User::class)->findBy(array("role" => "ELEVE"));
        $data = $this->get('jms_serializer')->serialize($eleves, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function deleteEleveAction(Request $request)
    {
        $idUser = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $eleve = $em->getRepository(User::class)->find($idUser);
        if ($eleve != null) {
            $em->remove($eleve);
            $em->flush();
            return new JsonResponse(["msg" => "deleted with success"], 200);
        } else {
            return new JsonResponse(["msg" => "Il n'y a pas d'eleve avec cet id "], 400);
        }
    }

    public function updateEleveAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $eleve = $em->getRepository(User::class)->find($id);
        $data = $request->getContent();
        $newdata = $this->get('jms_serializer')->deserialize($data, 'ClassBundle\Entity\User', 'json');
        $eleve->setUsername($newdata->getUsername());
        $eleve->setEmail($newdata->getEmail());
        $eleve->setPassword($newdata->getPassword());
        $eleve->setTelephone($newdata->getTelephone());
        $eleve->setDatenaissance($newdata->getDatenaissance());
        $eleve->setDateinscription($newdata->getDateinscription());
        $eleve->setStatus($newdata->isStatus());
        $eleve->setNomparent($newdata->getNomparent());
        $em->persist($eleve);
        $em->flush();
        return new JsonResponse(["msg" => "success"], 200);
    }

    public function findEleveByIdAction(User $eleve)
    {
        $data = $this->get('jms_serializer')->serialize($eleve, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function ajoutEleveAction(Request $request)
    {
        $data = $request->getContent();
        $eleve = $this->get('jms_serializer')->deserialize($data, 'ClassBundle\Entity\User', 'json');
        $eleve->setRole("ELEVE");
        $em = $this->getDoctrine()->getManager();
        $em->persist($eleve);
        $em->flush();
        return new Response('élève ajouté avec succès');
    }
}
