<?php

namespace illmatix\modThree;

use illmatix\modThree\Interfaces\TransitionInterface;
use illmatix\modThree\Interfaces\StateInterface;

class ModThreeTransition implements TransitionInterface
{
    public function __construct(
        private StateInterface $fromState,
        private string         $inputSymbol,
        private StateInterface $toState
    )
    {
    }

    public function getFromState(): StateInterface
    {
        return $this->fromState;
    }

    public function getToState(): StateInterface
    {
        return $this->toState;
    }

    public function getInputSymbol(): string
    {
        return $this->inputSymbol;
    }
}
