<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 *
 * @ORM\Table(name="posts", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="idTeam", columns={"idTeam"})})
 * @ORM\Entity
 */
class Posts
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Po", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPo;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu", type="text", length=65535, nullable=false)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateInsert", type="datetime", nullable=false)
     */
    private $dateinsert = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModification", type="datetime", nullable=true)
     */
    private $datemodification;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="text", length=65535, nullable=true)
     */
    private $link;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="blob", length=65535, nullable=true)
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="modified", type="string", nullable=false)
     */
    private $modified;

    /**
     * @var \Teams
     *
     * @ORM\ManyToOne(targetEntity="Teams")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idTeam", referencedColumnName="id_Eq")
     * })
     */
    private $idteam;

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

