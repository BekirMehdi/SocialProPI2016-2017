<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projets
 *
 * @ORM\Table(name="projets", indexes={@ORM\Index(name="idEntreprise", columns={"idEntreprise", "idScrumMaster", "idProductOwner", "idTeam"}), @ORM\Index(name="idScrumMaster", columns={"idScrumMaster"}), @ORM\Index(name="idProductOwner", columns={"idProductOwner"}), @ORM\Index(name="idTeam", columns={"idTeam"}), @ORM\Index(name="IDX_B454C1DB8FEDE48A", columns={"idEntreprise"})})
 * @ORM\Entity
 */
class Projets
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id_Po", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPo;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="access", type="text", length=6000, nullable=false)
     */
    private $access;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime", nullable=true)
     */
    private $datecreation ;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateLimite", type="datetime", nullable=false)
     */
    private $datelimite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateStart", type="datetime", nullable=false)
     */
    private $datestart;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="progression", type="float", precision=10, scale=0, nullable=true)
     */
    private $progression;

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
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idScrumMaster", referencedColumnName="id_Us")
     * })
     */
    private $idscrummaster;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idProductOwner", referencedColumnName="id_Us")
     * })
     */
    private $idproductowner;

    /**
     * @var \Teams
     *
     * @ORM\ManyToOne(targetEntity="Teams")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTeam", referencedColumnName="id_Eq")
     * })
     */
    public $idteam;

    /**
     * @ORM\OneToOne(targetEntity="SocialPro\NetworkBundle\Entity\Media", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    public $image;

    /**
     * @return int
     */
    public function getIdPo()
    {
        return $this->idPo;
    }

    /**
     * @param int $idPo
     */
    public function setIdPo($idPo)
    {
        $this->idPo = $idPo;
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
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * @param \DateTime $datecreation
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;
    }

    /**
     * @return \DateTime
     */
    public function getDatelimite()
    {
        return $this->datelimite;
    }

    /**
     * @param \DateTime $datelimite
     */
    public function setDatelimite($datelimite)
    {
        $this->datelimite = $datelimite;
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
     * @return float
     */
    public function getProgression()
    {
        return $this->progression;
    }

    /**
     * @param float $progression
     */
    public function setProgression($progression)
    {
        $this->progression = $progression;
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
     * @return \Users
     */
    public function getIdscrummaster()
    {
        return $this->idscrummaster;
    }

    /**
     * @param \Users $idscrummaster
     */
    public function setIdscrummaster($idscrummaster)
    {
        $this->idscrummaster = $idscrummaster;
    }

    /**
     * @return \Users
     */
    public function getIdproductowner()
    {
        return $this->idproductowner;
    }

    /**
     * @return \Teams
     */
    public function getIdteam()
    {
        return $this->idteam;
    }

    public function __toString()
    {
        return $this->getName();
    }
    /**
     * Set image
     *
     * @param \SocialPro\NetworkBundle\Entity\Media $image
     * @return Projets
     */
    public function setImage(\SocialPro\NetworkBundle\Entity\Media $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \SocialPro\NetworkBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * @param string $access
     */
    public function setAccess($access)
    {
        $this->access = $access;
    }





}

