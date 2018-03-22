<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostReactions
 *
 * @ORM\Table(name="post_reactions", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="idPost", columns={"idPost"}), @ORM\Index(name="idPost_2", columns={"idPost"}), @ORM\Index(name="idUser_2", columns={"idUser"})})
 * @ORM\Entity
 */
class PostReactions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_PR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPr;

    /**
     * @var string
     *
     * @ORM\Column(name="reaction", type="string", nullable=false)
     */
    private $reaction = 'NO REACTION';

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
     * @var \Posts
     *
     * @ORM\ManyToOne(targetEntity="Posts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPost", referencedColumnName="id_Po")
     * })
     */
    private $idpost;


}

