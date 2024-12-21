<?php

namespace illmatix\modThree;

use illmatix\modThree\Interfaces\StateInterface;

/**
 * Represents a state within the finite state machine.
 * Each state has a name and can optionally be marked as a final state.
 */
class ModThreeState implements StateInterface
{
    /**
     * @param string $name The unique name of the state.
     * @param bool $isFinal Indicates if the state is a final (or accepting) state. Defaults to true.
     */
    public function __construct(
        private string $name,
        private bool   $isFinal = true
    )
    {
        // Constructor initializes the state's name and its finality status.
    }

    /**
     * Retrieves the name of the state.
     *
     * @return string The state's name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Indicates whether the state is a final state.
     *
     * @return bool True if the state is final, otherwise false.
     */
    public function isFinal(): bool
    {
        return $this->isFinal;
    }
}
