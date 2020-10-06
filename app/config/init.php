<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;

// load .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
