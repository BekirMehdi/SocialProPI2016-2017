<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ChatMessagesReceivers
 *
 * @ORM\Table(name="chat_messages_receivers", indexes={@ORM\Index(name="idMessage", columns={"idMessage", "idReceiver"}), @ORM\Index(name="idReceiver", columns={"idReceiver"}), @ORM\Index(name="IDX_F37F9BC6A6045B8D", columns={"idMessage"})})
 * @ORM\Entity
 */
class ChatMessagesReceivers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_CMR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCmr;

    /**
     * @var string
     *
     * @ORM\Column(name="viewed", type="string", nullable=false)
     */
    private $viewed;

    /**
     * @var \UserChatMessages
     *
     * @ORM\ManyToOne(targetEntity="UserChatMessages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMessage", referencedColumnName="id_UCM")
     * })
     */
    private $idmessage;

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

