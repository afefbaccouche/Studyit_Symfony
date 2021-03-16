<?php

namespace PaiementBundle\Entity;

use ClassBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use ServiceBundle\Entity\services;

/**
 * paiement
 *
 * @ORM\Table(name="paiement")
 * @ORM\Entity(repositoryClass="PaiementBundle\Repository\paiementRepository")
 */
class paiement
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
     * @var int
     *
     * @ORM\Column(name="montantpayee", type="integer")
     */
    private $montantpayee;

    /**
     * @var \ServiceBundle\Entity\services
     *
     * @ORM\ManyToOne(targetEntity="ServiceBundle\Entity\services")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="idservice", referencedColumnName="id")
     * })
     */
    private $idservice;

    /**
     * @var \ClassBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="ClassBundle\Entity\User")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="iduser", referencedColumnName="idUser")
     * })
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="datepaiement", type="string", length=255)
     */
    private $datepaiement;


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
     * Set montantpayee
     *
     * @param integer $montantpayee
     *
     * @return paiement
     */
    public function setMontantpayee($montantpayee)
    {
        $this->montantpayee = $montantpayee;

        return $this;
    }

    /**
     * Get montantpayee
     *
     * @return int
     */
    public function getMontantpayee()
    {
        return $this->montantpayee;
    }

    /**
     * Set idservice
     *
     * @param integer $idservice
     *
     * @return ServiceBundle\Entity\services
     */
    public function setIdservice($idservice)
    {
        $this->idservice = $idservice;

        return $this;
    }

    /**
     * Get idservice
     *
     * @return int
     */
    public function getIdservice()
    {
        return $this->idservice;
    }

    /**
     * Set iduser
     *
     * @param integer $iduser
     *
     * @return User
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }

    /**
     * Get iduser
     *
     * @return int
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set datepaiement
     *
     * @param string $datepaiement
     *
     * @return paiement
     */
    public function setDatepaiement($datepaiement)
    {
        $this->datepaiement = $datepaiement;

        return $this;
    }

    /**
     * Get datepaiement
     *
     * @return string
     */
    public function getDatepaiement()
    {
        return $this->datepaiement;
    }
}

