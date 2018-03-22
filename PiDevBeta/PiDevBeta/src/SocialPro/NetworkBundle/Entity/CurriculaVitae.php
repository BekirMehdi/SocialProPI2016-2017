<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CurriculaVitae
 *
 * @ORM\Table(name="curricula_vitae", indexes={@ORM\Index(name="idUser", columns={"idUser"})})
 * @ORM\Entity
 */
class CurriculaVitae
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_CV", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCv;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=65535, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="local", type="string", length=65535, nullable=true)
     */
    private $local;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=65535, nullable=true)
     */
    private $place;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFrom", type="date", nullable=true)
     */
    private $datefrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTo", type="date", nullable=true)
     */
    private $dateto;

    /**
     * @var boolean
     *
     * @ORM\Column(name="checked", type="boolean", nullable=true)
     */
    private $checked;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=65535, nullable=true)
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=65535, nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="post", type="string", length=65535, nullable=true)
     */
    private $post;

    /**
     * @var string
     *
     * @ORM\Column(name="result", type="string", length=65535, nullable=true)
     */
    private $result;

    /**
     * @var string
     *
     * @ORM\Column(name="field", type="string", length=65535, nullable=true)
     */
    private $field;

    /**
     * @var string
     *
     * @ORM\Column(name="diploma", type="string", length=65535, nullable=true)
     */
    private $diploma;

    /**
     * @var string
     *
     * @ORM\Column(name="activity", type="string", length=65535, nullable=true)
     */
    private $activity;

    /**
     * @var string
     *
     * @ORM\Column(name="cause", type="string", length=65535, nullable=true)
     */
    private $cause;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=65535, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=65535, nullable=true)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="function", type="string", length=65535, nullable=true)
     */
    private $function;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id_Us")
     * })
     */
    private $iduser;

    /**
     * @return int
     */
    public function getIdCv()
    {
        return $this->idCv;
    }

    /**
     * @param int $idCv
     */
    public function setIdCv($idCv)
    {
        $this->idCv = $idCv;
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
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * @param string $local
     */
    public function setLocal($local)
    {
        $this->local = $local;
    }

    /**
     * @return string
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param string $place
     */
    public function setPlace($place)
    {
        $this->place = $place;
    }

    /**
     * @return \DateTime
     */
    public function getDatefrom()
    {
        return $this->datefrom;
    }

    /**
     * @param \DateTime $datefrom
     */
    public function setDatefrom($datefrom)
    {
        $this->datefrom = $datefrom;
    }

    /**
     * @return \DateTime
     */
    public function getDateto()
    {
        return $this->dateto;
    }

    /**
     * @param \DateTime $dateto
     */
    public function setDateto($dateto)
    {
        $this->dateto = $dateto;
    }

    /**
     * @return bool
     */
    public function isChecked()
    {
        return $this->checked;
    }

    /**
     * @param bool $checked
     */
    public function setChecked($checked)
    {
        $this->checked = $checked;
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
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param string $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param string $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param string $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return string
     */
    public function getDiploma()
    {
        return $this->diploma;
    }

    /**
     * @param string $diploma
     */
    public function setDiploma($diploma)
    {
        $this->diploma = $diploma;
    }

    /**
     * @return string
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * @param string $activity
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;
    }

    /**
     * @return string
     */
    public function getCause()
    {
        return $this->cause;
    }

    /**
     * @param string $cause
     */
    public function setCause($cause)
    {
        $this->cause = $cause;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * @param string $function
     */
    public function setFunction($function)
    {
        $this->function = $function;
    }

    /**
     * @return \Users
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param \Users $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }



}

