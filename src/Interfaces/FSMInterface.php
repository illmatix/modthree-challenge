<?php

namespace illmatix\modThree\Interfaces;

interface FSMInterface
{
    public function addState(StateInterface $state): void;

    public function addTransition(TransitionInterface $transition): void;

    public function setInitialState(StateInterface $state): void;

    public function processInput(string $input): void;

    public function getCurrentState(): StateInterface;

    public function reset(): void;
}