<?php

namespace PaiementBundle\Controller;

use PaiementBundle\Entity\paiement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PaiementController extends Controller
{
    public function addPaiementAction(Request $request)
    {
        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $service = $em->getRepository("ServiceBundle:services")->find($input["idservice"]);
        $user = $em->getRepository("ClassBundle:User")->find($input["iduser"]);

        $paiement = new paiement();
        $paiement->setMontantpayee($input['montantpayee']);
        $paiement->setDatepaiement($input['datepaiement']);
        $paiement->setIdservice($service);
        $paiement->setIduser($user);
        $em->persist($paiement);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($paiement, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    public function getAllPaiementsAction()
    {
        $em=$this->getDoctrine()->getManager();
        $paiement=$em->getRepository(paiement::class)->findAll();
        $data=$this->get('jms_serializer')->serialize($paiement,'json');
        $response=new Response($data);
        return $response;
    }

    public function getPaiementAction(paiement $paiement)
    {
        $data=$this->get('jms_serializer')->serialize($paiement,'json');
        $response=new Response($data);
        return $response;
    }

    public function updatePaiementAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $paiement=$em->getRepository(paiement::class)->find($id);
        $data=$request->getContent();
        $newdata=$this->get('jms_serializer')->deserialize($data,'PaiementBundle\Entity\paiement','json');
        $paiement->setMontantpayee($newdata->getMontantPayee());
        $paiement->setDatePaiement($newdata->getDatePaiement());
        $paiement->setIdservice($newdata->getIdservice());
        $em->persist($paiement);
        $em->flush();
        return new JsonResponse(["msg"=>"success"],200);
    }

    public function deletePaiementAction(Request $request)
    {
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $paiement=$em->getRepository(paiement::class)->find($id);
        $em->remove($paiement);
        $em->flush();
        return new JsonResponse(["msg"=>"deleted with success"],200);
    }

}
