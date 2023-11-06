<?php

// Define route base
$GLOBALS['baseProject'] = __DIR__;

// Load configuration
require_once __DIR__ . '/src/config/config.php';

// Establish the connection with the database
require_once __DIR__ . '/src/database/Connection.php';

Connection::getConnection();
