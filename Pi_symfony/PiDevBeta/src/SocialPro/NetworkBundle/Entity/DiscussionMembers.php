<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DiscussionMembers
 *
 * @ORM\Table(name="discussion_members", indexes={@ORM\Index(name="idDiscussion", columns={"idDiscussion", "idMember"}), @ORM\Index(name="idMember", columns={"idMember"}), @ORM\Index(name="idDiscussion_2", columns={"idDiscussion"})})
 * @ORM\Entity
 */
class DiscussionMembers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_DM", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDm;

    /**
     * @var \Discussions
     *
     * @ORM\ManyToOne(targetEntity="Discussions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idDiscussion", referencedColumnName="id_Di")
     * })
     */
    private $iddiscussion;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMember", referencedColumnName="id_Us")
     * })
     */
    private $idmember;


}

