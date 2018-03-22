<?php

namespace SocialPro\NetworkBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entreprises
 *
 * @ORM\Table(name="entreprises", uniqueConstraints={@ORM\UniqueConstraint(name="lastName", columns={"nom"}), @ORM\UniqueConstraint(name="code", columns={"code"}), @ORM\UniqueConstraint(name="contact", columns={"contact"}), @ORM\UniqueConstraint(name="url", columns={"url"}), @ORM\UniqueConstraint(name="googleMapAddress", columns={"adresseGoogleMap"}), @ORM\UniqueConstraint(name="email", columns={"email"}), @ORM\UniqueConstraint(name="address", columns={"adresse"})})
 * @ORM\Entity
 */
class Entreprises
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_En", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEn;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=50, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=150, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=200, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=20, nullable=true)
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseGoogleMap", type="string", length=200, nullable=true)
     */
    private $adressegooglemap;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=150, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="verified", type="string", nullable=true)
     */
    private $verified = 'FALSE';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="text", length=65535, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="blob", length=65535, nullable=true)
     */
    private $logo;


}

