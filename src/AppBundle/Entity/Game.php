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
     * @var Team
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team", inversedBy="gamesVisitor")
     */
    private $visitorTeam;

    /**
     * @var int
     * @ORM\Column(name="visitor_score", type="integer")
     */
    private $visitorScore;

    /**
     * @var Team
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Team", inversedBy="gamesLocal")
     */
    private $localTeam;

    /**
     * @var int
     * @ORM\Column(name="local_score", type="integer")
     */
    private $localScore;

    /**
     * @var boolean
     * @ORM\Column(name="is_pool_game", type="boolean")
     * @Assert\Type("bool")
     */
    private $isPoolGame;

    /**
     * @var Stadium
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Stadium", inversedBy="games")
     * @Assert\NotBlank()
     */
    private $stadium;

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
     * Set teamVisitor
     *
     * @param \AppBundle\Entity\Team $teamVisitor
     *
     * @return Game
     */
    public function setTeamVisitor(\AppBundle\Entity\Team $teamVisitor = null)
    {
        $this->teamVisitor = $teamVisitor;

        return $this;
    }

    /**
     * Get teamVisitor
     *
     * @return \AppBundle\Entity\Team
     */
    public function getTeamVisitor()
    {
        return $this->teamVisitor;
    }

    /**
     * Set teamLocal
     *
     * @param \AppBundle\Entity\Team $teamLocal
     *
     * @return Game
     */
    public function setTeamLocal(\AppBundle\Entity\Team $teamLocal = null)
    {
        $this->teamLocal = $teamLocal;

        return $this;
    }

    /**
     * Get teamLocal
     *
     * @return \AppBundle\Entity\Team
     */
    public function getTeamLocal()
    {
        return $this->teamLocal;
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

    /**
     * Set visitorScore
     *
     * @param integer $visitorScore
     *
     * @return Game
     */
    public function setVisitorScore($visitorScore)
    {
        $this->visitorScore = $visitorScore;

        return $this;
    }

    /**
     * Get visitorScore
     *
     * @return integer
     */
    public function getVisitorScore()
    {
        return $this->visitorScore;
    }

    /**
     * Set localScore
     *
     * @param integer $localScore
     *
     * @return Game
     */
    public function setLocalScore($localScore)
    {
        $this->localScore = $localScore;

        return $this;
    }

    /**
     * Get localScore
     *
     * @return integer
     */
    public function getLocalScore()
    {
        return $this->localScore;
    }

    /**
     * Set visitorTeam
     *
     * @param \AppBundle\Entity\Team $visitorTeam
     *
     * @return Game
     */
    public function setVisitorTeam(\AppBundle\Entity\Team $visitorTeam = null)
    {
        $this->visitorTeam = $visitorTeam;

        return $this;
    }

    /**
     * Get visitorTeam
     *
     * @return \AppBundle\Entity\Team
     */
    public function getVisitorTeam()
    {
        return $this->visitorTeam;
    }

    /**
     * Set localTeam
     *
     * @param \AppBundle\Entity\Team $localTeam
     *
     * @return Game
     */
    public function setLocalTeam(\AppBundle\Entity\Team $localTeam = null)
    {
        $this->localTeam = $localTeam;

        return $this;
    }

    /**
     * Get localTeam
     *
     * @return \AppBundle\Entity\Team
     */
    public function getLocalTeam()
    {
        return $this->localTeam;
    }
}
