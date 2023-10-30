<?php

// if...elseif...else Structure
$number = 10;

if ($number < 10) {
    echo "Number is less than 10." . PHP_EOL;
} elseif ($number == 10) {
    echo "Number is equal to 10." . PHP_EOL;
} else {
    echo "Number is greater than 10." . PHP_EOL;
}

// switch Structure
$day = "Monday";

switch ($day) {
    case "Sunday":
        echo "It's a weekend." . PHP_EOL;
        break;
    case "Saturday":
        echo "It's a weekend." . PHP_EOL;
        break;
    default:
        echo "It's a weekday." . PHP_EOL;
}

// match Structure
$day = "Saturday";

$matchResult =  match ($day) {
    "Sunday" => "It's a weekend." . PHP_EOL,
    "Saturday" => "It's a weekend." . PHP_EOL,
    default => "It's a weekday." . PHP_EOL,
};

echo $matchResult . PHP_EOL;


// while Loop
$i = 1;
while ($i <= 3) {
    echo "This is while loop iteration $i." . PHP_EOL;
    $i++;
}

// 4. do...while Loop
$j = 1;
do {
    echo "This is do-while loop iteration $j." . PHP_EOL;
    $j++;
} while ($j <= 3);

// 5. for Loop
for ($k = 1; $k <= 3; $k++) {
    echo "This is for loop iteration $k." . PHP_EOL;
}

// 6. foreach Loop
$array = array("a", "b", "c");
foreach ($array as $value) {
    echo "This is foreach loop with value: $value." . PHP_EOL;
}

// 7. break and continue within Loops
for ($l = 1; $l <= 5; $l++) {
    if ($l == 3) {
        continue; // Skips this iteration
    }
    if ($l == 4) {
        break; // Exits the loop
    }
    echo "Looping with value: $l." . PHP_EOL;
}