<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotificationReceivers
 *
 * @ORM\Table(name="notification_receivers", indexes={@ORM\Index(name="idNotification", columns={"idNotification", "idReceiver"}), @ORM\Index(name="idReceiver", columns={"idReceiver"}), @ORM\Index(name="IDX_A4B606A9E1CAD23B", columns={"idNotification"})})
 * @ORM\Entity
 */
class NotificationReceivers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_NR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNr;

    /**
     * @var string
     *
     * @ORM\Column(name="viewed", type="string", nullable=false)
     */
    private $viewed;

    /**
     * @var \Notifications
     *
     * @ORM\ManyToOne(targetEntity="Notifications")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idNotification", referencedColumnName="id_No")
     * })
     */
    private $idnotification;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idReceiver", referencedColumnName="id_Us")
     * })
     */
    private $idreceiver;


}

