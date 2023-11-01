<?php

require __DIR__ . '/../vendor/autoload.php';

use Carbon\Carbon;

// Get the current date and time
$now = Carbon::now();
echo $now->toDateTimeString() . "\n";

// Add 5 days to the current date
$inFiveDays = $now->addDays(5);
echo $inFiveDays->toDateTimeString() . "\n";

// Subtract 30 minutes
$minusThirtyMinutes = $now->subMinutes(30);
echo $minusThirtyMinutes->toDateTimeString() . "\n";
