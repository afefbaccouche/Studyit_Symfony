<?php

namespace ClassBundle\Controller;

use ClassBundle\Entity\Classe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Classe controller.
 *
 */
class ClasseController extends Controller
{
    /**
     * Lists all classe entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $classes = $em->getRepository('ClassBundle:Classe')->findAll();
        $data = $this->get('jms_serializer')->serialize($classes, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Creates a new classe entity.
     *
     */
    public function newAction(Request $request)
    {
        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $niveau = $em->getRepository("ClassBundle:Niveau")->find($input["idNiveau"]);
        $user = $em->getRepository("ClassBundle:User")->find($input["idUser"]);

        $classe = new Classe();
        $classe->setClassname($input['classename']);
        $classe->setCapacite($input['capacite']);
        $classe->setIdniveau($niveau);
        $classe->setIduser($user);
        $em->persist($classe);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($classe, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Finds and displays a classe entity.
     *
     */
    public function showAction(Classe $classe)
    {
        $data = $this->get('jms_serializer')->serialize($classe, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Displays a form to edit an existing classe entity.
     *
     */
    public function editAction(Request $request)
    {

        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();

        $classe = $em->getRepository("ClassBundle:Classe")->find($input["id"]);
        $niveau = $em->getRepository("ClassBundle:Niveau")->find($input["idNiveau"]);
        $user = $em->getRepository("ClassBundle:User")->find($input["idUser"]);

        $classe->setClassname($input['classename']);
        $classe->setCapacite($input['capacite']);
        $classe->setIdniveau($niveau);
        $classe->setIduser($user);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($classe, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Deletes a classe entity.
     *
     */
    public function deleteAction(Request $request, Classe $classe)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($classe);
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($classe->getClassname() . " is deleted", 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


}
