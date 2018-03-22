<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sprints
 *
 * @ORM\Table(name="sprints", indexes={@ORM\Index(name="idProjet", columns={"idProjet"})})
 * @ORM\Entity
 */
class Sprints
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Sp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSp;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateStart", type="datetime", nullable=false)
     */
    private $datestart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadLine", type="datetime", nullable=false)
     */
    private $deadline;

    /**
     * @var float
     *
     * @ORM\Column(name="successRate", type="float", precision=10, scale=0, nullable=false)
     */
    private $successrate;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

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
    public function getIdSp()
    {
        return $this->idSp;
    }

    /**
     * @param int $idSp
     */
    public function setIdSp($idSp)
    {
        $this->idSp = $idSp;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return \DateTime
     */
    public function getDatestart()
    {
        return $this->datestart;
    }

    /**
     * @param \DateTime $datestart
     */
    public function setDatestart($datestart)
    {
        $this->datestart = $datestart;
    }

    /**
     * @return \DateTime
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * @param \DateTime $deadline
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }

    /**
     * @return float
     */
    public function getSuccessrate()
    {
        return $this->successrate;
    }

    /**
     * @param float $successrate
     */
    public function setSuccessrate($successrate)
    {
        $this->successrate = $successrate;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
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

