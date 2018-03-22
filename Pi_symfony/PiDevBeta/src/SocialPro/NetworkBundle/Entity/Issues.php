<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="SocialPro\NetworkBundle\Repository\IssuesRepository")
 */
class Issues
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Iss", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idIss;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type;


    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=50, nullable=false)
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=false)
     */
    private $description;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idrReporter", referencedColumnName="id_Us")
     * })
     */
    private $reporter;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAssigneer", referencedColumnName="id_Us")
     * })
     */
    private $assigneer;

    /**
     * @var string
     *
     * @ORM\Column(name="resolution", type="string", length=255, nullable=false)
     */
    private $resolution;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text", length=255, nullable=false)
     */
    private $summary;


    /**
     * @var string
     *
     * @ORM\Column(name="securityLevel", type="text", length=255, nullable=false)
     */
    private $securityLevel;


    /**
     * @var string
     *
     * @ORM\Column(name="symptomSeverity", type="text", length=255, nullable=false)
     */
    private $symptomSeverity;

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
     * @var datetime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     */
    private $date_creation;

    /**
     * @return int
     */
    public function getIdIss()
    {
        return $this->idIss;
    }

    /**
     * @param int $idIss
     */
    public function setIdIss($idIss)
    {
        $this->idIss = $idIss;
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
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return string
     */
    public function getSecurityLevel()
    {
        return $this->securityLevel;
    }

    /**
     * @param string $securityLevel
     */
    public function setSecurityLevel($securityLevel)
    {
        $this->securityLevel = $securityLevel;
    }

    /**
     * @return string
     */
    public function getSymptomSeverity()
    {
        return $this->symptomSeverity;
    }

    /**
     * @param string $symptomSeverity
     */
    public function setSymptomSeverity($symptomSeverity)
    {
        $this->symptomSeverity = $symptomSeverity;
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

    /**
     * @return datetime
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * @param datetime $date_creation
     */
    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    /**
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param string $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
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
    public function getReporter()
    {
        return $this->reporter;
    }

    /**
     * @param string $reporter
     */
    public function setReporter($reporter)
    {
        $this->reporter = $reporter;
    }

    /**
     * @return string
     */
    public function getAssigneer()
    {
        return $this->assigneer;
    }

    /**
     * @param string $assigneer
     */
    public function setAssigneer($assigneer)
    {
        $this->assigneer = $assigneer;
    }

    /**
     * @return string
     */
    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * @param string $resolution
     */
    public function setResolution($resolution)
    {
        $this->resolution = $resolution;
    }



}

