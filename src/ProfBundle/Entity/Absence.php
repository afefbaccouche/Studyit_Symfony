<?php

namespace ProfBundle\Entity;

use ClassBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * Absence
 *
 * @ORM\Table(name="absence")
 * @ORM\Entity(repositoryClass="ProfBundle\Repository\AbsenceRepository")
 */
class Absence
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="ClassBundle\Entity\User" ,cascade={"all"}, fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="eleve", referencedColumnName="idUser")
     * })
     */
    private $eleve;

    /**
     * @var Seance
     * @ORM\ManyToOne(targetEntity="ProfBundle\Entity\Seance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="seance", referencedColumnName="id")
     * })
     */
    private $seance;
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
     * Set description
     *
     * @param string $description
     *
     * @return Absence
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return User
     */
    public function getEleve()
    {
        return $this->eleve;
    }

    /**
     * @param User $eleve
     */
    public function setEleve($eleve)
    {
        $this->eleve = $eleve;
    }

    /**
     * @return Seance
     */
    public function getSeance()
    {
        return $this->seance;
    }

    /**
     * @param Seance $seance
     */
    public function setSeance($seance)
    {
        $this->seance = $seance;
    }

}

