<?php

namespace ClassBundle\Controller;

use ClassBundle\Entity\Reclamation;
use ClassBundle\Entity\User;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Email;

/**
 * Reclamation controller.
 *
 */
class ReclamationController extends Controller
{
    /**
     * Lists all reclamation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reclamations = $em->getRepository('ClassBundle:Reclamation')->findAll();
        $data = $this->get('jms_serializer')->serialize($reclamations, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Creates a new reclamation entity.
     *
     */
    public function newAction(Request $request)
    {
        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository("ClassBundle:User")->find($input["idUser"]);

        $reclamation = new Reclamation();
        $reclamation->setDescription($input["description"]);
        $reclamation->setObj($input["obj"]);
        $reclamation->setIduser($user);
        $em->persist($reclamation);
        $em->flush();
        $this->sendMail($request, $user, $reclamation);

        $data = $this->get('jms_serializer')->serialize($reclamation, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function sendMail(Request $request,
                             User $user, Reclamation $reclamation)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody(
                "dkjdkjkd")
        ;
        $this->get('mailer')->send($message);


    }

    /**
     * Finds and displays a reclamation entity.
     *
     */
    public function showAction(Reclamation $reclamation)
    {
        $data = $this->get('jms_serializer')->serialize($reclamation, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Displays a form to edit an existing reclamation entity.
     *
     */
    public function editAction(Request $request)
    {

        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $reclamation = $em->getRepository("ClassBundle:Reclamation")->find($input["id"]);
        $user = $em->getRepository("ClassBundle:User")->find($input["idUser"]);

        $reclamation->setDescription($input["description"]);
        $reclamation->setObj($input["obj"]);
        $reclamation->setIduser($user);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize($reclamation, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Deletes a reclamation entity.
     *
     */
    public function deleteAction(Request $request, Reclamation $reclamation)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($reclamation);
        $em->flush();


        $data = $this->get('jms_serializer')->serialize($reclamation->getObj() . " is deleted", 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


}
