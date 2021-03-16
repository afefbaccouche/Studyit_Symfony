<?php

namespace ClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profclass
 *
 * @ORM\Table(name="profclass", indexes={@ORM\Index(name="idProf", columns={"idProf"}), @ORM\Index(name="idClasse", columns={"idClasse"})})
 * @ORM\Entity
 */
class Profclass
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \ClassBundle\Entity\Classe
     *
     * @ORM\ManyToOne(targetEntity="ClassBundle\Entity\Classe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idClasse", referencedColumnName="id")
     * })
     */
    private $idclasse;

    /**
     * @var \ClassBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="ClassBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProf", referencedColumnName="idUser")
     * })
     */
    private $idprof;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Classe
     */
    public function getIdclasse()
    {
        return $this->idclasse;
    }

    /**
     * @param Classe $idclasse
     */
    public function setIdclasse($idclasse)
    {
        $this->idclasse = $idclasse;
    }

    /**
     * @return User
     */
    public function getIdprof()
    {
        return $this->idprof;
    }

    /**
     * @param User $idprof
     */
    public function setIdprof($idprof)
    {
        $this->idprof = $idprof;
    }


}

