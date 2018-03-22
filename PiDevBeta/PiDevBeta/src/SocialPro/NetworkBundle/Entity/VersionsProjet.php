<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VersionsProjet
 *
 * @ORM\Table(name="versions_projet", indexes={@ORM\Index(name="idSprint", columns={"id_sprint"})})
 * @ORM\Entity
 */
class VersionsProjet
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_VP", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idVp;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_projet", type="integer", nullable=false)
     */
    private $idProjet;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_sprint", type="integer", nullable=false)
     */
    private $numSprint;

    /**
     * @var string
     *
     * @ORM\Column(name="num_version", type="string", length=50, nullable=false)
     */
    private $numVersion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime", nullable=false)
     */
    private $dateCreation = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="fichier", type="string", length=255, nullable=false)
     */
    private $fichier;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var \Sprints
     *
     * @ORM\ManyToOne(targetEntity="Sprints")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sprint", referencedColumnName="id_Sp")
     * })
     */
    private $idSprint;


}

