<?php

namespace illmatix\modThree\Interfaces;

interface StateInterface
{
    public function getName(): string;

    public function isFinal(): bool;
}