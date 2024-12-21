<?php

namespace illmatix\modThree;

use illmatix\modThree\Exceptions\FSMException;

class ModThree
{
    /**
     * Calculate the modulo three of a binary string using an FSM.
     *
     * @param string $binary The binary string to process.
     * @return int The modulo three result (0, 1, or 2).
     * @throws FSMException if the input is empty or invalid.
     */
    public static function calculate(string $binary): int
    {
        // Check if the input string is truly empty. Throw an exception so we can fail fast.
        if (strlen($binary) === 0) {
            throw FSMException::emptyInput();
        }

        // Input needs to be a proper binary string. Throw an exception so we can fail fast.
        if (!preg_match('/^[01]+$/', $binary)) {
            throw FSMException::invalidInput($binary);
        }

        // Initialize FSM
        $fsm = new ModThreeFSM();

        // Define the three states for modulo three: S0, S1, and S2.
        // These represent the remainders 0, 1, and 2 respectively.
        $s0 = new ModThreeState('S0');
        $s1 = new ModThreeState('S1');
        $s2 = new ModThreeState('S2');

        // Add these states to the FSM. Without these, the FSM doesn’t know what it’s working with.
        $fsm->addState($s0);
        $fsm->addState($s1);
        $fsm->addState($s2);

        // Start in S0 because every number mod three starts from zero.
        $fsm->setInitialState($s0);

        // Set up the transitions. This is the real logic of the FSM:
        // Each state changes based on the binary input.
        $fsm->addTransition(new ModThreeTransition($s0, '0', $s0));
        $fsm->addTransition(new ModThreeTransition($s0, '1', $s1));
        $fsm->addTransition(new ModThreeTransition($s1, '0', $s2));
        $fsm->addTransition(new ModThreeTransition($s1, '1', $s0));
        $fsm->addTransition(new ModThreeTransition($s2, '0', $s1));
        $fsm->addTransition(new ModThreeTransition($s2, '1', $s2));

        // Process the input string through the FSM. This is where the transitions get applied.
        $fsm->processInput($binary);

        // Map final state to modulo result.
        // S0 = 0, S1 = 1, S2 = 2.
        $stateToResult = [
            'S0' => 0,
            'S1' => 1,
            'S2' => 2,
        ];

        // Return the result. At this point, the FSM has done its job.
        return $stateToResult[$fsm->getCurrentState()->getName()];
    }
}