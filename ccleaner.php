<?php

include __DIR__ . '/vendor/autoload.php';

use Ccleaner\Initialisation;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

(new Initialisation)();