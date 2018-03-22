<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostsWeb
 *
 * @ORM\Table(name="posts_web", indexes={@ORM\Index(name="idUser", columns={"idUser"})})
 * @ORM\Entity (repositoryClass="SocialPro\NetworkBundle\Entity\PostWebRepository")
 */
class PostsWeb
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
     * @ORM\Column(name="contenu", type="text", length=65535, nullable=false)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateInsert", type="datetime", nullable=false)
     */
    private $dateinsert ;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModification", type="datetime", nullable=true)
     */
    private $datemodification;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="text", length=65535, nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="blob", length=65535, nullable=true)
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="modified", type="string", nullable=false)
     */
    private $modified;

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
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param string $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return \DateTime
     */
    public function getDateinsert()
    {
        return $this->dateinsert;
    }

    /**
     * @param \DateTime $dateinsert
     */
    public function setDateinsert($dateinsert)
    {
        $this->dateinsert = $dateinsert;
    }

    /**
     * @return \DateTime
     */
    public function getDatemodification()
    {
        return $this->datemodification;
    }

    /**
     * @param \DateTime $datemodification
     */
    public function setDatemodification($datemodification)
    {
        $this->datemodification = $datemodification;
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
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param string $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
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

    public function __toString()
    {
        return (string) $this->getContenu();
    }


}

