<?php

namespace ClassBundle\Controller;

use ClassBundle\Entity\ProfClass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Profclass controller.
 *
 */
class ProfClassController extends Controller
{
    /**
     * Lists all profClass entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $profClasses = $em->getRepository('ClassBundle:ProfClass')->findAll();

        $data = $this->get('jms_serializer')->serialize($profClasses, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Creates a new profClass entity.
     *
     */
    public function newAction(Request $request)
    {
        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $prof = $em->getRepository("ClassBundle:User")->find($input["idUser"]);
        $classe = $em->getRepository("ClassBundle:Classe")->find($input["idClasse"]);

        $profClass = new Profclass();
        $profClass->setIdclasse($classe);
        $profClass->setIdprof($prof);
        $em->persist($profClass);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($profClass, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Finds and displays a profClass entity.
     *
     */
    public function showAction(ProfClass $profClass)
    {
        $data = $this->get('jms_serializer')->serialize($profClass, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Displays a form to edit an existing profClass entity.
     *
     */
    public function editAction(Request $request)
    {
        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $profClass = $em->getRepository("ClassBundle:Profclass")->find($input["id"]);
        $prof = $em->getRepository("ClassBundle:User")->find($input["idUser"]);
        $classe = $em->getRepository("ClassBundle:Classe")->find($input["idClasse"]);

        $profClass->setIdclasse($classe);
        $profClass->setIdprof($prof);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($profClass, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Deletes a profClass entity.
     *
     */
    public function deleteAction(Request $request, ProfClass $profClass)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($profClass);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($profClass, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
