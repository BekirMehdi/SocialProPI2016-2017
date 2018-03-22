<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentsWeb
 *
 * @ORM\Table(name="comments_web", indexes={@ORM\Index(name="idPost", columns={"idPost"}), @ORM\Index(name="idUser", columns={"idUser"})})
 * @ORM\Entity
 */
class CommentsWeb
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Co", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCo;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=false)
     */
    private $comment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublished", type="datetime", nullable=false)
     */
    private $datepublished = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModification", type="datetime", nullable=true)
     */
    private $datemodification;

    /**
     * @var boolean
     *
     * @ORM\Column(name="modified", type="boolean", nullable=true)
     */
    private $modified = '0';

    /**
     * @var \SocialPro\NetworkBundle\Entity\PostsWeb
     *
     * @ORM\ManyToOne(targetEntity="PostsWeb")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPost", referencedColumnName="id_Po")
     * })
     */
    private $idpost;

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
    public function getIdCo()
    {
        return $this->idCo;
    }

    /**
     * @param int $idCo
     */
    public function setIdCo($idCo)
    {
        $this->idCo = $idCo;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return \DateTime
     */
    public function getDatepublished()
    {
        return $this->datepublished;
    }

    /**
     * @param \DateTime $datepublished
     */
    public function setDatepublished($datepublished)
    {
        $this->datepublished = $datepublished;
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
     * @return bool
     */
    public function isModified()
    {
        return $this->modified;
    }

    /**
     * @param bool $modified
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

    /**
     * @return PostsWeb
     */
    public function getIdpost()
    {
        return $this->idpost;
    }

    /**
     * @param integer $idpost
     */
    public function setIdpost($idpost)
    {
        $this->idpost = $idpost;
    }

    function __toString()
    {
         return (string) $this->idCo." ".$this->getIdpost()->getIdPo()." ".$this->comment ;
    }


}

