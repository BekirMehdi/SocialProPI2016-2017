<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Teams
 *
 * @ORM\Table(name="teams", indexes={@ORM\Index(name="idEntreprise", columns={"idEntreprise", "idProjet"}), @ORM\Index(name="idProjet", columns={"idProjet"}), @ORM\Index(name="IDX_96C222588FEDE48A", columns={"idEntreprise"})})
 * @ORM\Entity
 */
class Teams
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Eq", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEq;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="date", nullable=false)
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="text", length=65535, nullable=false)
     */
    private $status;

    /**
     * @var \Entreprises
     *
     * @ORM\ManyToOne(targetEntity="Entreprises")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEntreprise", referencedColumnName="id_En")
     * })
     */
    private $identreprise;

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
    public function getIdEq()
    {
        return $this->idEq;
    }

    /**
     * @param int $idEq
     */
    public function setIdEq($idEq)
    {
        $this->idEq = $idEq;
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
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param \DateTime $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \Entreprises
     */
    public function getIdentreprise()
    {
        return $this->identreprise;
    }

    /**
     * @param \Entreprises $identreprise
     */
    public function setIdentreprise($identreprise)
    {
        $this->identreprise = $identreprise;
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
    public function __toString()
    {
        return $this->getName();
    }


}

