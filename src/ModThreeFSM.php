<?php

namespace illmatix\modThree;

use illmatix\modThree\Exceptions\FSMException;
use illmatix\modThree\Interfaces\FSMInterface;
use illmatix\modThree\Interfaces\StateInterface;
use illmatix\modThree\Interfaces\TransitionInterface;

class ModThreeFSM implements FSMInterface
{
    private array $states = [];
    private array $transitions = [];
    private ?StateInterface $currentState = null;

    public function addState(StateInterface $state): void
    {
        $this->states[$state->getName()] = $state;
    }

    public function addTransition(TransitionInterface $transition): void
    {
        $this->transitions[] = $transition;
    }

    public function setInitialState(StateInterface $state): void
    {
        $this->currentState = $state;
    }

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

        // Process the input string
        foreach (str_split($input) as $symbol) {
            foreach ($this->transitions as $transition) {
                if (
                    $transition->getFromState() === $this->currentState &&
                    $transition->getInputSymbol() === $symbol
                ) {
                    $this->currentState = $transition->getToState();
                    break;
                }
            }
        }
    }

    public function getCurrentState(): StateInterface
    {
        return $this->currentState;
    }

    public function reset(): void
    {
        $this->currentState = null;
    }
}
