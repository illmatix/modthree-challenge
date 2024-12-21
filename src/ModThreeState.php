<?php

namespace illmatix\modThree;

use illmatix\modThree\Interfaces\StateInterface;

class ModThreeState implements StateInterface
{
    public function __construct(
        private string $name,
        private bool   $isFinal = true
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isFinal(): bool
    {
        return $this->isFinal;
    }
}
