<?php


namespace ProfBundle\Controller;


use ClassBundle\Entity\Profclass;
use ClassBundle\Entity\User;
use DateTime;
use ProfBundle\Entity\Absence;
use ProfBundle\Entity\MatiereUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfController extends Controller
{
    public function loginAction($email,$password)
    {
        $em = $this->getDoctrine()->getManager();

        $connecteduser = $em->getRepository('ClassBundle:User')->findBy(array('email'=>$email,'password'=>$password));
        $data = $this->get('jms_serializer')->serialize($connecteduser, 'json');
        if(empty($connecteduser)){
            $data = $this->get('jms_serializer')->serialize('verifier votre login et mot de passe', 'json');
        }
       else if($connecteduser[0]->isStatus()==false){
            $data = $this->get('jms_serializer')->serialize('votre compte est desactive', 'json');
        }


        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    public function InscriptionAction(Request $request)
    {

        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $time = strtotime($input["datenaiss"]);

        $datenais= new DateTime("@$time");


        $profClass = new User();
        $profClass->setStatus(true);
        $profClass->setEmail($input["email"]);
        $profClass->setRole('professeur');
        $profClass->setPassword($input["password"]);
        $profClass->setDateinscription($datenais);
        $profClass->setSalaire($input["salaire"]);
        $profClass->setTelephone($input["telephone"]);
        $profClass->setUsername($input["username"]);
        $em->persist($profClass);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize('Professeur ajoutee avec success', 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    public function ModifierProfile(Request $request,$idusr)
    {

        $input = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $time = strtotime($input["datenaiss"]);

        $datenais= new DateTime("@$time");


        $profClass = $this->getDoctrine()->getManager()->getRepository("ClassBundle:User")->find($idusr);
        $profClass->setStatus(true);
        $profClass->setEmail($input["email"]);
        $profClass->setRole('professeur');
        $profClass->setPassword($input["password"]);
        $profClass->setDateinscription($datenais);
        $profClass->setSalaire($input["salaire"]);
        $profClass->setTelephone($input["telephone"]);
        $profClass->setUsername($input["username"]);
        $em->persist($profClass);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize('Information modifiee avec success', 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function ShowAllelevesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('ClassBundle:User')->findBy(array('role'=>'eleve'));

        $data = $this->get('jms_serializer')->serialize($seances, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    public function ShowAllProfsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('ClassBundle:User')->findBy(array('role'=>'professeur'));

        $data = $this->get('jms_serializer')->serialize($seances, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    public function ShowuserAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('ClassBundle:User')->find($id);

        $data = $this->get('jms_serializer')->serialize($seances, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    public function DesactiverCpteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('ClassBundle:User')->find($id);
        $seances->setStatus(false);
        $em->persist($seances);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize('Compte Desactive avec success !', 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    } public function activerCpteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('ClassBundle:User')->find($id);
        $seances->setStatus(true);
        $em->persist($seances);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize('Compte activee avec success !', 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
     public function affecterProfMatiereAction($idmatiere,$idProf)
    {
        $em = $this->getDoctrine()->getManager();

        $mat = $em->getRepository('NoteBundle:Matiere')->find($idmatiere);
        $users = $em->getRepository('ClassBundle:User')->find($idProf);
        $clsmatiere=new MatiereUser();
        $clsmatiere->setIduser($users);
        $clsmatiere->setIdmtiere($mat);

        $em->persist($clsmatiere);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize('Prof Affectee avec success !', 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
    public function affecterEtudiantAbsentAction($idelev,$idseance)
    {
        $em = $this->getDoctrine()->getManager();

        $scenace = $em->getRepository('ProfBundle:Seance')->find($idseance);
        $users = $em->getRepository('ClassBundle:User')->find($idelev);
        $clsmatiere=new Absence();
        $clsmatiere->setEleve($users);
        $clsmatiere->setSeance($scenace);
        $clsmatiere->setDescription('absence injustifiee');
        $em->persist($clsmatiere);
        $em->flush();
        $data = $this->get('jms_serializer')->serialize('Absence Enregistree avec success !', 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function NbreAbsenceEtPresentAction($seance)
    {
        $em = $this->getDoctrine()->getManager();

        $Abs = $em->getRepository('ProfBundle:Absence')->findBy(array('seance'=>$seance));
        $users = $em->getRepository('ClassBundle:User')->findBy(array('role'=>'eleve'));
        $nbtotale=count($users);
        $nbabsent=0;
        foreach ($Abs as $m){
            foreach($users as $u){
            if($m->getEleve()==$u)
                $nbabsent++;

            }
        }
        $nbpresent=$nbtotale-$nbabsent;
        $data = $this->get('jms_serializer')->serialize('il ya '.$nbabsent.' eleves absent et '.$nbpresent.' eleves present', 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}