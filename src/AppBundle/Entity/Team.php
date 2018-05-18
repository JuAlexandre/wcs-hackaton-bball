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
     * @var Games[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Game", mappedBy="teams")
     */
    private $games;

    /**
     * @var Scores[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\GameTeamStats", mappedBy="team")
     */
    private $scores;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->games = new ArrayCollection();
        $this->scores = new ArrayCollection();
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
     * @param Player $player
     *
     * @return Team
     */
    public function addPlayer(Player $player)
    {
        $this->players[] = $player;

        return $this;
    }

    /**
     * Remove player
     *
     * @param Player $player
     */
    public function removePlayer(Player $player)
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
     * Add game
     *
     * @param Game $game
     *
     * @return Team
     */
    public function addGame(Game $game)
    {
        $this->games[] = $game;

        return $this;
    }

    /**
     * Remove game
     *
     * @param Game $game
     */
    public function removeGame(Game $game)
    {
        $this->games->removeElement($game);
    }

    /**
     * Get games
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGames()
    {
        return $this->games;
    }

    /**
     * Add score
     *
     * @param GameTeamStats $score
     *
     * @return Team
     */
    public function addScore(GameTeamStats $score)
    {
        $this->scores[] = $score;

        return $this;
    }

    /**
     * Remove score
     *
     * @param GameTeamStats $score
     */
    public function removeScore(GameTeamStats $score)
    {
        $this->scores->removeElement($score);
    }

    /**
     * Get scores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScores()
    {
        return $this->scores;
    }
}
