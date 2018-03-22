<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Data
 *
 * @ORM\Table(name="data", indexes={@ORM\Index(name="idUser", columns={"idUser", "idSprint"}), @ORM\Index(name="idSprint", columns={"idSprint"}), @ORM\Index(name="IDX_ADF3F363FE6E88D7", columns={"idUser"})})
 * @ORM\Entity
 */
class Data
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="blob", length=65535, nullable=false)
     */
    private $file;

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
     * @var \Sprints
     *
     * @ORM\ManyToOne(targetEntity="Sprints")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idSprint", referencedColumnName="id_Sp")
     * })
     */
    private $idsprint;


}

