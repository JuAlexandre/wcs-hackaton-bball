<?php
/**
 * Created by PhpStorm.
 * User: gollum
 * Date: 18/05/18
 * Time: 01:05
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Pool;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Championship
 *
 * @ORM\Championship(name="championship")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChampionshipRepository")
 */
class Championship
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(name="year", type="integer")
     * @ORM\Year
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $year;

    /**
     * @var Pool[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Pool", mappedBy="championship")
     *
     */
    private $pools;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
    }

}