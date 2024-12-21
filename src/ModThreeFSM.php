<?php

namespace illmatix\modThree;

use illmatix\modThree\Exceptions\FSMException;
use illmatix\modThree\Interfaces\FSMInterface;
use illmatix\modThree\Interfaces\StateInterface;
use illmatix\modThree\Interfaces\TransitionInterface;

class ModThreeFSM implements FSMInterface
{
    // Keeps track of all states added to the FSM.
    private array $states = [];

    // Stores the transitions between states, essentially the FSM's rules.
    private array $transitions = [];

    // The current state the FSM is in. Starts as null until set.
    private ?StateInterface $currentState = null;

    /**
     * Adds a new state to the FSM.
     *
     * @param StateInterface $state The state to be added.
     */
    public function addState(StateInterface $state): void
    {
        $this->states[$state->getName()] = $state;
    }

    /**
     * Adds a transition to the FSM.
     *
     * @param TransitionInterface $transition The transition rule to add.
     */
    public function addTransition(TransitionInterface $transition): void
    {
        $this->transitions[] = $transition;
    }

    /**
     * Sets the initial state of the FSM.
     *
     * @param StateInterface $state The state to start in.
     */
    public function setInitialState(StateInterface $state): void
    {
        $this->currentState = $state;
    }

    /**
     * Processes the binary input through the FSM.
     *
     * @param string $input The binary string to process.
     * @throws FSMException If the input is empty or invalid.
     */
    public function processInput(string $input): void
    {
        // Check if the input string is truly empty
        if (strlen($input) === 0) {
            throw FSMException::emptyInput();
        }

        // Validate that the input contains only binary digits
        if (!preg_match('/^[01]+$/', $input)) {
            throw FSMException::invalidInput($input);
        }

        // Process each character (symbol) in the input.
        foreach (str_split($input) as $symbol) {
            foreach ($this->transitions as $transition) {
                // If the transition matches the current state and input, move to the next state.
                if (
                    $transition->getFromState() === $this->currentState &&
                    $transition->getInputSymbol() === $symbol
                ) {
                    $this->currentState = $transition->getToState();
                    // Once we find a match, stop looking.
                    break;
                }
            }
        }
    }

    /**
     * Gets the current state of the FSM.
     *
     * @return StateInterface The current state.
     */
    public function getCurrentState(): StateInterface
    {
        // This lets us inspect the FSM to see where it ended up.
        return $this->currentState;
    }

    /**
     * Resets the FSM to an uninitialized state.
     */
    public function reset(): void
    {
        // This clears the current state, so the FSM is ready for reuse.
        $this->currentState = null;
    }
}
