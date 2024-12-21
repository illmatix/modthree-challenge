<?php

namespace illmatix\modThree\Exceptions;

use Exception;

class FSMException extends Exception
{
    public static function invalidInput(string $input): self
    {
        return new self("Invalid input provided: '{$input}'. Input must be a non-empty binary string.");
    }

    public static function emptyInput(): self
    {
        return new self("Input cannot be empty. Provide a valid binary string.");
    }
}
