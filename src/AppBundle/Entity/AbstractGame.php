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
 * @ORM\Table(name="abstract_game")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AbstractGameRepository")
 */
abstract class AbstractGame
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
     * @var int|null
     * @ORM\Column(name="local_score", type="integer", nullable=true)
     * @Assert\Range(min=0, minMessage="Le score de l'équipe locale ne peut pas être négatif.")
     */
    private $localScore;


    /**
     * @var int|null
     * @ORM\Column(name="visitor_score", type="integer", nullable=true)
     * @Assert\Range(min=0, minMessage="Le score de l'équipe visiteur ne peut pas être négatif.")
     */
    private $visitorScore;

    /**
     * @var Team
     * @ORM\OneToMany(targetEntity="Team", mappedBy="localGames")
     */
    private $localTeam;

    /**
     * @var Team
     * @ORM\OneToMany(targetEntity="Team", mappedBy="visitorGames")
     */
    private $visitorTeam;

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

    /**
     * @return Team|null
     */
    public function getResult(): ?Team
    {
        return ($this->getLocalScore() > $this->getVisitorScore()) ? $this->getLocalTeam() : $this->getVisitorTeam();
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
     * @return AbstractGame
     */
    public function setId(int $id): AbstractGame
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLocalScore(): ?int
    {
        return $this->localScore;
    }

    /**
     * @param int|null $localScore
     * @return AbstractGame
     */
    public function setLocalScore(?int $localScore): AbstractGame
    {
        $this->localScore = $localScore;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getVisitorScore(): ?int
    {
        return $this->visitorScore;
    }

    /**
     * @param int|null $visitorScore
     * @return AbstractGame
     */
    public function setVisitorScore(?int $visitorScore): AbstractGame
    {
        $this->visitorScore = $visitorScore;
        return $this;
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
     * Add localTeam.
     *
     * @param \AppBundle\Entity\Team $localTeam
     *
     * @return AbstractGame
     */
    public function addLocalTeam(\AppBundle\Entity\Team $localTeam)
    {
        $this->localTeam[] = $localTeam;

        return $this;
    }

    /**
     * Remove localTeam.
     *
     * @param \AppBundle\Entity\Team $localTeam
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeLocalTeam(\AppBundle\Entity\Team $localTeam)
    {
        return $this->localTeam->removeElement($localTeam);
    }

    /**
     * Add visitorTeam.
     *
     * @param \AppBundle\Entity\Team $visitorTeam
     *
     * @return AbstractGame
     */
    public function addVisitorTeam(\AppBundle\Entity\Team $visitorTeam)
    {
        $this->visitorTeam[] = $visitorTeam;

        return $this;
    }

    /**
     * Remove visitorTeam.
     *
     * @param \AppBundle\Entity\Team $visitorTeam
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeVisitorTeam(\AppBundle\Entity\Team $visitorTeam)
    {
        return $this->visitorTeam->removeElement($visitorTeam);
    }
}
