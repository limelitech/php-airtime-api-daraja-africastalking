<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Load dotenv via Composer

use Dotenv\Dotenv;

// Load the .env file from the project root
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

return [
    // Daraja / M-Pesa
    'DARAJA_CONSUMER_KEY'    => $_ENV['DARAJA_CONSUMER_KEY'],
    'DARAJA_CONSUMER_SECRET' => $_ENV['DARAJA_CONSUMER_SECRET'],
    'DARAJA_PASSKEY'         => $_ENV['DARAJA_PASSKEY'],
    'BUSINESS_SHORTCODE'     => $_ENV['BUSINESS_SHORTCODE'],
    'DARAJA_CALLBACK_URL'    => $_ENV['DARAJA_CALLBACK_URL'],

    // Africa's Talking
    'AT_USERNAME' => $_ENV['AT_USERNAME'],
    'AT_API_KEY'  => $_ENV['AT_API_KEY'],

    // Database
    'DB_HOST' => $_ENV['DB_HOST'],
    'DB_NAME' => $_ENV['DB_NAME'],
    'DB_USER' => $_ENV['DB_USER'],
    'DB_PASS' => $_ENV['DB_PASS']
];
