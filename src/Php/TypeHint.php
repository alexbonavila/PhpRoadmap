<?php

// Type hints for scalar types
function add(int $a, int $b): int
{
    return $a + $b;
}

echo add(1, 2) . PHP_EOL; // 3

// Type hints for arrays
function sumArray(array $numbers): int
{
    return array_sum($numbers);
}

echo sumArray([1, 2, 3, 4]) . PHP_EOL; // 10

// Type hints for classes
class Person
{
}

function register(Person $person)
{
    // ... logic to register the person
    echo "Person registered!" . PHP_EOL;
}

register(new Person()); // Person registered!

// Type hints for interfaces
interface Vehicle
{
}

class Car implements Vehicle
{
}

function repair(Vehicle $vehicle)
{
    // ... logic to repair the vehicle
    echo "Vehicle repaired!" . PHP_EOL;
}

repair(new Car()); // Vehicle repaired!

// Type hints for callables (functions, closures, etc.)
function execute(callable $callback): void
{
    $callback();
}

execute(function () {
    echo "Callback executed!" . PHP_EOL; // Callback executed!
});

// Type hints for iterable (arrays or objects implementing Traversable interface)
function iterateOver(iterable $items): void
{
    foreach ($items as $item) {
        echo $item . PHP_EOL;
    }
}

iterateOver([1, 2, 3]); // 1 \n 2 \n 3

// Nullable type hints (using ? before type)
function sayHello(?string $name): void
{
    if ($name) {
        echo "Hello, $name!" . PHP_EOL;
    } else {
        echo "Hello, world!" . PHP_EOL;
    }
}

sayHello(null); // Hello, world!
sayHello("John"); // Hello, John!
