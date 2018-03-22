<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tasks
 *
 * @ORM\Table(name="tasks", indexes={@ORM\Index(name="idUserStory", columns={"idUserStory", "idDeveloper"}), @ORM\Index(name="idDeveloper", columns={"idDeveloper"}), @ORM\Index(name="IDX_50586597F1D93CB8", columns={"idUserStory"})})
 * @ORM\Entity
 */
class Tasks
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Ta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTa;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="remake", type="integer", nullable=false)
     */
    private $remake;

    /**
     * @var \UserStories
     *
     * @ORM\ManyToOne(targetEntity="UserStories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUserStory", referencedColumnName="id_US")
     * })
     */
    private $iduserstory;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idDeveloper", referencedColumnName="id_Us")
     * })
     */
    private $iddeveloper;

    /**
     * @return int
     */
    public function getIdTa()
    {
        return $this->idTa;
    }

    /**
     * @param int $idTa
     */
    public function setIdTa($idTa)
    {
        $this->idTa = $idTa;
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
     * @return int
     */
    public function getRemake()
    {
        return $this->remake;
    }

    /**
     * @param int $remake
     */
    public function setRemake($remake)
    {
        $this->remake = $remake;
    }

    /**
     * @return \UserStories
     */
    public function getIduserstory()
    {
        return $this->iduserstory;
    }

    /**
     * @param \UserStories $iduserstory
     */
    public function setIduserstory($iduserstory)
    {
        $this->iduserstory = $iduserstory;
    }

    /**
     * @return \Users
     */
    public function getIddeveloper()
    {
        return $this->iddeveloper;
    }

    /**
     * @param \Users $iddeveloper
     */
    public function setIddeveloper($iddeveloper)
    {
        $this->iddeveloper = $iddeveloper;
    }



}

