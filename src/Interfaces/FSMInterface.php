<?php

namespace illmatix\modThree\Interfaces;

/**
 * Defines the contract for a finite state machine (FSM).
 * An FSM manages states, transitions, and processes input to determine the final state.
 */
interface FSMInterface
{
    /**
     * Adds a state to the FSM.
     *
     * @param StateInterface $state The state to add.
     */
    public function addState(StateInterface $state): void;

    /**
     * Adds a transition rule to the FSM.
     *
     * @param TransitionInterface $transition The transition to add.
     */
    public function addTransition(TransitionInterface $transition): void;

    /**
     * Sets the initial state of the FSM.
     *
     * @param StateInterface $state The starting state.
     */
    public function setInitialState(StateInterface $state): void;

    /**
     * Processes an input string through the FSM.
     *
     * @param string $input The input string to process.
     */
    public function processInput(string $input): void;

    /**
     * Retrieves the current state of the FSM.
     *
     * @return StateInterface The current state.
     */
    public function getCurrentState(): StateInterface;

    /**
     * Resets the FSM to an uninitialized state.
     */
    public function reset(): void;
}