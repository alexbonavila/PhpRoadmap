<?php

spl_autoload_register(function ($class) {
    // Project namespace prefix
    $prefix = 'Postgres\\';

    // Base directory for the namespace prefix
    $base_dir = $GLOBALS['baseProject']. '/';

    // Checks if the Class uses the namespace prefix
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // If not, move to the next registered autoloader
        return;
    }

    // Gets the relative Class name
    $relative_class = substr($class, $len);

    // Replaces the namespace with the base directory, replaces the namespace
    // separators with the directory separators in the relative Class name,
    // and adds .php at the end
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // If the file exists, include it
    if (file_exists($file)) {
        require $file;
    }
});
