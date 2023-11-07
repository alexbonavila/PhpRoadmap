<?php
// Check the request method
$requestMethod = $_SERVER['REQUEST_METHOD'];

switch ($requestMethod) {
    case 'GET':
        handleGET();
        break;
    case 'POST':
        handlePOST();
        break;
    case 'PUT':
        handlePUT();
        break;
    case 'DELETE':
        handleDELETE();
        break;
    default:
        echo "Method not supported." . PHP_EOL;
        break;
}

// Handle GET request
function handleGET() {
    echo "This is a GET request." . PHP_EOL;
}

// Handle POST request
function handlePOST() {
    echo "This is a POST request." . PHP_EOL;
}

// Handle PUT request
function handlePUT() {
    echo "This is a PUT request." . PHP_EOL;
}

// Handle DELETE request
function handleDELETE() {
    echo "This is a DELETE request." . PHP_EOL;
}

// Run with this command
//      php -S localhost:9621 Src/Php/HttpRequestHandling.php

// Try with this example oclearr using postman
//      curl -X GET http://localhost:9621
//      curl -X POST http://localhost:9621
//      curl -X PUT -d "data=value" http://localhost:9621
//      curl -X DELETE http://localhost:9621
