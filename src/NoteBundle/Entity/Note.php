<?php

namespace NoteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Note
 *
 * @ORM\Table(name="note", indexes={@ORM\Index(name="id_eleve", columns={"id_eleve"}), @ORM\Index(name="idMatiere", columns={"id_matiere"})})
 * @ORM\Entity
 */
class Note
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_note", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idNote;

    /**
     * @var float
     *
     * @ORM\Column(name="note", type="float", precision=10, scale=0, nullable=false)
     */
    private $note;

    /**
     * @var \Matiere
     *
     * @ORM\ManyToOne(targetEntity="Matiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_matiere", referencedColumnName="id_matiere")
     * })
     */
    private $idMatiere;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="ClassBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_eleve", referencedColumnName="idUser")
     * })
     */
    private $idEleve;

    /**
     * @return int
     */
    public function getIdNote()
    {
        return $this->idNote;
    }

    /**
     * @param int $idNote
     */
    public function setIdNote($idNote)
    {
        $this->idNote = $idNote;
    }

    /**
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param float $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return \Matiere
     */
    public function getIdMatiere()
    {
        return $this->idMatiere;
    }

    /**
     * @param \Matiere $idMatiere
     */
    public function setIdMatiere($idMatiere)
    {
        $this->idMatiere = $idMatiere;
    }

    /**
     * @return \User
     */
    public function getIdEleve()
    {
        return $this->idEleve;
    }

    /**
     * @param \User $idEleve
     */
    public function setIdEleve($idEleve)
    {
        $this->idEleve = $idEleve;
    }
}

