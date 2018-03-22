<?php
namespace SocialPro\NetworkBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="SocialPro\NetworkBundle\Repository\UsersRepository")
 */
class Users extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_Us", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;





    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=50, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=50, nullable=false)
     */
    private $firstname;



    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=true)
     */
    private $status;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModification", type="datetime", nullable=true)
     */
    private $datemodification;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCnnx", type="datetime", nullable=true)
     */
    private $datecnnx;



    /**
     * @var string
     *
     * @ORM\Column(name="image", type="blob", length=65535, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="slogan", type="string", length=50, nullable=true)
     */
    private $slogan;

    /**
     * @var string
     *
     * @ORM\Column(name="Sm_FB", type="text", length=65535, nullable=true)
     */
    private $smFb;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Sm_INS", type="text", length=65535, nullable=true)
     */
    private $smIns;

    /**
     * @var string
     *
     * @ORM\Column(name="Sm_GPLUS", type="text", length=65535, nullable=true)
     */
    private $smGplus;

    /**
     * @var string
     *
     * @ORM\Column(name="Sm_LIN", type="text", length=65535, nullable=true)
     */
    private $smLin;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=true)
     */
    private $rating;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", nullable=true)
     */
    private $photo;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getDatemodification()
    {
        return $this->datemodification;
    }

    /**
     * @param \DateTime $datemodification
     */
    public function setDatemodification($datemodification)
    {
        $this->datemodification = $datemodification;
    }

    /**
     * @return \DateTime
     */
    public function getDatecnnx()
    {
        return $this->datecnnx;
    }

    /**
     * @param \DateTime $datecnnx
     */
    public function setDatecnnx($datecnnx)
    {
        $this->datecnnx = $datecnnx;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        if ($this->image != null) {


            return base64_encode(@stream_get_contents($this->image));
        }


    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        if ($image != null)
        {
            $this->image = @file_get_contents($image);
        }
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getSlogan()
    {
        return $this->slogan;
    }

    /**
     * @param string $slogan
     */
    public function setSlogan($slogan)
    {
        $this->slogan = $slogan;
    }

    /**
     * @return string
     */
    public function getSmFb()
    {
        return $this->smFb;
    }

    /**
     * @param string $smFb
     */
    public function setSmFb($smFb)
    {
        $this->smFb = $smFb;
    }

    /**
     * @return string
     */
    public function getSmIns()
    {
        return $this->smIns;
    }

    /**
     * @param string $smIns
     */
    public function setSmIns($smIns)
    {
        $this->smIns = $smIns;
    }

    /**
     * @return string
     */
    public function getSmGplus()
    {
        return $this->smGplus;
    }

    /**
     * @param string $smGplus
     */
    public function setSmGplus($smGplus)
    {
        $this->smGplus = $smGplus;
    }

    /**
     * @return string
     */
    public function getSmLin()
    {
        return $this->smLin;
    }

    /**
     * @param string $smLin
     */
    public function setSmLin($smLin)
    {
        $this->smLin = $smLin;
    }

    /**
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }






}

