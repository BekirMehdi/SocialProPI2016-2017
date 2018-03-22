<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SocialPro\NetworkBundle\Entity\Users;
/**
 * Relations
 *
 * @ORM\Table(name="relations", indexes={@ORM\Index(name="idUser", columns={"idUser", "idFriend"}), @ORM\Index(name="idFriend", columns={"idFriend"}), @ORM\Index(name="IDX_146CBF78FE6E88D7", columns={"idUser"})})
 * @ORM\Entity(repositoryClass="SocialPro\NetworkBundle\Entity\RelationsRepository")
 */
class Relations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Re", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRe;

    /**
     * @var integer
     *
     * @ORM\Column(name="leveRelation", type="integer", nullable=true)
     */
    private $leverelation;

    /**
     * @var string
     *
     * @ORM\Column(name="currentTeam", type="string", nullable=false)
     */
    private $currentteam = 'FALSE';

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
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idFriend", referencedColumnName="id_Us")
     * })
     */
    private $idfriend;

    /**
     * @return int
     */
    public function getIdRe()
    {
        return $this->idRe;
    }

    /**
     * @param int $idRe
     */
    public function setIdRe($idRe)
    {
        $this->idRe = $idRe;
    }

    /**
     * @return int
     */
    public function getLeverelation()
    {
        return $this->leverelation;
    }

    /**
     * @param int $leverelation
     */
    public function setLeverelation($leverelation)
    {
        $this->leverelation = $leverelation;
    }

    /**
     * @return string
     */
    public function getCurrentteam()
    {
        return $this->currentteam;
    }

    /**
     * @param string $currentteam
     */
    public function setCurrentteam($currentteam)
    {
        $this->currentteam = $currentteam;
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
     * @return \Users
     */
    public function getIdfriend()
    {
        return $this->idfriend;
    }

    /**
     * @param \Users $idfriend
     */
    public function setIdfriend($idfriend)
    {
        $this->idfriend = $idfriend;
    }


}

