<?php

namespace AppBundle\Entity;

/**
 * Class PoolGame
 * @package AppBundle\Entity
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