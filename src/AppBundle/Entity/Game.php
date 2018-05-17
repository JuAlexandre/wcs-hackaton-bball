<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 17/05/18
 * Time: 13:55
 */

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractGame
 * @package AppBundle\Entity
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GameRepository")
 */
class Game
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var GameTeamStats[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\GameTeamStats", mappedBy="game")
     */
    private $stats;

    /**
     * @var Team[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Team", inversedBy="games")
     */
    private $teams;

    /**
     * @var boolean
     * @ORM\Column(name="is_pool_game", type="boolean")
     */
    private $isPoolGame;

    /**
     * @var \DateTime
     * @ORM\Column(name="begin_at", type="datetime")
     */
    private $beginAt;

    /**
     * @var boolean
     * @ORM\Column(name="is_finished", type="boolean")
     */
    private $isFinished;

    /**
     * @var Stadium
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Stadium", inversedBy="games")
     */
    private $stadium;

    /**
     * Game constructor.
     * @param Team $local
     * @param Team $visitor
     */
    public function __construct(Team $local, Team $visitor)
    {
        $this->teams = [
            $local,
            $visitor
        ];
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
     * Set isPoolGame
     *
     * @param boolean $isPoolGame
     *
     * @return Game
     */
    public function setIsPoolGame($isPoolGame)
    {
        $this->isPoolGame = $isPoolGame;

        return $this;
    }

    /**
     * Get isPoolGame
     *
     * @return boolean
     */
    public function getIsPoolGame()
    {
        return $this->isPoolGame;
    }

    /**
     * Set beginAt
     *
     * @param \DateTime $beginAt
     *
     * @return Game
     */
    public function setBeginAt($beginAt)
    {
        $this->beginAt = $beginAt;

        return $this;
    }

    /**
     * Get beginAt
     *
     * @return \DateTime
     */
    public function getBeginAt()
    {
        return $this->beginAt;
    }

    /**
     * Set isFinished
     *
     * @param boolean $isFinished
     *
     * @return Game
     */
    public function setIsFinished($isFinished)
    {
        $this->isFinished = $isFinished;

        return $this;
    }

    /**
     * Get isFinished
     *
     * @return boolean
     */
    public function getIsFinished()
    {
        return $this->isFinished;
    }

    /**
     * Add stat
     *
     * @param \AppBundle\Entity\GameTeamStats $stat
     *
     * @return Game
     */
    public function addStat(\AppBundle\Entity\GameTeamStats $stat)
    {
        $this->stats[] = $stat;

        return $this;
    }

    /**
     * Remove stat
     *
     * @param \AppBundle\Entity\GameTeamStats $stat
     */
    public function removeStat(\AppBundle\Entity\GameTeamStats $stat)
    {
        $this->stats->removeElement($stat);
    }

    /**
     * Get stats
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * Add team
     *
     * @param \AppBundle\Entity\Team $team
     *
     * @return Game
     */
    public function addTeam(\AppBundle\Entity\Team $team)
    {
        $this->teams[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param \AppBundle\Entity\Team $team
     */
    public function removeTeam(\AppBundle\Entity\Team $team)
    {
        $this->teams->removeElement($team);
    }

    /**
     * Get teams
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Set stadium
     *
     * @param \AppBundle\Entity\Stadium $stadium
     *
     * @return Game
     */
    public function setStadium(\AppBundle\Entity\Stadium $stadium = null)
    {
        $this->stadium = $stadium;

        return $this;
    }

    /**
     * Get stadium
     *
     * @return \AppBundle\Entity\Stadium
     */
    public function getStadium()
    {
        return $this->stadium;
    }
}
