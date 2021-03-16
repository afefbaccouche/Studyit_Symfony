<?php

namespace NoteBundle\Controller;

use NoteBundle\Entity\Note;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NoteController extends Controller
{
    /**
     * Lists all note entities.
     *
     */
    public function findAllNotesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $notes = $em->getRepository('NoteBundle:Note')->findAll();
        $data = $this->get('jms_serializer')->serialize($notes, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Creates a new note entity.
     *
     */
    public function addNoteAction(Request $request)
    {
        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();


        $note = new Note();
        $note->setNote($input["note"]);
        $note->setIdEleve($input["idEleve"]);
        $note->setIdMatiere($input["idMatiere"]);
        $em->persist($note);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($note, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Finds and displays a note entity.
     *
     */
    public function findNoteAction(Note $note)
    {
        $data = $this->get('jms_serializer')->serialize($note, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


    /**
     * Displays a form to edit an existing note entity.
     *
     */
    public function editNoteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $note = $em->getRepository(Note::class)->find($id);
        $data = $request->getContent();
        $newdata = $this->get('jms_serializer')->deserialize($data, 'NoteBundle\Entity\Note', 'json');
        $note->setNote($newdata->getNote());
        $note->setIdEleve($newdata->getIdEleve());
        $note->setIdMatiere($newdata->getIdMatiere());
        $em->persist($note);
        $em->flush();
        return new JsonResponse(["msg" => "success"], 200);
    }

    /**
     * Deletes a note entity.
     *
     */
    public function deleteNoteAction(Request $request, Note $note)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($note);
        $em->flush();

        $data = $this->get('jms_serializer')->serialize($note->getNote() . " deleted", 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
