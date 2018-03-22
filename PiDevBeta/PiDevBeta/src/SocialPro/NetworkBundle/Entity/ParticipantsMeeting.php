<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParticipantsMeeting
 *
 * @ORM\Table(name="participants_meeting", indexes={@ORM\Index(name="idMeeting", columns={"idMeeting", "idUser"}), @ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="IDX_EBD9F40EE5AC8ACB", columns={"idMeeting"})})
 * @ORM\Entity
 */
class ParticipantsMeeting
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_PM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPm;

    /**
     * @var \Meetings
     *
     * @ORM\ManyToOne(targetEntity="Meetings")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMeeting", referencedColumnName="id_Me")
     * })
     */
    private $idmeeting;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="id_Us")
     * })
     */
    private $iduser;


}

