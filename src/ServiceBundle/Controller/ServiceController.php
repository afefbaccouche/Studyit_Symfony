<?php

namespace ServiceBundle\Controller;

use ServiceBundle\Entity\services;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\Tests\Service;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    public function addServiceAction(Request $request)
    {
        //récupérer le contenu de la requête envoyé par l'outil postman
        $data=$request->getContent();
        //deserialize data: création d'un objet 'livre' à partir des données json envoyées
        $service=$this->get('jms_serializer')->deserialize($data,'ServiceBundle\Entity\services','json');
        //ajout dans la base
        $em=$this->getDoctrine()->getManager();
        $em->persist($service);
        $em->flush();
        return new Response('Service ajouté avec succès');
    }

    public function getAllServicesAction()
    {
        $em=$this->getDoctrine()->getManager();
        $services=$em->getRepository(services::class)->findAll();
        $data=$this->get('jms_serializer')->serialize($services,'json');
        $response=new Response($data);
        return $response;
    }

    public function getServiceAction(services $service)
    {
        $data=$this->get('jms_serializer')->serialize($service,'json');
        $response=new Response($data);
        return $response;
    }

    public function updateServiceAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $service=$em->getRepository(services::class)->find($id);
        $data=$request->getContent();
        $newdata=$this->get('jms_serializer')->deserialize($data,'ServiceBundle\Entity\services','json');
        $service->setType($newdata->getType());
        $service->setTarif($newdata->getTarif());
        $em->persist($service);
        $em->flush();
        return new JsonResponse(["msg"=>"success"],200);
    }

    public function deleteServiceAction(Request $request)
    {
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $service=$em->getRepository(services::class)->find($id);
        $em->remove($service);
        $em->flush();
        return new JsonResponse(["msg"=>"deleted with success"],200);
    }


}
