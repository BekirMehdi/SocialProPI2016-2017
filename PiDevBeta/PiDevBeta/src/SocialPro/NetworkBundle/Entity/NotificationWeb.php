<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotificationWeb
 *
 * @ORM\Table(name="notification_web")
 * @ORM\Entity
 */
class NotificationWeb
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_NW", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNw;

    /**
     * @var integer
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     * @var integer
     *
     * @ORM\Column(name="idPost", type="integer", nullable=false)
     */
    private $idpost;

    /**
     * @var integer
     *
     * @ORM\Column(name="idRecipient", type="integer", nullable=false)
     */
    private $idrecipient;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="seen", type="boolean", nullable=false)
     */
    private $seen;


}

