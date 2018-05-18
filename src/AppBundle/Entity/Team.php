<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Game;
use AppBundle\Entity\GameTeamStats;
use AppBundle\Entity\Player;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=128, unique=true)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="flag", type="string", length=255, unique=true)
     */
    private $flag;

    /**
     * @var Player[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Player", mappedBy="team")
     */
    private $players;

    /**
     * @var Pool
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Pool", inversedBy="teams")
     */
    private $pool;

    /**
     * @var Game[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Game", mappedBy="visitorTeam")
     */
    private $gamesVisitor;

    /**
     * @var Game[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Game", mappedBy="localTeam")
     */
    private $gamesLocal;

    /**
     * Return list of games (visitors + locals)
     * @return Game[]
     */
    public function getGames(): array
    {
        return array_merge(
            $this->getGamesLocal()->toArray(),
            $this->getGamesVisitor()->toArray()
        );
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
        $this->gamesVisitor = new \Doctrine\Common\Collections\ArrayCollection();
        $this->gamesLocal = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set name
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
     * @return Team
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
     * Add player
     *
     * @param \AppBundle\Entity\Player $player
     *
     * @return Team
     */
    public function addPlayer(\AppBundle\Entity\Player $player)
    {
        $this->players[] = $player;

        return $this;
    }

    /**
     * Remove player
     *
     * @param \AppBundle\Entity\Player $player
     */
    public function removePlayer(\AppBundle\Entity\Player $player)
    {
        $this->players->removeElement($player);
    }

    /**
     * Get players
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * Add gamesVisitor
     *
     * @param \AppBundle\Entity\Game $gamesVisitor
     *
     * @return Team
     */
    public function addGamesVisitor(\AppBundle\Entity\Game $gamesVisitor)
    {
        $this->gamesVisitor[] = $gamesVisitor;

        return $this;
    }

    /**
     * Remove gamesVisitor
     *
     * @param \AppBundle\Entity\Game $gamesVisitor
     */
    public function removeGamesVisitor(\AppBundle\Entity\Game $gamesVisitor)
    {
        $this->gamesVisitor->removeElement($gamesVisitor);
    }

    /**
     * Get gamesVisitor
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGamesVisitor()
    {
        return $this->gamesVisitor;
    }

    /**
     * Add gamesLocal
     *
     * @param \AppBundle\Entity\Game $gamesLocal
     *
     * @return Team
     */
    public function addGamesLocal(\AppBundle\Entity\Game $gamesLocal)
    {
        $this->gamesLocal[] = $gamesLocal;

        return $this;
    }

    /**
     * Remove gamesLocal
     *
     * @param \AppBundle\Entity\Game $gamesLocal
     */
    public function removeGamesLocal(\AppBundle\Entity\Game $gamesLocal)
    {
        $this->gamesLocal->removeElement($gamesLocal);
    }

    /**
     * Get gamesLocal
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGamesLocal()
    {
        return $this->gamesLocal;
    }

    /**
     * Set pool
     *
     * @param \AppBundle\Entity\Pool $pool
     *
     * @return Team
     */
    public function setPool(\AppBundle\Entity\Pool $pool = null)
    {
        $this->pool = $pool;

        return $this;
    }

    /**
     * Get pool
     *
     * @return \AppBundle\Entity\Pool
     */
    public function getPool()
    {
        return $this->pool;
    }
}
