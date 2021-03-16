<?php

namespace NoteBundle\Controller;

use NoteBundle\Entity\Matiere;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MatiereController extends Controller
{
    /**
     * Lists all matiere entities.
     *
     */
    public function findAllMatieresAction()
    {
        $em = $this->getDoctrine()->getManager();

        $matieres = $em->getRepository('NoteBundle:Matiere')->findAll();
        $data = $this->get('jms_serializer')->serialize($matieres, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Creates a new matiere entity.
     *
     */
    public function addMatiereAction(Request $request)
    {
        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();

        $matiere = new Matiere();
        $matiere->setNomMatiere($input["nomMatiere"]);
        $matiere->setIdNiveau($input["idNiveau"]);
        $em->persist($matiere);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($matiere, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Finds and displays a matiere entity.
     *
     */
    public function findMatiereAction(Matiere $matiere)
    {
        $data = $this->get('jms_serializer')->serialize($matiere, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


    /**
     * Displays a form to edit an existing matiere entity.
     *
     */
    public function editMatiereAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $matiere = $em->getRepository(Matiere::class)->find($id);
        $data = $request->getContent();
        $newdata = $this->get('jms_serializer')->deserialize($data, 'NoteBundle\Entity\Matiere', 'json');
        $matiere->setNomMatiere($newdata->getNomMatiere());
        $matiere->setIdNiveau($newdata->getIdNiveau());
        $em->persist($matiere);
        $em->flush();
        return new JsonResponse(["msg" => "success"], 200);
    }

    /**
     * Deletes a matiere entity.
     *
     */
    public function deleteMatiereAction(Request $request, Matiere $matiere)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($matiere);
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($matiere->getNomMatiere() . " deleted", 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
