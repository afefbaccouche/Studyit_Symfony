<?php

namespace ClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Elevesclasse
 *
 * @ORM\Table(name="elevesclasse", indexes={@ORM\Index(name="idEleve", columns={"idEleve"}), @ORM\Index(name="idClasse", columns={"idClasse"})})
 * @ORM\Entity
 */
class Elevesclasse
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
     * @var \ClassBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="ClassBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEleve", referencedColumnName="idUser")
     * })
     */
    private $ideleve;

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
     * @return User
     */
    public function getIdeleve()
    {
        return $this->ideleve;
    }

    /**
     * @param User $ideleve
     */
    public function setIdeleve($ideleve)
    {
        $this->ideleve = $ideleve;
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


}

