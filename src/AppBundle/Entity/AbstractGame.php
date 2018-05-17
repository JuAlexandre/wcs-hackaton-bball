<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 17/05/18
 * Time: 13:55
 */

namespace AppBundle\Entity;

abstract class AbstractGame
{
    /**
     * @var Team
     */
    private $localTeam;
    /**
     * @var Team
     */
    private $visitorTeam;
    /**
     * @var int
     */
    private $localScore;
    /**
     * @var int
     */
    private $visitorScore;

    /**
     * AbstractGame constructor.
     * @param Team $localTeam
     * @param Team $visitorTeam
     */
    public function __construct(Team $localTeam, Team $visitorTeam)
    {
        $this->localScore = $localTeam;
        $this->visitorTeam = $visitorTeam;
    }

    public function getResult(): ?Team
    {
        return ($this->getLocalScore() > $this->getVisitorScore()) ? $this->getLocalTeam() : $this->getVisitorTeam();
    }

    /**
     * @return Team
     */
    public function getLocalTeam(): Team
    {
        return $this->localTeam;
    }

    /**
     * @param Team $localTeam
     * @return AbstractGame
     */
    public function setLocalTeam(Team $localTeam): AbstractGame
    {
        $this->localTeam = $localTeam;
        return $this;
    }

    /**
     * @return Team
     */
    public function getVisitorTeam(): Team
    {
        return $this->visitorTeam;
    }

    /**
     * @param Team $visitorTeam
     * @return AbstractGame
     */
    public function setVisitorTeam(Team $visitorTeam): AbstractGame
    {
        $this->visitorTeam = $visitorTeam;
        return $this;
    }

    /**
     * @return int
     */
    public function getLocalScore(): int
    {
        return $this->localScore;
    }

    /**
     * @param int $localScore
     * @return AbstractGame
     */
    public function setLocalScore(int $localScore): AbstractGame
    {
        $this->localScore = $localScore;
        return $this;
    }

    /**
     * @return int
     */
    public function getVisitorScore(): int
    {
        return $this->visitorScore;
    }

    /**
     * @param int $visitorScore
     * @return AbstractGame
     */
    public function setVisitorScore(int $visitorScore): AbstractGame
    {
        $this->visitorScore = $visitorScore;
        return $this;
    }


}
