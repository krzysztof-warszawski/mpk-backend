<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;

// load .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// config
ini_set('display_errors', 1);
error_reporting(E_ALL);
