<?php

/**
 * Reads environment variables from a .env file and sets them using putenv().
 * This allows for easy configuration of the application environment.
 *
 * The .env file is located at the base project path specified in $GLOBALS['baseProject'].
 * Each line in the .env file should be in the format of NAME=VALUE.
 * Lines starting with # are treated as comments and skipped.
 * Environment variables already present are not overwritten.
 */

$envFile = $GLOBALS['baseProject'] . '/.env';

$lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (str_starts_with(trim($line), '#')) {
        continue; // Skip comments
    }

    list($name, $value) = explode('=', $line, 2);
    $name = trim($name);
    $value = trim($value);

    if (!array_key_exists($name, $_ENV)) {
        putenv(sprintf('%s=%s', $name, $value));
        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
    }
}
