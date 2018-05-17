<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Game;
use AppBundle\Entity\Team;
use Doctrine\ORM\Mapping as ORM;

/**
 * GameTeam
 *
 * @ORM\Table(name="game_team_stats")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameTeamRepository")
 */
class GameTeamStats
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Team
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team", inversedBy="scores")
     */
    private $team;

    /**
     * @var Game
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Game", inversedBy="stats")
     */
    private $game;

    /**
     * @var int|null
     * @ORM\Column(name="score", type="integer", nullable=true)
     */
    private $score;

    /**
     * GameTeamStats constructor.
     * @param \AppBundle\Entity\Game $game
     * @param \AppBundle\Entity\Team $team
     */
    public function __construct(Game $game, Team $team)
    {
        $this->game = $game;
        $this->team = $team;
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
     * Set score
     *
     * @param integer $score
     *
     * @return GameTeamStats
     */
    public function setScore(?int $score): GameTeamStats
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore(): ?int
    {
        return $this->score;
    }

    /**
     * Set team
     *
     * @param Team $team
     *
     * @return GameTeamStats
     */
    public function setTeam(Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set game
     *
     * @param Game $game
     *
     * @return GameTeamStats
     */
    public function setGame(Game $game = null)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return Game
     */
    public function getGame()
    {
        return $this->game;
    }
}
