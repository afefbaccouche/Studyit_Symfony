<?php

namespace ProfBundle\Controller;

use ClassBundle\Entity\Niveau;
use ProfBundle\Entity\Seance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Seance controller.
 *
 */
class SeanceController extends Controller
{
    /**
     * Lists all seance entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('ProfBundle:Seance')->findAll();

        $data = $this->get('jms_serializer')->serialize($seances, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Creates a new seance entity.
     *
     */
    public function newAction(Request $request)
    {

        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();


        $seance = new Seance();
        $seance->setDate($input["date"]);
        $seance->setHeureDebut($input["heureDeb"]);
        $seance->setDuree($input["duree"]);
        $em->persist($seance);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($seance, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Finds and displays a seance entity.
     *
     */
    public function showAction(Seance $seance)
    {
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('ProfBundle:Seance')->find($seance);

        $data = $this->get('jms_serializer')->serialize($seances, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Displays a form to edit an existing seance entity.
     *
     */
    public function editAction(Request $request, Seance $seance)
    {

        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();


        $seance = $em->getRepository("ProfBundle:Seance")->find($seance);
        $seance->setDate($input["date"]);
        $seance->setHeureDebut($input["heureDeb"]);
        $seance->setDuree($input["duree"]);
        $em->persist($seance);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($seance, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Deletes a seance entity.
     *
     */
    public function deleteAction(Request $request, Seance $seance)
    {
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('ProfBundle:Seance')->find($seance);
        $em->remove($seances);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize('Seance removed successfully', 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Creates a form to delete a seance entity.
     *
     * @param Seance $seance The seance entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Seance $seance)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seance_delete', array('id' => $seance->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
