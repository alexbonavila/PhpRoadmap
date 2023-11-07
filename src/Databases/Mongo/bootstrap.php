<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use App\Config\Database;


// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

Database::initialize();