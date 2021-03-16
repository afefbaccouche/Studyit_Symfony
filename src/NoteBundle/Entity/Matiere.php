<?php

namespace NoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matiere
 *
 * @ORM\Table(name="matiere", indexes={@ORM\Index(name="id_niveau", columns={"id_niveau"})})
 * @ORM\Entity
 */
class Matiere
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_matiere", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idMatiere;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_matiere", type="string", length=50, nullable=false)
     */
    private $nomMatiere;

    /**
     * @var \Niveau
     *
     * @ORM\ManyToOne(targetEntity="ClassBundle\Entity\Niveau")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_niveau", referencedColumnName="idNiveau")
     * })
     */
    private $idNiveau;

    /**
     * @return int
     */
    public function getIdMatiere()
    {
        return $this->idMatiere;
    }

    /**
     * @param int $idMatiere
     */
    public function setIdMatiere($idMatiere)
    {
        $this->idMatiere = $idMatiere;
    }

    /**
     * @return string
     */
    public function getNomMatiere()
    {
        return $this->nomMatiere;
    }

    /**
     * @param string $nomMatiere
     */
    public function setNomMatiere($nomMatiere)
    {
        $this->nomMatiere = $nomMatiere;
    }

    /**
     * @return \Niveau
     */
    public function getIdNiveau()
    {
        return $this->idNiveau;
    }

    /**
     * @param \Niveau $idNiveau
     */
    public function setIdNiveau($idNiveau)
    {
        $this->idNiveau = $idNiveau;
    }

}

