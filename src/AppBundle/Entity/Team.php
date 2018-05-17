<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamRepository")
 */
class Team
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
     * @ORM\Column(name="name", type="string", length=128, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="flag", type="string", length=255, unique=true)
     */
    private $flag;

    /**
     * @var Game[]
     * @ORM\ManyToOne(targetEntity="AbstractGame", inversedBy="localTeam")
     */
    private $localGames;

    /**
     * @var Game[]
     * @ORM\ManyToOne(targetEntity="AbstractGame", inversedBy="visitorTeam")
     */
    private $visitorGames;

    /**
     * Return list of team's games
     * @return Game[]
     */
    public function getGames(): array
    {
        return array_merge(
            $this->getLocalGames(),
            $this->getVisitorGames()
        );
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set flag.
     *
     * @param string $flag
     *
     * @return Team
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag.
     *
     * @return string
     */
    public function getFlag()
    {
        return $this->flag;
    }


    /**
     * Set localGames.
     *
     * @param \AppBundle\Entity\AbstractGame[]|null $localGames
     *
     * @return Team
     */
    public function setLocalGames(\AppBundle\Entity\AbstractGame $localGames = null): self
    {
        $this->localGames = $localGames;

        return $this;
    }

    /**
     * Get localGames.
     *
     * @return \AppBundle\Entity\AbstractGame[]|null
     */
    public function getLocalGames(): ?array
    {
        return $this->localGames;
    }

    /**
     * Set visitorGames.
     *
     * @param \AppBundle\Entity\AbstractGame[]|null $visitorGames
     *
     * @return Team
     */
    public function setVisitorGames(\AppBundle\Entity\AbstractGame $visitorGames = null): self
    {
        $this->visitorGames = $visitorGames;

        return $this;
    }

    /**
     * Get visitorGames.
     *
     * @return \AppBundle\Entity\AbstractGame[]|null
     */
    public function getVisitorGames(): ?array
    {
        return $this->visitorGames;
    }
}