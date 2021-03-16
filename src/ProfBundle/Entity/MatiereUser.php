<?php

namespace ProfBundle\Entity;

use ClassBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use NoteBundle\Entity\Matiere;

/**
 * MatiereUser
 *
 * @ORM\Table(name="matiere_user")
 * @ORM\Entity(repositoryClass="ProfBundle\Repository\MatiereUserRepository")
 */
class MatiereUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="ClassBundle\Entity\User" ,cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="idUser")
     * })
     */
    private $iduser;

    /**
     * @var matiere
     * @ORM\ManyToOne(targetEntity="NoteBundle\Entity\Matiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_matiere", referencedColumnName="id_matiere")
     * })
     */
    private $idmtiere;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param User $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

    /**
     * @return Matiere
     */
    public function getIdmtiere()
    {
        return $this->idmtiere;
    }

    /**
     * @param Matiere $idmtiere
     */
    public function setIdmtiere($idmtiere)
    {
        $this->idmtiere = $idmtiere;
    }


}

