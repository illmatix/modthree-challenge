<?php

namespace illmatix\modThree;

use illmatix\modThree\Exceptions\FSMException;

class ModThree
{
    public static function calculate(string $binary): int
    {
        // Validate input
        if (!preg_match('/^[01]+$/', $binary)) {
            throw FSMException::invalidInput($binary);
        }

        // Initialize FSM
        $fsm = new ModThreeFSM();

        $s0 = new ModThreeState('S0');
        $s1 = new ModThreeState('S1');
        $s2 = new ModThreeState('S2');

        $fsm->addState($s0);
        $fsm->addState($s1);
        $fsm->addState($s2);
        $fsm->setInitialState($s0);

        $fsm->addTransition(new ModThreeTransition($s0, '0', $s0));
        $fsm->addTransition(new ModThreeTransition($s0, '1', $s1));
        $fsm->addTransition(new ModThreeTransition($s1, '0', $s2));
        $fsm->addTransition(new ModThreeTransition($s1, '1', $s0));
        $fsm->addTransition(new ModThreeTransition($s2, '0', $s1));
        $fsm->addTransition(new ModThreeTransition($s2, '1', $s2));

        // Process the input
        $fsm->processInput($binary);

        // Map final state to modulo result
        $stateToResult = [
            'S0' => 0,
            'S1' => 1,
            'S2' => 2,
        ];

        return $stateToResult[$fsm->getCurrentState()->getName()];
    }
}