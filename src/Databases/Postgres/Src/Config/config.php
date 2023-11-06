<?php

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
