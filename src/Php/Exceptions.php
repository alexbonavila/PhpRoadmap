<?php


// Built-in Exception
function divide($a, $b): float
{
    if ($b == 0) {
        throw new Exception("Cannot divide by zero!");
    }
    return $a / $b;
}

// Custom Exception
class InvalidParameterException extends Exception
{
}

function greet($name)
{
    if (empty($name)) {
        throw new InvalidParameterException("Name cannot be empty!");
    }
    return "Hello, $name!";
}

// Multiple exception types
class NetworkException extends Exception
{
}

function fetchData($url)
{
    if (empty($url)) {
        throw new InvalidParameterException("URL cannot be empty!");
    }
    // Simulate a network error
    throw new NetworkException("Failed to fetch data from $url");
}

try {
    echo divide(10, 0) . PHP_EOL;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}

try {
    echo greet("") . PHP_EOL;
} catch (InvalidParameterException $e) {
    echo "Parameter Error: " . $e->getMessage() . PHP_EOL;
}

try {
    echo fetchData("") . PHP_EOL;
    echo fetchData("https://example.com") . PHP_EOL;
} catch (InvalidParameterException $e) {
    echo "Parameter Error: " . $e->getMessage() . PHP_EOL;
} catch (NetworkException $e) {
    echo "Network Error: " . $e->getMessage() . PHP_EOL;
} finally {
    echo "Fetching data operation finished." . PHP_EOL;
}


