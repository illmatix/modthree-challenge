# ModThree Library

A lightweight PHP library to compute the modulo three of a binary string using a Finite State Machine (FSM).

---

## Features

- Define states and transitions dynamically.
- Process input sequences and track state changes.
- Immutable and extensible design.
- PSR-12 compliant and easy to integrate.

---

## Installation

Install the library via Composer:

```bash
composer require illmatix/fsm-library
```

## Usage
### Directly Use `mod-three`

```php
use illmatix\modThree\ModThree;

$result = ModThree::calculate("1101"); // Binary 13 → Modulo 3 = 1
echo $result; // 1
```

### Customize FSM Setup
If needed, you can directly use the FSM class for custom scenarios:

```php
use illmatix\modThree\ModThreeFSM;
use illmatix\modThree\ModThreeState;
use illmatix\modThree\ModThreeTransition;

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

$fsm->processInput("1101"); // Binary 13
echo $fsm->getCurrentState()->getName(); // "S1"
```

## Unit Tests

Run tests with PHPUnit:

```bash
vendor/bin/phpunit
```

or

```bash
composer test
```


## Contributing

Contributions are welcome! Feel free to submit issues or pull requests.

## License

This project is licensed under the [MIT License](LICENSE).

## Requirements

- PHP 8.4 or higher
- Composer
- Docker (optional)