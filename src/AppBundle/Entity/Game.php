<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 17/05/18
 * Time: 13:55
 */

namespace AppBundle\Entity;

use AppBundle\Entity\GameTeamStats;
use AppBundle\Entity\Team;
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
     * @Assert\Count(
     *      min = 2,
     *      max = 2,
     *      exactMessage="Vous devez avoir exactement 2 Team."
     * )
     */
    private $teams;

    /**
     * @var boolean
     * @ORM\Column(name="is_pool_game", type="boolean")
     * @Assert\Type("bool")
     */
    private $isPoolGame;

    /**
     * @var \DateTime
     * @ORM\Column(name="begin_at", type="datetime")
     * @Assert\DateTime()
     */
    private $beginAt;

    /**
     * @var boolean
     * @ORM\Column(name="is_finished", type="boolean")
     * @Assert\Type("bool")
     */
    private $isFinished;

    /**
     * @var Stadium
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Stadium", inversedBy="games")
     * @Assert\NotBlank()
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Game
     */
    public function setId(int $id): Game
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return GameTeamStats[]
     */
    public function getStats(): array
    {
        return $this->stats;
    }

    /**
     * @param GameTeamStats[] $stats
     * @return Game
     */
    public function setStats(array $stats): Game
    {
        $this->stats = $stats;
        return $this;
    }

    /**
     * @return Team[]
     */
    public function getTeams(): array
    {
        return $this->teams;
    }

    /**
     * @param Team[] $teams
     * @return Game
     */
    public function setTeams(array $teams): Game
    {
        $this->teams = $teams;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPoolGame(): bool
    {
        return $this->isPoolGame;
    }

    /**
     * @param bool $isPoolGame
     * @return Game
     */
    public function setIsPoolGame(bool $isPoolGame): Game
    {
        $this->isPoolGame = $isPoolGame;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBeginAt(): \DateTime
    {
        return $this->beginAt;
    }

    /**
     * @param \DateTime $beginAt
     * @return Game
     */
    public function setBeginAt(\DateTime $beginAt): Game
    {
        $this->beginAt = $beginAt;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFinished(): bool
    {
        return $this->isFinished;
    }

    /**
     * @param bool $isFinished
     * @return Game
     */
    public function setIsFinished(bool $isFinished): Game
    {
        $this->isFinished = $isFinished;
        return $this;
    }

    /**
     * @return Stadium
     */
    public function getStadium(): Stadium
    {
        return $this->stadium;
    }

    /**
     * @param Stadium $stadium
     * @return Game
     */
    public function setStadium(Stadium $stadium): Game
    {
        $this->stadium = $stadium;
        return $this;
    }

}
