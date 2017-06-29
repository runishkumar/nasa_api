<?php

namespace NasaApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Neo
 *
 * @ORM\Table(name="neo")
 * @ORM\Entity(repositoryClass="NasaApiBundle\Repository\NeoRepository")
 */
class Neo implements \JsonSerializable
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="reference", type="integer", unique=true)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="speed", type="decimal", precision=24, scale=8, nullable=true)
     */
    private $speed;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_hazardous", type="boolean")
     */
    private $isHazardous;

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Neo
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set reference
     *
     * @param integer $reference
     *
     * @return Neo
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return int
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Neo
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
     * Set speed
     *
     * @param string $speed
     *
     * @return Neo
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return string
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set isHazardous
     *
     * @param boolean $isHazardous
     *
     * @return Neo
     */
    public function setIsHazardous($isHazardous)
    {
        $this->isHazardous = $isHazardous;

        return $this;
    }

    /**
     * Get isHazardous
     *
     * @return bool
     */
    public function getIsHazardous()
    {
        return $this->isHazardous;
    }

    /**
     * Return json serializable array
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'reference' => $this->getReference(),
            'name' => $this->getName(),
            'speed' => $this->getSpeed(),
            'is_hazardous' => $this->getIsHazardous(),
            'date' => $this->getDate()->format('Y-m-d'),
        ];
    }
}

