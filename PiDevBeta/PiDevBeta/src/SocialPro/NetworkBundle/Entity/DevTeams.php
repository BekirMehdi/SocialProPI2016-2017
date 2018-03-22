<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DevTeams
 *
 * @ORM\Table(name="dev_teams", indexes={@ORM\Index(name="idUser", columns={"idUser", "idTeam"}), @ORM\Index(name="idTeam", columns={"idTeam"}), @ORM\Index(name="IDX_5D0DE0AFFE6E88D7", columns={"idUser"})})
 * @ORM\Entity
 */
class DevTeams
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_DT", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDt;

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
     * @var \Teams
     *
     * @ORM\ManyToOne(targetEntity="Teams")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTeam", referencedColumnName="id_Eq")
     * })
     */
    private $idteam;


}

