<?php

require_once 'Objects/Create.php';
require_once 'Objects/Delete.php';
require_once 'Objects/Read.php';
require_once 'Objects/Update.php';
require_once 'Objects/Setup.php';

$setup = new Setup();
$pdo = $setup->index();

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
