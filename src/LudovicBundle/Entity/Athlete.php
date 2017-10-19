<?php

namespace LudovicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Athlete
 *
 * @ORM\Table(name="athlete")
 * @ORM\Entity(repositoryClass="LudovicBundle\Repository\AthleteRepository")
 */
class Athlete
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=50)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=50)
     */
    private $firstname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="date", length=255)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the photo as a JPEG/JPG/PNG file.")
     * @Assert\File(mimeTypes={ "image/jpeg", "image/jpg", "image/png" })
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity="LudovicBundle\Entity\Country", inversedBy="athletes")
     * @ORM\JoinColumn(name="country", referencedColumnName="id")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="LudovicBundle\Entity\Sport", inversedBy="athletes")
     * @ORM\JoinColumn(name="sport", referencedColumnName="id")
     */
    private $sport;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Athlete
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Athlete
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Athlete
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Athlete
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set country
     *
     * @param \LudovicBundle\Entity\Country $country
     *
     * @return Athlete
     */
    public function setCountry(\LudovicBundle\Entity\Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set sport
     *
     * @param \LudovicBundle\Entity\Sport $sport
     *
     * @return Athlete
     */
    public function setSport(\LudovicBundle\Entity\Sport $sport)
    {
        $this->sport = $sport;

        return $this;
    }

    /**
     * Get sport
     *
     * @return \LudovicBundle\Entity\Sport
     */
    public function getSport()
    {
        return $this->sport;
    }
}

