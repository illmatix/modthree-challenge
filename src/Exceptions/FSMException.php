<?php

namespace illmatix\modThree\Exceptions;

use Exception;

/**
 * Custom exception for errors related to the finite state machine (FSM).
 * This exception provides specific error messages for common FSM-related issues.
 */
class FSMException extends Exception
{
    /**
     * Creates an exception for empty input.
     *
     * @return self The exception instance.
     */
    public static function invalidInput(string $input): self
    {
        return new self("Invalid input provided: '{$input}'. Input must be a non-empty binary string.");
    }

    /**
     * Creates an exception for invalid input.
     *
     * @param string $input The invalid input string.
     * @return self The exception instance.
     */
    public static function emptyInput(): self
    {
        return new self("Input cannot be empty. Provide a valid binary string.");
    }
}
