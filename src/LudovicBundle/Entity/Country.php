<?php

namespace LudovicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Country
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="LudovicBundle\Repository\CountryRepository")
 */
class Country
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the photo as a JPEG/JPG/PNG file.")
     * @Assert\File(mimeTypes={ "image/jpeg", "image/jpg", "image/png" })
     */
    private $flag;

    /**
     * @ORM\OneToMany(targetEntity="LudovicBundle\Entity\Athlete", mappedBy="country")
     */
    private $athletes;


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
     * Set name
     *
     * @param string $name
     *
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set flag
     *
     * @param string $flag
     *
     * @return Country
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return string
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set athletes
     *
     * @param string $athletes
     *
     * @return Country
     */
    public function setAthletes($athletes)
    {
        $this->athletes = $athletes;

        return $this;
    }

    /**
     * Get athletes
     *
     * @return string
     */
    public function getAthletes()
    {
        return $this->athletes;
    }
}

