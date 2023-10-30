<?php

// User-defined function
function greet($name) {
    return "Hello, $name!";
}
echo greet("John") . PHP_EOL;

// Anonymous function (closure)
$goodbye = function($name) {
    return "Goodbye, $name!";
};
echo $goodbye("John") . PHP_EOL;

// Anonymous function as an argument for another function
$numbers = [1, 2, 3, 4];
$squaredNumbers = array_map(function($n) { return $n * $n; }, $numbers);
print_r($squaredNumbers);

// Built-in functions
echo strlen("Hello, World!") . PHP_EOL; // Outputs: 13

// Variable functions
function sayHello() {
    return "Hello from variable function!";
}
$functionName = "sayHello";
echo $functionName() . PHP_EOL;
