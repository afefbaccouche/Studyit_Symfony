<?php

namespace ClassBundle\Controller;

use ClassBundle\Entity\Niveau;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Niveau controller.
 *
 */
class NiveauController extends Controller
{
    /**
     * Lists all niveau entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $niveaus = $em->getRepository('ClassBundle:Niveau')->findAll();
        $data = $this->get('jms_serializer')->serialize($niveaus, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Creates a new niveau entity.
     *
     */
    public function newAction(Request $request)
    {
        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();


        $niveau = new Niveau();
        $niveau->setLibelle($input["libelle"]);
        $em->persist($niveau);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($niveau, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Finds and displays a niveau entity.
     *
     */
    public function showAction(Niveau $niveau)
    {
        $data = $this->get('jms_serializer')->serialize($niveau, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


    /**
     * Displays a form to edit an existing niveau entity.
     *
     */
    public function editAction(Request $request, Niveau $niveau)
    {
        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();

        $niveau->setLibelle($input["libelle"]);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($niveau, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Deletes a niveau entity.
     *
     */
    public function deleteAction(Request $request, Niveau $niveau)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($niveau);
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($niveau->getLibelle() . " deleted", 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
