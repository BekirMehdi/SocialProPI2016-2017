<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserChatMessages
 *
 * @ORM\Table(name="user_chat_messages", indexes={@ORM\Index(name="idSender", columns={"idSender"})})
 * @ORM\Entity
 */
class UserChatMessages
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_UCM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUcm;

    /**
     * @var integer
     *
     * @ORM\Column(name="idReceiver", type="integer", nullable=false)
     */
    private $idreceiver;

    /**
     * @var string
     *
     * @ORM\Column(name="messageContent", type="text", length=65535, nullable=false)
     */
    private $messagecontent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="messageTime", type="datetime", nullable=false)
     */
    private $messagetime = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="blob", length=65535, nullable=true)
     */
    private $file;

    /**
     * @var integer
     *
     * @ORM\Column(name="fileName", type="integer", nullable=true)
     */
    private $filename;

    /**
     * @var boolean
     *
     * @ORM\Column(name="viewed", type="boolean", nullable=true)
     */
    private $viewed = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateViewed", type="datetime", nullable=true)
     */
    private $dateviewed;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idSender", referencedColumnName="id_Us")
     * })
     */
    private $idsender;


}

