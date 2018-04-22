<?php

use P2H\helpers\FileHelper;
use P2H\parsers\implementations\Postman21Parser;

require_once __DIR__ . '/vendor/autoload.php';

$collectionPath = $argv[1];
$output = isset($argv[2]) ? $argv[2] : 'http-requests';


$fileHelper = new FileHelper();
$rawContent = $fileHelper->readFromFile($collectionPath);

$collectionData = json_decode($rawContent);

$parser = new Postman21Parser();

$writableContent = $parser->parse($collectionData);

foreach ($writableContent as $item) {
    $item->write();
}
