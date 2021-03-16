<?php

namespace ClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Classe
 *
 * @ORM\Table(name="classe", indexes={@ORM\Index(name="IDX_8F87BF96FE6E88D7", columns={"idUser"}), @ORM\Index(name="IDX_8F87BF9628CE5BF1", columns={"idNiveau"})})
 * @ORM\Entity
 */
class Classe
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
     * @var string
     *
     * @ORM\Column(name="className", type="string", length=255, nullable=false)
     */
    private $classname;

    /**
     * @var integer
     *
     * @ORM\Column(name="capacite", type="integer", nullable=false)
     */
    private $capacite;

    /**
     * @var \ClassBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="ClassBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="idUser")
     * })
     */
    private $iduser;

    /**
     * @var \ClassBundle\Entity\Niveau
     *
     * @ORM\ManyToOne(targetEntity="ClassBundle\Entity\Niveau")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idNiveau", referencedColumnName="idNiveau")
     * })
     */
    private $idniveau;

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
     * @return string
     */
    public function getClassname()
    {
        return $this->classname;
    }

    /**
     * @param string $classname
     */
    public function setClassname($classname)
    {
        $this->classname = $classname;
    }

    /**
     * @return int
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * @param int $capacite
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;
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
     * @return Niveau
     */
    public function getIdniveau()
    {
        return $this->idniveau;
    }

    /**
     * @param Niveau $idniveau
     */
    public function setIdniveau($idniveau)
    {
        $this->idniveau = $idniveau;
    }

}

