<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Discussions
 *
 * @ORM\Table(name="discussions")
 * @ORM\Entity
 */
class Discussions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Di", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDi;

    /**
     * @var string
     *
     * @ORM\Column(name="discussionName", type="string", length=50, nullable=false)
     */
    private $discussionname;


}

