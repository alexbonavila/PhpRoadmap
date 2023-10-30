<?php
/* Scalar types */

// Boolean
$boolVar = true;

// Integer
$intVar = 123;

// Float (Double)
$floatVar = 12.345;

// String
$stringVar = "Hello, World!";

/* Compound types */

// Array
$arrayVar = array(1, 2, 3, "foo", "bar");

// Object
class ExampleClass {
    public $property = "I'm a property!";
}
$objVar = new ExampleClass();

// Callable
$callableVar = function($name) {
    return "Hello, $name!";
};

// Iterable
$iterableVar = ["a", "b", "c"];

/* Special types */

// NULL
$nullVar = NULL;

// Resource
$fileHandle = fopen("./resources/files/example.txt", "r");

/* Print all variables */

// Get all defined variables
$allVars = get_defined_vars();

// Iterate through each variable and print it
foreach ($allVars as $varName => $varValue) {
    if ($varName === 'allVars') continue; // Skip the $allVars variable itself
    echo "$varName: ";
    var_dump($varValue);
    echo PHP_EOL;
}