<?php
require_once __DIR__ . '/../vendor/autoload.php';


use Dotenv\Dotenv;

// Chargement du .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');

$dotenv->load();
