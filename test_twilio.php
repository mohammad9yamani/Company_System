<?php

require 'vendor/autoload.php';

use Twilio\Rest\Client;
use Dotenv\Dotenv;

// Load .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Get Twilio credentials from .env
$sid = $_ENV['TWILIO_SID'] ?? getenv('TWILIO_SID');
$token = $_ENV['TWILIO_AUTH_TOKEN'] ?? getenv('TWILIO_AUTH_TOKEN');
$twilioPhoneNumber = $_ENV['TWILIO_PHONE_NUMBER'] ?? getenv('TWILIO_PHONE_NUMBER');

// Display environment variables for debugging (optional)
echo "TWILIO_SID: $sid\n";
echo "TWILIO_AUTH_TOKEN: $token\n";
echo "TWILIO_PHONE_NUMBER: $twilioPhoneNumber\n";

// Initialize Twilio Client
$twilio = new Client($sid, $token);

try {
    // Replace '+962790963251' with your verified phone number to test
    $message = $twilio->messages->create(
        '+962790963251', // This should be your verified phone number in Twilio
        [
            'from' => $twilioPhoneNumber, // Your Twilio trial number
            'body' => 'Test message from Twilio!'
        ]
    );

    echo "Message sent successfully: " . $message->sid . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
