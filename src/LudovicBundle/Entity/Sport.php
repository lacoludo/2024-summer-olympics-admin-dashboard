<?php

namespace LudovicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sport
 *
 * @ORM\Table(name="sport")
 * @ORM\Entity(repositoryClass="LudovicBundle\Repository\SportRepository")
 */
class Sport
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
     * @ORM\OneToMany(targetEntity="LudovicBundle\Entity\Athlete", mappedBy="sport")
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
     * @return Sport
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
     * Set athletes
     *
     * @param string $athletes
     *
     * @return Sport
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

