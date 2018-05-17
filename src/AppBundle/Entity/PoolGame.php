<?php

namespace AppBundle\Entity;

class PoolGame extends AbstractGame
{
    public function getResult(): ?Team
    {
        if ($this->getLocalScore() === $this->getVisitorScore()) return null;

        return parent::getResult();
    }
}