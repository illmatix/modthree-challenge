<?php

namespace illmatix\modThree\Tests;

use illmatix\modThree\Exceptions\FSMException;
use illmatix\modThree\ModThree;
use PHPUnit\Framework\TestCase;
use illmatix\modThree\ModThreeState;
use illmatix\modThree\ModThreeTransition;
use illmatix\modThree\ModThreeFSM;

class ModThreeFSMTest extends TestCase
{
    public function testFSMHandlesBinaryThirteen(): void
    {
        $fsm = $this->setUpFSM();
        $fsm->processInput("1101"); // Binary 13
        $this->assertEquals("S1", $fsm->getCurrentState()->getName());
    }

    public function testFSMHandlesBinaryFourteen(): void
    {
        $fsm = $this->setUpFSM();
        $fsm->processInput("1110"); // Binary 14
        $this->assertEquals("S2", $fsm->getCurrentState()->getName());
    }

    public function testFSMHandlesBinaryFifteen(): void
    {
        $fsm = $this->setUpFSM();
        $fsm->processInput("1111"); // Binary 15
        $this->assertEquals("S0", $fsm->getCurrentState()->getName());
    }

    public function testFSMHandlesSingleBinaryDigit(): void
    {
        $fsm = $this->setUpFSM();

        $fsm->processInput("0"); // Single binary digit
        $this->assertEquals("S0", $fsm->getCurrentState()->getName());

        $fsm->processInput("1"); // Single binary digit
        $this->assertEquals("S1", $fsm->getCurrentState()->getName());
    }

    public function testFSMThrowsExceptionOnEmptyInput(): void
    {
        $this->expectException(FSMException::class);
        $this->expectExceptionMessage("Input cannot be empty. Provide a valid binary string.");

        $fsm = $this->setUpFSM();
        $fsm->processInput(""); // Empty input
    }

    public function testFSMThrowsExceptionOnInvalidInput(): void
    {
        $this->expectException(FSMException::class);
        $this->expectExceptionMessage("Invalid input provided: '2'. Input must be a non-empty binary string.");

        $fsm = $this->setUpFSM();
        $fsm->processInput("2"); // Invalid binary digit
    }

    public function testModThreeCalculatesModulo(): void
    {
        $this->assertEquals(1, ModThree::calculate("1101")); // Binary 13 → Modulo 3 = 1
        $this->assertEquals(2, ModThree::calculate("1110")); // Binary 14 → Modulo 3 = 2
        $this->assertEquals(0, ModThree::calculate("1111")); // Binary 15 → Modulo 3 = 0
    }

    private function setUpFSM(): ModThreeFSM
    {
        $s0 = new ModThreeState('S0');
        $s1 = new ModThreeState('S1');
        $s2 = new ModThreeState('S2');

        $fsm = new ModThreeFSM();
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

        return $fsm;
    }

}
