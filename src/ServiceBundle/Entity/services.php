<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PaiementBundle\Entity\paiement;

/**
 * services
 *
 * @ORM\Table(name="services")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\servicesRepository")
 */
class services
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="tarif", type="string", length=255)
     */
    private $tarif;

    /**
     * @var bool
     *
     * @ORM\Column(name="payee", type="boolean")
     */
    private $payee;


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
     * Set type
     *
     * @param string $type
     *
     * @return services
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set tarif
     *
     * @param string $tarif
     *
     * @return services
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return string
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set payee
     *
     * @param boolean $payee
     *
     * @return services
     */
    public function setPayee($payee)
    {
        $this->payee = $payee;

        return $this;
    }

    /**
     * Get payee
     *
     * @return bool
     */
    public function getPayee()
    {
        return $this->payee;
    }
}

