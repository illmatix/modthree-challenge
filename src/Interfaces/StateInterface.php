<?php

namespace illmatix\modThree\Interfaces;

/**
 * Represents the contract for a state in a finite state machine (FSM).
 * A state has a unique name and can optionally be marked as a final (accepting) state.
 */
interface StateInterface
{
    /**
     * Retrieves the name of the state.
     *
     * @return string The state's name.
     */
    public function getName(): string;

    /**
     * Indicates whether the state is a final (accepting) state.
     *
     * @return bool True if the state is final, otherwise false.
     */
    public function isFinal(): bool;
}