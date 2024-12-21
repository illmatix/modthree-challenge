<?php

namespace illmatix\modThree\Interfaces;

interface TransitionInterface {
    public function getFromState(): StateInterface;
    public function getToState(): StateInterface;
    public function getInputSymbol(): string;
}
