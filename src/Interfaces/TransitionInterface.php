<?php

namespace illmatix\modThree\Interfaces;

/**
 * Represents the contract for a transition in a finite state machine (FSM).
 * A transition defines how the FSM moves between states based on an input symbol.
 */
interface TransitionInterface
{

    /**
     * Retrieves the state where this transition starts.
     *
     * @return StateInterface The originating state.
     */
    public function getFromState(): StateInterface;

    /**
     * Retrieves the state where this transition ends.
     *
     * @return StateInterface The destination state.
     */
    public function getToState(): StateInterface;

    /**
     * Retrieves the input symbol that triggers this transition.
     *
     * @return string The triggering input symbol.
     */
    public function getInputSymbol(): string;
}
