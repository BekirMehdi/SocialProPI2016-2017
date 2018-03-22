<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meetings
 *
 * @ORM\Table(name="meetings", indexes={@ORM\Index(name="idProjet", columns={"idProjet"})})
 * @ORM\Entity
 */
class Meetings
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Me", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMe;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=false)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="heure", type="string", length=20, nullable=true)
     */
    private $heure;

    /**
     * @var float
     *
     * @ORM\Column(name="duree", type="float", precision=10, scale=0, nullable=true)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="ambiance", type="string", length=100, nullable=true)
     */
    private $ambiance;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=200, nullable=false)
     */
    private $lieu;

    /**
     * @var \Projets
     *
     * @ORM\ManyToOne(targetEntity="Projets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProjet", referencedColumnName="id_Po")
     * })
     */
    private $idprojet;

    /**
     * @return int
     */
    public function getIdMe()
    {
        return $this->idMe;
    }

    /**
     * @param int $idMe
     */
    public function setIdMe($idMe)
    {
        $this->idMe = $idMe;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param string $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    /**
     * @return float
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param float $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getAmbiance()
    {
        return $this->ambiance;
    }

    /**
     * @param string $ambiance
     */
    public function setAmbiance($ambiance)
    {
        $this->ambiance = $ambiance;
    }

    /**
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param string $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return \Projets
     */
    public function getIdprojet()
    {
        return $this->idprojet;
    }

    /**
     * @param \Projets $idprojet
     */
    public function setIdprojet($idprojet)
    {
        $this->idprojet = $idprojet;
    }


}

