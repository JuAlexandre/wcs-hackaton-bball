<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class PoolGame
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="pool_game")
 */
class PoolGame extends AbstractGame
{
    /**
     * @return Team|null
     */
    public function getResult(): ?Team
    {
        if ($this->getLocalScore() === $this->getVisitorScore()) return null;

        return parent::getResult();
    }
}
