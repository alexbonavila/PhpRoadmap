<?php

require_once 'Actions/Create.php';
require_once 'Actions/Delete.php';
require_once 'Actions/Read.php';
require_once 'Actions/Update.php';
require_once 'Actions/Setup.php';

$setup = new Setup();
$pdo = $setup->index();

if ($pdo != NULL){
    $create = new Create($pdo);
    $delete = new Delete($pdo);
    $read = new Read($pdo);
    $update = new Update($pdo);

    $create->index();
    $read->index();

    $update->index();
    $read->index();

    $delete->index();
    $read->index();
} else {
    echo "Execution finished with ERROR" . PHP_EOL;
}


