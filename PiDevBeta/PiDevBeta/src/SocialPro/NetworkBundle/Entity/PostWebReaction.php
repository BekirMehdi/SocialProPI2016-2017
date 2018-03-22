<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostWebReaction
 *
 * @ORM\Table(name="post_web_reaction")
 * @ORM\Entity
 */
class PostWebReaction
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_PWR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPwr;

    /**
     * @var integer
     *
     * @ORM\Column(name="idPost", type="integer", nullable=false)
     */
    private $idpost;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @return int
     */
    public function getIdPwr()
    {
        return $this->idPwr;
    }

    /**
     * @param int $idPwr
     */
    public function setIdPwr($idPwr)
    {
        $this->idPwr = $idPwr;
    }

    /**
     * @return int
     */
    public function getIdpost()
    {
        return $this->idpost;
    }

    /**
     * @param int $idpost
     */
    public function setIdpost($idpost)
    {
        $this->idpost = $idpost;
    }

    /**
     * @return int
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param int $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
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



}

