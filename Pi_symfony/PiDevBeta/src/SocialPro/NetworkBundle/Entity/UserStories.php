<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserStories
 *
 * @ORM\Table(name="user_stories", indexes={@ORM\Index(name="idSprint", columns={"idSprint"})})
 * @ORM\Entity
 */
class UserStories
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_US", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUs;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", length=65535, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="complexite", type="integer", nullable=true)
     */
    private $complexite;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateStart", type="datetime", nullable=false)
     */
    private $datestart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadLine", type="datetime", nullable=false)
     */
    private $deadline;

    /**
     * @var float
     *
     * @ORM\Column(name="successRate", type="float", precision=10, scale=0, nullable=false)
     */
    private $successrate;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer", nullable=false)
     */
    private $priority;

    /**
     * @var \Sprints
     *
     * @ORM\ManyToOne(targetEntity="Sprints")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idSprint", referencedColumnName="id_Sp")
     * })
     */
    private $idsprint;


}

