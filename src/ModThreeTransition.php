<?php

namespace illmatix\modThree;

use illmatix\modThree\Interfaces\TransitionInterface;
use illmatix\modThree\Interfaces\StateInterface;

class ModThreeTransition implements TransitionInterface
{
    /**
     * @param StateInterface $fromState The state where the transition starts.
     * @param string $inputSymbol The input symbol that triggers the transition.
     * @param StateInterface $toState The state where the transition ends.
     */
    public function __construct(
        private StateInterface $fromState,
        private string         $inputSymbol,
        private StateInterface $toState
    )
    {
        // The constructor initializes the transition with its source state,
        // triggering input symbol, and destination state.
    }

    /**
     * Retrieves the state where this transition originates.
     *
     * @return StateInterface The originating state.
     */
    public function getFromState(): StateInterface
    {
        return $this->fromState;
    }

    /**
     * Retrieves the state where this transition ends.
     *
     * @return StateInterface The destination state.
     */
    public function getToState(): StateInterface
    {
        return $this->toState;
    }

    /**
     * Retrieves the input symbol that triggers this transition.
     *
     * @return string The triggering input symbol.
     */
    public function getInputSymbol(): string
    {
        return $this->inputSymbol;
    }
}
