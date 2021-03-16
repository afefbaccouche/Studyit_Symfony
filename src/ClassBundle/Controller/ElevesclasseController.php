<?php

namespace ClassBundle\Controller;

use ClassBundle\Entity\Elevesclasse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Elevesclasse controller.
 *
 */
class ElevesclasseController extends Controller
{
    /**
     * Lists all elevesclasse entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $elevesclasses = $em->getRepository('ClassBundle:Elevesclasse')->findAll();
        $data = $this->get('jms_serializer')->serialize($elevesclasses, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;    }

    /**
     * Creates a new elevesclasse entity.
     *
     */
    public function newAction(Request $request)
    {
        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $eleve = $em->getRepository("ClassBundle:User")->find($input["idUser"]);
        $classe = $em->getRepository("ClassBundle:Classe")->find($input["idClasse"]);
        $classe->setCapacite($classe->getCapacite()-1);

        $elevesclasse = new Elevesclasse();
        $elevesclasse->setIdclasse($classe);
        $elevesclasse->setIdeleve($eleve);
        $em->persist($elevesclasse);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($elevesclasse, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Finds and displays a elevesclasse entity.
     *
     */
    public function showAction(Elevesclasse $elevesclasse)
    {
        $data = $this->get('jms_serializer')->serialize($elevesclasse, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Displays a form to edit an existing elevesclasse entity.
     *
     */
    public function editAction(Request $request)
    {
        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $elevesclasse = $em->getRepository("ClassBundle:Elevesclasse")->find($input["id"]);
        $eleve = $em->getRepository("ClassBundle:User")->find($input["idUser"]);
        $classe = $em->getRepository("ClassBundle:Classe")->find($input["idClasse"]);

        $elevesclasse->setIdclasse($classe);
        $elevesclasse->setIdeleve($eleve);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($elevesclasse, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Deletes a elevesclasse entity.
     *
     */
    public function deleteAction(Request $request, Elevesclasse $elevesclasse)
    {        $em = $this->getDoctrine()->getManager();

        $data = $this->get('jms_serializer')->serialize($elevesclasse, 'json');
        $classe = $em->getRepository("ClassBundle:Classe")->find($elevesclasse->getIdclasse()->getId());
        $classe->setCapacite($classe->getCapacite()+1);

        $em->remove($elevesclasse);
        $em->flush();
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
